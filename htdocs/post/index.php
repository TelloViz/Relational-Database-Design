<?php 
require_once('../base.php');
require_once('getpost.php');

// check if url like localhost/cs332/post/?postid=12345
if (isset($_GET['postid'])) {
    // look up post 12345 from url in sql
    // htmlspecialchars is a safety precaution
    [$error, $postdetails] = getPostDetails(htmlspecialchars($_GET['postid']));
    if (isset($postdetails)) {
        $inject = printPostDetails($postdetails);
    }
    else {
        $inject = [
            'body' => '<div class="alert-danger"><h6>' . $error . '</h6></div>',
            'title' => 'Post Error - ' . $error
        ];
    }
}
else {
    $inject = [
        'body' => '<div class="alert-danger"><h6>No PostID specified</h6></div>',
        'title' => 'Post Error - No PostID'
    ];
}


printMain($inject);

?>
