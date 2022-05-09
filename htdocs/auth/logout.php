<?php

session_start();
session_unset();

require_once('../base.php');

$inject = [
    'body'=>"Logout Successful",
    'title'=>"Logout Successful",
];
printMain($inject);
?>