<?php

    function printSingle($post) {
        return '<div class="col border">
                    <h6>Post Title</h6>
                </div>';
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
