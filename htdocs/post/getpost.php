<?php

function getPostDetails($postid) {
    // need to select post info from db, ideally from a view so you can just do
    //  (SELECT * FROM PostDetailView WHERE PostID = ?)
    // and bind the $postid

    // if error like post not found:
    // return ['Error message', NULL];

    $samplepost = [ 
        "Title" => "Software Engineer III",
        "EmployerName" => "Netflix",
        "JobDesc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        "City" => "Monrovia",
        "StateID" => "CA",
    ];
    return [NULL, $samplepost];
}

function printPostDetails($postdetails) {
    // convert $postdetails key/value array to pretty html
    // should add any fields I forgot to include, benefits etc
    $postbody = '<div class="col border p-4">
                    <h4>' . issetor($postdetails['Title']) . '</h4>
                    <h5>' . issetor($postdetails['EmployerName']) . '</h5>
                    <p>' . issetor($postdetails['JobDesc']) . '</p>
                    <p>' . issetor($postdetails['City']) . ', ' . issetor($postdetails['StateID']) . '</p>
                    </div>';
    $inject = [
        'body' => $postbody,
        'title' => 'Post - ' . issetor($postdetails['Title'])
    ];
    return $inject;
}

?>