<?php

$s = var_export($_POST, TRUE);

$inject = [
    'title' => 'Receive login post request',
    'body' => '<div class="container">' . $s . '</div>'
];

require_once('../base.php');
printMain($inject);

?>