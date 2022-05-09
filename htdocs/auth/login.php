<?php
require_once('../base.php');

session_start();

function getUser($email, $password) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
    $stmt = $conn->prepare("INSERT INTO useraccount (Email, Password, FirstName, LastName) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $userinfo['email'], $userinfo['password'],$userinfo['firstname'],$userinfo['lastname']);
    $stmt->execute();
    $result = $stmt->get_result();
    $conn->close();
    return $result;
}



require_once('../base.php');

$inject = [
    'body'=>"Login Page",
    'title'=>"Login Page",
];
printMain($inject);
?>