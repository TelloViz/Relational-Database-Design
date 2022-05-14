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
// if post attempted: try to post and display result, if fail print form with errors
else if (isset($_POST)) {
    [$error, $postdetails] = makePost($_POST);
    if (isset($postdetails)) {
        $inject['body'] = printPostDetails($postdetails);
    }
    else {
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
