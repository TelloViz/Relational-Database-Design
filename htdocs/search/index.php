<?php 
require_once('../base.php');
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);

require_once('postdisplay.php');

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

function getEmployerPosts($employerid) {
    try {
        $stmt = $GLOBALS['conn']->prepare("SELECT * FROM PostPreviewView WHERE EmployerID = ? LIMIT 50");
        $stmt->bind_param('i', $employerid);
        $stmt->execute();
        $result = $stmt->get_result();
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

function getAllPosts() {
    try {
        $result = $GLOBALS['conn']->query("SELECT * FROM PostPreviewView LIMIT 50");
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
?>
