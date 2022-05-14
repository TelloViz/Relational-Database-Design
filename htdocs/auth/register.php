<?php

function registerUserPage() {
    $inject = ['title' => 'Register', 'body'=>''];
    if (!empty($_POST['register_email'])
        && !empty($_POST['register_password']) 
        && !empty($_POST['register_firstname'])
        && !empty($_POST['register_lastname'])) {

        [$error , $userid] = makeUserSession($_POST['register_email'], $_POST['register_password'], $_POST['register_firstname'], $_POST['register_lastname']);
        if ($userid) {
            $inject['success'] = '<span>Successfully Registered as:' . $_SESSION['userid']
            . ', redirecting...<a href="/cs332">Click Here if you dont redirect automatically</a></span>';
            $inject['redirect'] = '/cs332';
        }
        else {
            $inject['body'] = printRegisterForm($error);
        }
    }
    else {
        $inject['body'] = printRegisterForm(); 
    }
    return $inject;
}

function makeUserSession($email, $password, $firstname, $lastname) {
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
    $stmt = $GLOBALS['conn']->prepare("SELECT Email FROM useraccount AS ua WHERE ua.email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
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
    $stmt = $GLOBALS['conn']->prepare("INSERT INTO useraccount (Email, Password, FirstName, LastName) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $userinfo['email'], $userinfo['password'],$userinfo['firstname'],$userinfo['lastname']);
    $stmt->execute();
    $userid = $stmt->insert_id;
    if (isset($userid)) {
        return [NULL, $userid];
    }
    return ['Failed to create user', NULL];
}

// -------------------------------- form design ----------------------------------------------
function printRegisterForm($error = "") {
    // set up login page
    return '<div class="container">  
                <div class="danger"><p>' . $error . '</p></div>
                <h4>Create Account</h4>  
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="register_email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="register_email"
                            name="register_email" aria-describedby="emailHelp"' .
                            ifNotEmptyValueAttribute(issetor($_POST['register_email'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="register_firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="register_firstname"
                            name="register_firstname" aria-describedby="emailHelp"' .
                            ifNotEmptyValueAttribute(issetor($_POST['register_firstname'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="register_lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="register_lastname"
                            name="register_lastname" aria-describedby="emailHelp"' .
                            ifNotEmptyValueAttribute(issetor($_POST['register_lastname'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="register_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="register_password"
                            name="register_password"' .
                        'required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div> ';
}
?>
