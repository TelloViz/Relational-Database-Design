<?php 
require_once('../base.php');

session_start();

$inject = [
        "title" => "Register Page"
];

// if already logged in go home
if (isset($_SESSION['userid'])) {
    header('Refresh: 2;url=/cs332');
    $inject["body"] = '<div class="container"><p>Already logged in as: ' 
    . $_SESSION['userid'] 
    . ', redirecting...</p><a href="/cs332">Click Here if you dont redirect automatically</a></div>'; 
    
}
//try to create user and log in
else if (!empty($_POST['email'])
        && !empty($_POST['password']) 
        && !empty($_POST['firstname'])
        && !empty($_POST['lastname'])) {

    [$error , $userid] = makeUserSession($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname']);
    if ($userid) {
        $inject['body'] = '<div class="container"><p>Successfully Registered as:' . $_SESSION['userid'] . ', redirecting...</p><a href="/cs332">Click Here if you dont redirect automatically</a></div>';
    }
    else {
        $inject = printRegisterForm($error);
    }
}
else {
    $inject = printRegisterForm(); 
}

printMain($inject);


// -------------- functions -------------------------------------------------------------

function makeUserSession($email, $password, $firstname, $lastname) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!checkIfEmailAvailable($email)) {
        $error = "Email Already in use...<a href='login.php'>log in.</a>";
        return [$error, NULL];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid Email";
        return [$error, NULL];
    }

    [$msg, $valid] = checkIfPasswordValid($password);
    if (!$valid) {
        return [$msg, NULL];
    }

    // return userid
    $hash = hashPassword($password);

    $userinfo= [
        'email' => $email,
        'password' => $hash,
        'firstname' => $firstname,
        'lastname' => $lastname,
    ];

    [$error, $userid] = createUser($userinfo);
    if (isset($userid)) {
        $_SESSION['userid'] = $userid;
        return ['userid', TRUE];
    }
    return [$error, FALSE];
}

function checkIfEmailAvailable($email) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
    $stmt = $conn->prepare("SELECT Email FROM useraccount AS ua WHERE ua.email = ?");
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

function checkIfPasswordValid($password) {
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (($uppercase && $lowercase && $number && $specialChars && strlen($password) >= 8)) {
        return ['Strong Password', TRUE];
    }
    else {
        return ['Password should be at least 8 characters in length and should include at least one upper case letter, one lower case letter, one number, and one special character.', FALSE];
    }
}

function hashPassword($password) {
    $hash = $password; //should hash instead of storing as plain text
    return $hash;
}

function createUser($userinfo) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
    $stmt = $conn->prepare("INSERT INTO useraccount (Email, Password, FirstName, LastName) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $userinfo['email'], $userinfo['password'],$userinfo['firstname'],$userinfo['lastname']);
    $stmt->execute();
    $userid = $stmt->insert_id;
    $conn->close();
    if (isset($userid)) {
        return [NULL, $userid];
    }
    return ['Failed to create user', NULL];
}

// -------------------------------- form design ----------------------------------------------
function printRegisterForm($error = "") {
    // set up login page
    $loginBody= '
    <div class="container">  
        <div class="danger"><p>' . $error . '</p></div>
        <h4>Create Account</h4>  
        <form action="register.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div> ';

    $inject= [
    "body" => $loginBody,
    "title" => "Login Page"
    ];
    return $inject;
}
?>
