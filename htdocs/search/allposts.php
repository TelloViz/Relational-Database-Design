<?php 

$jsonposts = '{
    "Post1": {
        "title": "Post1",
        "description": "Some Description"
    },
    "Post2": {
        "title": "Post2",
        "description": "Some Other Description"
    }
}';

$posts = json_decode($jsonposts,true);

require_once('searchbase.php');
$bod = printPosts($posts);

require_once('../base.php');

$postview = [
    'title'=>'All Job Postings',
    'body'=> $bod
];
printMain($postview);

?>