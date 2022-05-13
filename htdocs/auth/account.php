<?php

require_once('../base.php');
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);

$inject = [
    'title'=>'User Account',
];

if (isset($_SESSION['userid'])) {
    [$error, $userinfo] = getUserInfo($_SESSION['userid']);
    if ($error) {
        header('Refresh:2;url=/cs332/auth');
        $inject['error'] = $error;
    }
    $inject['body'] = printUserInfo($userinfo);
    printMain($inject);
}
$conn->close();



function getUserInfo($userid) {
    // should really use bycrpt for passwords
    $stmt = $GLOBALS['conn']->prepare("SELECT ua.UserID, ua.Email, ua.Firstname, ua.Lastname, ua.EmployeeID
                                        FROM useraccount AS ua WHERE ua.UserID = ?"); // join on employeradmin to get employer link?
    $stmt->bind_param('i', $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (isset($row['UserID'])) {
        return [NULL, $row];
    }
    else {
        return ['User info not found...try logging in again.', NULL];
    }
}

function printUserInfo($userinfo) {
    //check out login.php, use issetor($userinfo['Email']) etc, the string in the brackets is case sensitive, must match the select above
    $userprofilepage = '<div class="container">
                            <h4>User Profile</h4>
                                <p>' . issetor($userinfo['Email']) . '
                                <p>' . issetor($userinfo['Firstname']) . '
                                <p>' . issetor($userinfo['Lastname']) . '
                                <p>' . issetor($userinfo['EmployeeID']) . '
                                <p>' . issetor($userinfo['EmployerID']) . '
                        </div>';
    return $userprofilepage;
}

?>
