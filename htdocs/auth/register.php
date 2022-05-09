<?php 

session_start();

$inject = [
        "title" => "Register Page"
];

// if already logged in go home
if (isset($_SESSION['userid'])) {
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
        $_SESSION['userid'] = $userid;
        $inject['body'] = '<div class="container"><p>Successfully Registered as:' . $_SESSION['userid'] . ', redirecting...</p><a href="/cs332">Click Here if you dont redirect automatically</a></div>';
    }
    else {
        $inject["body"] = '<div class="container"><p>Trying to log in with info:' . var_export($_POST, TRUE) . '</p><p class="danger">' . $error . '</p></div>';
    }

}
// display form to create user
else {
    $inject = printRegisterForm(var_export($_POST, TRUE)); 
}

require_once('../base.php');
printMain($inject);


// -------------- functions -------------------------------------------------------------

function makeUserSession($email, $password, $firstname, $lastname) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!checkIfEmailAvailable($email)) {
        $error = "Email Already in use...<a href='login.php'>log in.</a>";
        return [$error, NULL];
    }
    if (!checkIfEmailValid($email)) {
        $error = "Invalid Email";
        return [$error, NULL];
    }
    if (!checkIfPasswordValid($password)) {
        $error = "Invalid Password";
        return [$error, NULL];
    }
    // return userid
    $hash = hashPassword($password);

    $userinfo= [
        'email' => $email,
        'password' => $hash,
        'firstname' => $firstname,
        'lastname' => $lastname,
    ];

    $userid = createUser($userinfo);
    return [NULL, $userid];
}

function checkIfEmailAvailable($email) {
    return TRUE;
}

function checkIfEmailValid($email) {
    return TRUE;
}

function checkIfPasswordValid($password) {
    return TRUE;
}

function hashPassword($password) {
    $hash = $password; //should hash instead of storing as plain text
    return $hash;
}
function createUser($userinfo) {
    return 'testuser';
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