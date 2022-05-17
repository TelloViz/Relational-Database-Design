<?php
require_once('../base.php');
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
require_once('../posts/getposts.php');
require_once('printViewPosts.php');

function getEmpGT3Posts() {
    try {
        $result = $GLOBALS['conn']->query("SELECT * FROM EmployerGT3PostsView LIMIT 50");
        $jobposts = $result->fetch_all(MYSQLI_ASSOC);
        if (isset($jobposts)) {
            return [NULL, $jobposts];
        }
        return ['Failed to find JobPosts.', NULL];
    }
    catch (Exception $e) {
        return ['Failed to find JobPosts. ' . $e, NULL];
    }
}

[$error, $posts] = getEmpGT3Posts();

if (isset($posts)) {
    $inject['body'] = '<h4>Empoyers with 3 or more listings</h4>' . printViewPosts($posts);
}
else {
    $inject['warning'] = 'Failed to fetch job posts. ' . $error;
}

printMain($inject);


?>
