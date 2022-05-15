<?php 
require_once('../base.php');
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
require_once('getpost.php');
require_once('makepost.php');
require_once('postform.php');

$inject = [
    'title'=>'Make and View Posts',
    'body'=>''
];
// check if url like localhost/cs332/post/?postid=12345
if (isset($_GET['postid'])) {
    // look up post 12345 from url in sql
    // htmlspecialchars is a safety precaution
    [$error, $postdetails] = getPostDetails(htmlspecialchars($_GET['postid']));
    if (isset($postdetails)) {
        $inject['body'] = printPostDetails($postdetails);
    }
    else {
        $inject = [
            'body' => '<div class="alert-danger"><h6>' . $error . '</h6></div>',
            'title' => 'Post Error - ' . $error
        ];
    }
}
else if(!isset($_SESSION['userid'])) {
    header('Refresh: 2;url=/cs332/auth/login.php');
    $inject['body'] = '<div class="container"><p class="alert-danger">Must Be Logged in. Redirecting...</p><a href="/cs332/auth/login.php">Click Here if you dont redirect automatically</a></div>';
}
else if (!isset($_SESSION['employerid']) ) {
    header('Refresh: 2;url=/cs332/employer/create.php');
    $inject['body'] = '<div class="container"><p class="alert-danger">Must be an Employer. Redirecting...</p><a href="/cs332/employer/create.php">Click Here if you dont redirect automatically</a></div>';
}
// if post attempted: try to post and display result, if fail print form with errors
else if (!empty($_POST)) {
    [$error, $postid] = makePost($_POST);
    if (isset($postid)) {
        header('Refresh: 2;url=/cs332/post/?postid=' . $postid);
        $inject['success'] = '<span>Successfully created post! Redirecting...<a href="/cs332/post/?postid=' . $postid . '">Click Here if you dont redirect automatically</a></span>';
    }
    else {
        $inject['warning'] = 'Failed to create post: ' . $error;
        $inject['body'] = printPostForm($_POST);
    }
}
// otherwise print form with no fill
else {
    $inject['body'] = printPostForm();
}

printMain($inject);
$conn->close();

?>
