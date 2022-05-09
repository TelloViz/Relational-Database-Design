<?php
require_once('../base.php');

session_start();

$inject = [
    "title" => "Create Employer Page"
];

// if user is not logged in ... redirect to login page
if(!isset($_SESSION['userid'])) {
    header('Refresh: 2;url=/cs332/auth/login.php');
    $inject = printLoginForm();    
}
// otherwise, user is registered & logged in 
// create employer 
else {
    if(!empty($_POST['employername']) 
    && !empty($_POST['email'])
    && !empty($_POST['phonenumber'])
    && !empty($_POST['streetaddress'])
    && !empty($_POST['city'])
    && !empty($_POST['state'])
    && !empty($_POST['zipcode'])) {

        [$error, $userid] = makeEmployerSession($_POST['employername'], $_POST['email'], $_POST['phonenumber'], 
                            $_POST['streetaddress'], $_POST['city'], $_POST['state'], $_POST['zipcode']);
        if($userid) {
            $inject['body'] = '<div class="container"><p>Successfully Created Employer as:' . $_SESSION['userid'] . 
            ', redirecting...</p><a href="/cs332">Click Here if you dont redirect automatically</a></div>';

        } else { 
            $inject = printEmployerForm($error);
        }
    } else {
        $inject = printEmployerForm();
    }

}

printMain($inject);



// functions

function makeEmployerSession($employername, $email, $phonenumber, $streetaddress, $city, $state, $zipcode) {
    $employername = $_POST['employername'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $streetaddress = $_POST['streetaddress'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];

    if (!checkIfEmailAvailable($email)) {
        $error = "Email Already in use...<a href='employercreate.php'>create employer.</a>";
        return [$error, NULL];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid Email";
        return [$error, NULL];
    }

    $employerinfo= [
        'employername' => $employername,
        'email' => $email,
        'phonenumber' => $phonenumber
    ];

    $employerAddr= [
        'streetadress' => $streetaddress,
        'city' => $city,
        'state' => $state,
        'zipcode' => $zipcode
    ];

    [$error, $userid] = createEmployerAddr($employerAddr);
    if (isset($userid)) {
        $_SESSION['userid'] = $userid;
        return ['userid', TRUE];
    }
    [$error, $userid] = createEmployer($employerinfo);
    if (isset($userid)) {
        $_SESSION['userid'] = $userid;
        return ['userid', TRUE];
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


function createEmployer($employerinfo) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
    $stmt = $conn->prepare("INSERT INTO employers (EmployerName, Email, Phone) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $employerinfo['employername'], $employerinfo['email'],$employerinfo['phonenumber']);
    $stmt->execute();
    $userid = $stmt->insert_id;
    $conn->close();
    if (isset($userid)) {
        return [NULL, $userid];
    }
    return ['Failed to create employer', NULL];
}

function createEmployerAddr($employerAddr) {
    // INSERT addresses
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
    $stmt = $conn->prepare("INSERT INTO addresses (StreetAddress) VALUES (?)");
    $stmt->bind_param('s', $employerAddr['streetaddress']);
    $stmt->execute();
    // INSERT states
    $stmt = $conn->prepare("INSERT INTO states (StateName) VALUES (?)");
    $stmt->bind_param('s', $employerAddr['state']);
    $stmt->execute();
    // INSERT zipcodes
    $stmt = $conn->prepare("INSERT INTO zipcodes (City, ZipCodeID) VALUES (?,?)");
    $stmt->bind_param('ss', $employerAddr['zipcode'],  $employerAddr['city']);
    $stmt->execute();


    
    $userid = $stmt->insert_id;
    $conn->close();
    if (isset($userid)) {
        return [NULL, $userid];
    }
    return ['Failed to create Address', NULL];
}



// form design

function printEmployerForm($error = "") {
    // set up create employer form
    $employerBody= '
    <div class="container">  
        <div class="danger"><p>' . $error . '</p></div>
        <h4>Create Employer</h4>  
        <form action="employercreate.php" method="post">
            <div class="mb-3">
                <label for="employername" class="form-label">First & Last name</label>
                <input type="text" class="form-control" id="employername" name="employername" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="phonenumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="streetaddress" class="form-label">Street Address</label>
                <input type="streetaddress" class="form-control" id="streetaddress" name="streetaddress" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="city" class="form-control" id="city" name="city" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="state" class="form-control" id="state" name="state" required>
            </div>
            <div class="mb-3">
                <label for="zipcode" class="form-label">ZipCode</label>
                <input type="zipcode" class="form-control" id="zipcode" name="zipcode" required>
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