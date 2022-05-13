<?php
require_once('../base.php');


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
    && !empty($_POST['streetaddress'])
    && !empty($_POST['city'])
    && !empty($_POST['state'])
    && !empty($_POST['zipcode'])
    && !empty($_POST['userrole'])) {

        [$error, $success] = makeEmployer($_POST['employername'], $_POST['email'], $_POST['phonenumber'], 
                            $_POST['streetaddress'], $_POST['city'], $_POST['state'], $_POST['zipcode'], $_POST['userrole']);
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

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid Email";
        return [$error, FALSE];
    }

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
                <label for="employername" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="employername" name="employername" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="phonenumber" class="form-label">Phone Number</label>
                <input type="phone" class="form-control" id="phonenumber" name="phonenumber" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="streetaddress" class="form-label">Street Address</label>
                <input type="text" class="form-control" id="streetaddress" name="streetaddress" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <div class="mb-3">
                <label for="zipcode" class="form-label">ZipCode</label>
                <input type="text" class="form-control" id="zipcode" name="zipcode" required>
            </div>
            <div class="mb-3">
                <label for="userrole" class="form-label">User Role</label>
                <input type="text" class="form-control" id="userrole" name="userrole" required>
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