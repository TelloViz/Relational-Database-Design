<?php 
require_once('../base.php');
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);

require_once('postdisplay.php');

$jsonposts = '{
    "Post1": {
        "PostID": 1,
        "Title": "Software Engineer III",
        "EmployerName": "Netflix",
        "StateID": "CA",
        "City": "Monrovia"
    },
    "Post2": {
        "PostID": 2,
        "Title": "Data Analyst",
        "EmployerName": "Google",
        "StateID": "CA",
        "City": "San Jose"
    }
}';
$posts = json_decode($jsonposts,true);

function getAllPosts() {

}

$bod = printPosts($posts);


$postview = [
    'title'=>'All Job Postings',
    'body'=> $bod
];
printMain($postview);

?>
