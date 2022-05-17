<?php
function getPostDetails($postid) {
    try {
        $stmt = $GLOBALS['conn']->prepare("SELECT * FROM PostDetailView WHERE JobPostID = ?");
        $stmt->bind_param("i", $postid);
        $stmt->execute();
        $result = $stmt->get_result();
        $jobpost = $result->fetch_assoc();
        if (isset($jobpost)) {
            return [NULL, $jobpost];
        }
        return ['Failed to find JobPost.', NULL];
    }
    catch (Exception $e) {
        return ['Failed to find JobPost. ' . $e, NULL];
    }
}

function printPostDetails($postdetails) {
    // convert $postdetails key/value array to pretty html
    // should add any fields I forgot to include, benefits etc
    return '<div class="col border p-4">
                    <h4>' . issetor($postdetails['Title']) . '</h4>
                    <h5>' . issetor($postdetails['EmployerName']) . '</h5>
                    <p>' . issetor($postdetails['JobDesc']) . '</p>
                    <p>' . issetor($postdetails['City']) . ', ' . issetor($postdetails['StateID']) . '</p>
                    <p>' . var_export($postdetails, TRUE) . '</p>
                    </div>';
}

?>