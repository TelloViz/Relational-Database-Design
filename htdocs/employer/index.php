<?php 
require_once('../base.php');

// check if url like localhost/cs332/employer/?employerid=12345
if (isset($_GET['employerid'])) {
    // look up employer 12345 from url in sql
    // htmlspecialchars is a safety precaution
    [$error, $employerdetails] = getEmployerDetails(htmlspecialchars($_GET['employerid']));
    if (isset($employerdetails)) {
        $inject = printemployerDetails($employerdetails);
    }
    else {
        $inject = [
            'body' => '<div class="alert-danger"><h6>' . $error . '</h6></div>',
            'title' => 'employer Error - ' . $error
        ];
    }
}
else {
    $inject = [
        'body' => '<div class="alert-danger"><h6>No employerID specified</h6></div>',
        'title' => 'employer Error - No employerID'
    ];
}

function getEmployerDetails($employerid) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
    $stmt = $conn->prepare("SELECT * FROM EmployerDetailView 
                            WHERE employerID = ?");
/*
    $stmt = $conn->prepare("SELECT E.EmployerName, E.Email, E.Phone, Z.City, Z.StateID
                            FROM employers AS E 
                                INNER JOIN Addresses AS A ON E.AddressID = A.AddressID
                                INNER JOIN ZipCodes AS Z ON A.ZipCodeID = Z.ZipCodeID
                            WHERE employerID = ?");
                            */
    $stmt->bind_param('s', $employerid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $conn->close();
    if (isset($row['EmployerName'])) {
        return [NULL, $row];
    }
    return ['Couldnt find employer: ' . $employerid, NULL];
}

function printEmployerDetails($employerdetails) {
    // convert $employerdetails key/value array to pretty html
    // should add any fields I forgot to include, benefits etc
    $employerbody = '<div class="col border p-4">
                    <h4>' . issetor($employerdetails['EmployerName']) . '</h4>
                    <h5>' . issetor($employerdetails['Email']) . '</h5>
                    <p>' . issetor($employerdetails['Phone']) . '</p>
                    <p>' . issetor($employerdetails['City']) . ', ' . issetor($employerdetails['StateID']) . '</p>
                    </div>';
    $inject = [
        'body' => $employerbody,
        'title' => 'employer - ' . issetor($employerdetails['Title'])
    ];
    return $inject;
}

printMain($inject);

?>
