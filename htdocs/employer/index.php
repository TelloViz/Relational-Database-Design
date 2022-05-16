<?php 
require_once('../base.php');
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);

require_once('../posts/getposts.php');


$inject = [
    'title' => 'Employer Page',
    'body' => ''
];

// check if url like localhost/cs332/employer/?employerid=12345
if (isset($_GET['employerid'])) {
    // look up employer 12345 from url in sql
    // htmlspecialchars is a safety precaution
    [$emperror, $employerdetails] = getEmployerDetails(htmlspecialchars($_GET['employerid']));
    [$posterror, $posts] = getEmployerPosts(htmlspecialchars($_GET['employerid']));

    if (isset($posts)) {
        $postbody = printPosts($posts);
    }
    else {
        $postwarning = 'Failed to fetch job posts. ' . $posterror;
    }
    if (isset($employerdetails)) {
        $empbody = printemployerDetails($employerdetails);
    }
    else {
        $empwarning = 'Failed to fetch employer info. ' . $emperror;
    }
    $inject['body'] = issetor($empbody) . issetor($postbody);
    $inject['warning'] = issetor($emperror) . issetor($posterror);
}
else if (isset($_SESSION['employerid'])) {
    [$error, $employerdetails] = getEmployerDetails($_SESSION['employerid']);
    if (isset($employerdetails)) {
        $inject['body'] = printemployerDetails($employerdetails);
    }
    else {
        $inject['error'] = $error;
    }
}
else {
    $inject['error'] = 'No employerID specified';
}

function getEmployerDetails($employerid) {
    $stmt = $GLOBALS['conn']->prepare("SELECT * FROM EmployerDetailView 
                            WHERE employerID = ?");
    $stmt->bind_param('s', $employerid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (isset($row['EmployerName'])) {
        return [NULL, $row];
    }
    return ['Couldnt find employer: ' . $employerid, NULL];
}

function printEmployerDetails($employerdetails) {
    // convert $employerdetails key/value array to pretty html
    // should add any fields I forgot to include, benefits etc
    return '<div class="col border p-4">
                    <h4>' . issetor($employerdetails['EmployerName']) . '</h4>
                    <h5>' . issetor($employerdetails['Email']) . '</h5>
                    <p>' . issetor($employerdetails['Phone']) . '</p>
                    <p>' . issetor($employerdetails['City']) . ', ' . issetor($employerdetails['StateID']) . '</p>
                    </div>';
}

printMain($inject);

?>
