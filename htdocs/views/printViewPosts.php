<?php

function printAllFields($post) {
    $b = '<table class="table">';
    foreach ($post as $key => $val) {
        $b = $b . '<tr><td>' . $key .'</td><td>' . $val . '</td></tr>';
    }
    $b = $b . '</table>';
    return $b;
}

function printViewPosts($posts) {
    $vp = '<div class="container"><div class="row row-cols-3 p-4 m-4">';
    foreach ($posts as $post) {
        $vp = $vp . '<div class="col border">' . printAllFields($post) . '</div>';
    }
    $vp = $vp . '</div></div>';
    return $vp;
}

?>
