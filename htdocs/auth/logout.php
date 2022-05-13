<?php

require_once('../base.php');

session_destroy();
session_start();

$inject = [
    'body'=>"Logout Successful",
    'title'=>"Logout Successful",
];
printMain($inject);
?>
