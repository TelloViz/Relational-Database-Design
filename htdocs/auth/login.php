<?php

session_start();

require_once('../base.php');

$inject = [
    'body'=>"Login Page",
    'title'=>"Login Page",
];
printMain($inject);
?>