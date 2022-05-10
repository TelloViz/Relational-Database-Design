<?php 

// replace with sql to fetch all posts
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


require_once('searchbase.php');
$bod = printPosts($posts);

require_once('../base.php');

$postview = [
    'title'=>'All Job Postings',
    'body'=> $bod
];
printMain($postview);

?>
