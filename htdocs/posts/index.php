<?php 
require_once('../base.php');
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
require_once('getposts.php');

$inject = [
    'title' => 'All Job Posts',
    'body' => ''
];

if (isset($_GET['employerid'])) {
    [$error, $posts] = getEmployerPosts($_GET['employerid']);
}
else {
    [$error, $posts] = getAllPosts();
}

if (isset($posts)) {
    $inject['body'] = printPosts($posts);
}
else {
    $inject['warning'] = 'Failed to fetch job posts. ' . $error;
}

printMain($inject);

?>
