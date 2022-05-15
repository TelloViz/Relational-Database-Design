<?php
require_once('../base.php');

session_start();

$inject = [
    "title" => "Create Employer Page"
];

// if user is not logged in ... redirect to login page
if(!isset($_SESSION['userid'])) {
    header('Refresh: 2;url=/cs332/auth/login.php');
    $inject['body'] = '<div class="container"><p class="alert-danger">Must Be Logged in. Redirecting...</p><a href="/cs332/auth/login.php">Click Here if you dont redirect automatically</a></div>';
}
// otherwise, user is registered & logged in 
// create employer 
else if ( isset($_SESSION['employerid']) ) {
    header('Refresh: 2;url=/cs332/employer/?employerid=' . $_SESSION['employerid']);
    $inject['body'] = '<div class="container"><p class="alert-danger">Already an Employer. Redirecting...</p><a href="/cs332/employer/?employerid=' . $_SESSION['employerid'] . '">Click Here if you dont redirect automatically</a></div>';
}
else {
    if(!empty($_POST['employername']) 
    && !empty($_POST['email'])
    && !empty($_POST['phonenumber'])
    && !empty($_POST['userrole'])) {

        $employername = $_POST['employername'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $userrole = $_POST['userrole'];
        $streetaddress = NULL;
        $city = NULL;
        $state = NULL;
        $zipcode = NULL;  

        if(!empty($_POST['streetaddress']))
        {
            $streetaddress = $_POST['streetaddress'];
        }
        if(!empty($_POST['city']))
        {
            $city = $_POST['city'];
        }
        if(!empty($_POST['state']))
        {
            $state = $_POST['state'];
        }
        if(!empty($_POST['zipcode']))
        {
            $zipcode = $_POST['zipcode'];
        }

        [$error, $success] = makeEmployer($employername, $email, $phonenumber, $userrole, $streetaddress, $city, $state, $zipcode);
        $inject['body'] = $_SESSION['employerid'];

        if($success) {
            header('Refresh: 2;url=/cs332/employer/?employerid=' . $_SESSION['employerid']);
            $inject['body'] = '<div class="container"><p>Successfully Created Employer as:' . $_SESSION['employerid'] . 
            ', redirecting...</p><a href="/cs332/employer/?employerid=' . $_SESSION['employerid'] . '">Click Here if you dont redirect automatically</a></div>';
        }
        else { 
            $inject = printEmployerForm($error);
        }
    }
    else {
        $inject = printEmployerForm();
    }
}

printMain($inject);



// functions

function makeEmployer($employername, $email, $phonenumber, $streetaddress, $city, $state, $zipcode, $userrole) {
    
    $userrole = $_POST['userrole'];
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid Email";
        return [$error, FALSE];
    }

    if(!empty($_POST['streetaddress']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zipcode']))
    {
        $employerAddr= [
            'streetaddress' => $streetaddress,
            'city' => $city,
            'state' => $state,
            'zipcode' => $zipcode
        ];

        [$error, $addressid] = createAddr($employerAddr);
        if ($error) {
            return [$error, FALSE];
        }
    } 
    else 
    {
        $addressid = NULL;
    }
    
    $employerinfo= [
        'employername' => $employername,
        'addressid' => $addressid,
        'email' => $email,
        'phonenumber' => $phonenumber
    ];

    [$error, $employerid] = createEmployer($employerinfo);
    if ($error) {
        return [$error, FALSE];
    }

   $userinfo = [
        'userid' => $_SESSION['userid'],
        'employerid' => $employerid,
        'roleid' => $userrole
   ];

    [$error, $userupdated] = userAddEmployer($userinfo); 
    if (!$error) {
        $_SESSION['employerid'] = $employerid;
        return [NULL , TRUE];
    }

    return [$error, FALSE];
}

function checkIfEmailAvailable($email) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
    $stmt = $conn->prepare("SELECT Email FROM employers AS ua WHERE ua.email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $conn->close();
    if (isset($row['Email'])) { 
        return FALSE;
    }
    return TRUE;
}

function createAddr($addr) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);

    $stmt = $conn->prepare("INSERT INTO addresses (StreetAddress, ZipCodeID) VALUES (?, ?)");
    $stmt->bind_param('si', $addr['streetaddress'], $addr['zipcode']);
    $stmt->execute();
    $addressid = $stmt->insert_id;

    /*
    Someday we'll implement adding the zip if it doesn't exist. Idk if a regular user should be able to though
    if (!$addressid) {
        $stmt = $conn->prepare("INSERT INTO states (StateName) VALUES (?)");
        $stmt->bind_param('s', $addr['state']);
        $stmt->execute();
        // INSERT zipcodes
        $stmt = $conn->prepare("INSERT INTO zipcodes (City, ZipCodeID) VALUES (?,?)");
        $stmt->bind_param('ss', $addr['zipcode'],  $addr['city']);
        $stmt->execute();
    }
    */
    
    $conn->close();
    if (isset($addressid)) {
        return [NULL, $addressid];
    }
    return ['Failed to create Address', NULL];
}

function createEmployer($employerinfo) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
    $stmt = $conn->prepare("INSERT INTO employers (EmployerName, AddressID, Email, Phone) VALUES (?, ?,  ?, ?)");
    $stmt->bind_param('ssss', $employerinfo['employername'], $employerinfo['addressid'], $employerinfo['email'],$employerinfo['phonenumber']);
    $stmt->execute();
    $employerid = $stmt->insert_id;
    $conn->close();
    if (isset($employerid)) {
        return [NULL, $employerid];
    }
    return ['Failed to create employer', NULL];
}

function userAddEmployer($userinfo) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
    //echo "Role is [", $userrole, "]";
    $stmt = $conn->prepare("INSERT INTO EmployerAdmin (UserID, EmployerID, RoleID) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $userinfo['userid'], $userinfo['employerid'], $userinfo['roleid']);
    $stmt->execute();
    $useradminid = $stmt->insert_id;
    $conn->close();
    if (isset($useradminid)) {
        return [NULL, $useradminid];
    }
    return ['Failed to add employer role to user', NULL];
}

// form design

function printEmployerForm($error = "") {
    // set up create employer form
    $employerBody= '
    <div class="container">  
        <div class="alert-danger"><p>' . $error . '</p></div>
        <h4>Create Employer</h4>  
        <form action="employercreate.php" method="post">
            <div class="mb-3">
                <class="form-label">* Required Field</label>
            </div>
            <div class="mb-3">
                <label for="employername" class="form-label">Company Name *</label>
                <input type="text" class="form-control" id="employername" name="employername" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address *</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="phonenumber" class="form-label">Phone Number *</label>
                <input type="phone" class="form-control" id="phonenumber" name="phonenumber" aria-describedby="emailHelp" required>
            </div>
            <div>
            <label for="userrole" class="form-label">User Role *</label>
                <select name="userrole" id="userrole" required>
                    <option value="">--- Choose a role ---</option>
                    <option value="1">Owner</option>
                    <option value="2">CEO</option>
                    <option value="3">Assistant/Manager</option>
                    <option value="4">Human Resources Generalist</option>
                    <option value="5">Hiring Manager</option>
                    <option value="6">Recruiter</option>
                    <option value="7">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="streetaddress" class="form-label">Street Address</label>
                <input type="text" class="form-control" id="streetaddress" name="streetaddress">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" name="state">
            </div>
            <div class="mb-3">
                <label for="zipcode" class="form-label">ZipCode</label>
                <input type="text" class="form-control" id="zipcode" name="zipcode">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> ';

    $inject= [
    "body" => $employerBody,
    "title" => "Create Employer"
    ];
    return $inject;
}

?>