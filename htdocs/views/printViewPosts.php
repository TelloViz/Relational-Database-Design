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
    $vp = '<div class="container">';
    foreach ($posts as $post) {
        $vp = $vp . '<div class="row row-cols-4"><div class="col border">' . printAllFields($post) . '</div></div>';
    }
    $vp = $vp . '</div>';
    return $vp;
}

?>
