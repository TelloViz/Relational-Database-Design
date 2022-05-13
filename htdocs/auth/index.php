<?php
require_once('../base.php');

require_once('login2.php');
require_once('register2.php');

$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);

$inject = [
    'title'=>"Log In or Create Account"
];

if (isset($_SESSION['userid'])) {
    $warning = '<span>Already logged in as: ' . $_SESSION['userid'] 
    . ', redirecting...<a href="/cs332">Click Here if you dont redirect automatically</a></span>';
    $inject['redirect'] = '/cs332';
}
else {
    $loginform = loginUserPage();
    $registerform = registerUserPage();

    $inject['body'] = '<div class="row">
                <div class="col">' . 
                issetor($registerform['body']) .
                '</div>
                <div class="col">' .
                issetor($loginform['body']) .
                '</div>
            </div>';
}

if (isset($inject['redirect'])) {
    header('Refresh:2;url=' . $inject['redirect']);
}
else if (isset($loginform['redirect'])) {
    header('Refresh:2;url=' . $loginform['redirect']);
}
else if (isset($registerform['redirect'])) {
    header('Refresh:2;url=' . $registerform['redirect']);
}

$inject['success'] = issetor($loginform['success']) . issetor($registerform['success']);
$inject['warning'] = issetor($warning) . issetor($loginform['warning']) . issetor($registerform['warning']);

printMain($inject);


$conn->close();

?>
