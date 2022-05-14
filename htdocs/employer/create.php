<?php
require_once('../base.php');
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);

require_once('getzip.php');


$inject = [
    "title" => "Create Employer Page",
    "body" => "Create Employer Page"
];

// if user is not logged in ... redirect to login page
if(!isset($_SESSION['userid'])) {
    header('Refresh: 2;url=/cs332/auth');
    $inject['warning'] = '<span>Must Be Logged in. Redirecting...<a href="/cs332/auth">Click Here if you dont redirect automatically</a></span>';
}
// otherwise, user is registered & logged in 
// create employer 
else if (isset($_SESSION['employerid'])) {
    header('Refresh: 2;url=/cs332/employer');
    $inject['warning'] = '<span>Already an Employer. Redirecting...<a href="/cs332/employer">Click Here if you dont redirect automatically</a></span>';
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
        if($success) {
            header('Refresh: 2;url=/cs332/employer');
            $inject['success'] = '<span>Successfully Created Employer as:' . issetor($_SESSION['employerid']) . 
            ', redirecting...<a href="/cs332/employer">Click Here if you dont redirect automatically</a></span>';
            $inject['body'] = 'Success';
        }
        else { 
            $inject['body'] = printEmployerForm($error);
        }
    }
    else {
        $inject['body'] = printEmployerForm();
    }
}

printMain($inject);

$conn->close();



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
    $stmt = $GLOBALS['conn']->prepare("SELECT Email FROM employers AS ua WHERE ua.email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (isset($row['Email'])) { 
        return FALSE;
    }
    return TRUE;
}

function createZip($zip, $city, $state) {
    try {
        $stmt = $GLOBALS['conn']->prepare("INSERT INTO ZipCodes (ZipCodeID, City, StateID) VALUES (?, ?, ?)");
        $stmt->bind_param('iss', $zip, $city, $state);
        $stmt->execute();
        $zipcodeid = $stmt->insert_id;
        return [NULL, $zipcodeid];
    } catch (Exception $e) {
        return ["Failed to create Zip. " . $e, NULL] ;
    }
}

function createOrAddZip($addr) {
    [$error, $zipinfo] = getZip($addr['zipcode'], $GLOBALS['conn']);
    if (isset($error)) {
        [$error, $zipcode] = createZip($addr['zipcode'],$addr['city'], $addr['state']);
        if (isset($error)) {
            return ['Failed to find/create zipcode. Error: ' . $error, NULL];
        }
        else {
            return [NULL, $zipcode];
        }
    }
    else {
        return [NULL, $zipinfo['ZipCodeID']];
    }
}

function createAddr($addr) {
    [$error, $zip] = createOrAddZip($addr);
    if (isset($error)) {
        return [$error, NULL];
    }
    else {
        try {
            $stmt = $GLOBALS['conn']->prepare("INSERT INTO addresses (StreetAddress, ZipCodeID) VALUES (?, ?)");
            $stmt->bind_param('si', $addr['streetaddress'], $zip);
            $r = $stmt->execute();
            $addressid = $stmt->insert_id;
            return [NULL, $addressid];
        }
        catch (Exception $e) {
            return ['Failed to create Address. ' . $e, NULL];
        }
    }
}

function createEmployer($employerinfo) {
    try {
        $stmt = $GLOBALS['conn']->prepare("INSERT INTO employers (EmployerName, AddressID, Email, Phone) VALUES (?, ?,  ?, ?)");
        $stmt->bind_param('ssss', $employerinfo['employername'], $employerinfo['addressid'], $employerinfo['email'],$employerinfo['phonenumber']);
        $stmt->execute();
        $employerid = $stmt->insert_id;
        return [NULL, $employerid];
    }
    catch (Exception $e) {
        return ['Failed to create employer. ' . $e, NULL];
    }
}

function userAddEmployer($userinfo) {
    try {
        $stmt = $GLOBALS['conn']->prepare("INSERT INTO EmployerAdmin (UserID, EmployerID, RoleID) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $userinfo['userid'], $userinfo['employerid'], $userinfo['roleid']);
        $stmt->execute();
        $useradminid = $stmt->insert_id;
        return [NULL, $useradminid];
    }
    catch (Exception $e) {
        return ['Failed to add employer role to user. ' . $e,  NULL];
    }
}


function printEmployerForm($error = "") {
    // set up create employer form
    return '<div class="container">  
                <div class="alert-danger"><p>' . issetor($error) . '</p></div>
                <h4>Create Employer</h4>  
                <form action="create.php" method="post">
                    <div class="mb-3">
                        <label for="employername" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="employername" name="employername" aria-describedby="emailHelp"' .
                            ifNotEmptyValueAttribute(issetor($_POST['employername'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"' .
                            ifNotEmptyValueAttribute(issetor($_POST['email'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="phonenumber" class="form-label">Phone Number</label>
                        <input type="phone" class="form-control" id="phonenumber" name="phonenumber" aria-describedby="emailHelp"' .
                            ifNotEmptyValueAttribute(issetor($_POST['phonenumber'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="streetaddress" class="form-label">Street Address</label>
                        <input type="text" class="form-control" id="streetaddress" name="streetaddress"' .
                            ifNotEmptyValueAttribute(issetor($_POST['streetaddress'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="zipcode" class="form-label">ZipCode</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode"' .
                            ifNotEmptyValueAttribute(issetor($_POST['zipcode'])) .
                            //should add an ajax event to query getzip and autofill city and state
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city"' .
                            ifNotEmptyValueAttribute(issetor($_POST['city'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state"' .
                            ifNotEmptyValueAttribute(issetor($_POST['state'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="userrole" class="form-label">User Role</label>
                        <input type="text" class="form-control" id="userrole" name="userrole"' .
                            ifNotEmptyValueAttribute(issetor($_POST['userrole'])) .
                        'required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div> ';
}

?>