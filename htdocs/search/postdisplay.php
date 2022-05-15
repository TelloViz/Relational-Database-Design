<?php
require_once('../base.php');

    function printSingle($post) {
        if (isset($post['JobPostID'])) {
            return '<div class="col card border p-0 m-2">
                        <div class="card-body">
                                <a class="card-title" href="../post/?postid=' . $post['JobPostID'] . '"><h4>' . issetor($post['Title']) . '</h4></a>
                                <a class="card-subtitle " href="../employer/?employerid=' . $post['EmployerID'] . '"><small class="text-muted">' . issetor($post['EmployerName']) . '</small></a>
                                <p class="card-text">' . issetor($post['JobDesc']) . '</p>
                                <p>' . issetor($post['City']) . ', ' . issetor($post['StateID']) . '</p>
                        </div>
                        <div class="card-footer"><small class="text-muted"> Apply By: '
                            . date_format(date_create(issetor($post['DeadLine'])), 'm/d/Y') .
                        '</small></div>
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
