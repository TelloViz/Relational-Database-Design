<?php
require_once('../base.php');

session_start();

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    [$error, $userid] = getUser($_POST['email'], $_POST['password']);
    if ($error) {
        $inject = printLoginForm($error);
        printMain($inject);
    }
    else {
        $_SESSION['userid'] = $userid;
        header('Refresh:3;url=/cs332');
        $inject = [
            "body" => '<div class="container"><p>Succesfully logged in as: ' . $_SESSION['userid'] . ', redirecting...</p><a href="/cs332">Click Here if you dont redirect automatically</a></div>',
            "title" => 'Success. Logging in...'
        ];
        printMain($inject);
    }
}
else {
    $inject = printLoginForm();
    printMain($inject);
}


function getUser($email, $password) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
    $stmt = $conn->prepare("SELECT UserID FROM useraccount AS ua WHERE ua.Email = ? AND ua.Password = ?");
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $conn->close();
    if (isset($row['UserID'])) {
        return [NULL, $row['UserID']];
    }
    else {
        return ['User not found.', NULL];
    }
}

function printLoginForm($error = "") {
    // set up login page
    $loginBody= '
    <div class="container">  
        <div class="danger"><p>' . $error . '</p></div>
        <h4>Log In</h4>  
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
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