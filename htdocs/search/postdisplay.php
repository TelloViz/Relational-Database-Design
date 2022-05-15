<?php
require_once('../base.php');

    function printSingle($post) {
        if (isset($post['JobPostID'])) {
            return '<div class="col border p-4">
                            <a href="../post/?postid=' . $post['JobPostID'] . '"<h4>' . issetor($post['Title']) . '</h4></a>
                            <h5>' . issetor($post['EmployerName']) . '</h5>
                            <p>' . issetor($post['JobDesc']) . '</p>
                            <p>' . issetor($post['City']) . ', ' . issetor($post['StateID']) . '</p>
                        </div>';
        }
        return '';
    }

    function printPosts($posts) {
        if (!empty($posts)) {

            // these 2 lines are probably slow since it iterates throught the array 2 times
            $prettyposts = array_map('printSingle',$posts); // convert these posts into strings
            $allposts = implode($prettyposts);

            return '<div class="container"><div class="row row-cols-4 m-2 p-2">' . $allposts . '</div></div>';
        }
        else {
            return '<h4>PostView of posts</h1><p>No Posts Found.</p>';
        }
    }

?>
