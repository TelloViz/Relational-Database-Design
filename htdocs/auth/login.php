<?php

function loginUserPage() {
    $inject = ['title'=>'Login', 'body'=>''];
    if (!empty($_POST['login_email']) && !empty($_POST['login_password'])) {
        [$error, $userid] = getUser($_POST['login_email'], $_POST['login_password']);
        if ($userid) {
            $_SESSION['userid'] = $userid;
            $inject['redirect'] = 'account.php';
            $inject['success'] = '<span>Succesfully logged in as: ' . $_SESSION['userid'] . ', redirecting to profile...<a href="account.php">Click Here if you dont redirect automatically</a></span>';
        }
        else {
            $inject['body'] = printLoginForm($error);
        }
    }
    else {
        $inject['body'] = printLoginForm();
    }
    return $inject;
}

function getUser($email, $password) {
    // should really use bycrpt for passwords
    $stmt = $GLOBALS['conn']->prepare("SELECT UserID FROM useraccount AS ua WHERE ua.Email = ? AND ua.Password = ?");
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (isset($row['UserID'])) {
        return [NULL, $row['UserID']];
    }
    else {
        return ['User or Password Invalid. Please try again...', NULL];
    }
}

function printLoginForm($error = "") {
    // set up login page
    return '<div class="container">  
                <div class="danger"><p>' . $error . '</p></div>
                <h3>Log In</h4>  
                <form action="" method="post">
                    <div class="mb-4">
                        <label for="login_email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="login_email" name="login_email" aria-describedby="emailHelp"'. 
                            ifNotEmptyValueAttribute(issetor($_POST['login_email'])) .
                        'required>
                    </div>
                    <div class="mb-4">
                        <label for="login_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login_password" name="login_password"' . 
                        'required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div> ';
}

?>
