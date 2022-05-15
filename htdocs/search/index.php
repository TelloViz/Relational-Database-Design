<?php 
require_once('../base.php');
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);

require_once('postdisplay.php');

$inject = [
    'title' => 'All Job Posts',
    'body' => ''
];

function getAllPosts() {
    try {
        $result = $GLOBALS['conn']->query("SELECT * FROM JobPosts LIMIT 50");
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

[$error, $posts] = getAllPosts();
if (isset($posts)) {
    $inject['body'] = printPosts($posts);
}
else {
    $inject['warning'] = 'Failed to fetch job posts. ' . $error;
}

printMain($inject);

?>
