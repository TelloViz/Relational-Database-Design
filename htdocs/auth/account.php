<?php

require_once('../base.php');
$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);

$inject = [
    'title'=>'User Account',
    'warning' => '',
    'body' => ''
];

if (isset($_SESSION['userid'])) {
    [$error, $userinfo] = getUserInfo($_SESSION['userid']);
    if ($error) {
        $inject['warning'] = $error;
    }
    else if (isset($_POST['edulevel'])) {
        [$error, $userinfo] = makeOrUpdateEmployee($userinfo, htmlspecialchars($_POST['edulevel']));
        if ($error) {
            $inject['warning'] = $error;
        }
    }
    $inject['body'] = printUserInfo($userinfo);
}
else {
    header('Redirect: 2;url=/cs332/auth');
}
printMain($inject);
$conn->close();

function makeOrUpdateEmployee($userinfo, $edulevel) {
    if (isset($userinfo['EducationID'])) {
        // don't update
        if ($userinfo['EducationID'] === $edulevel) {
            return ['Nothing Changed.', $userinfo];
        }
        else {
            // update existing employee
            [$updateerror, $success] = updateEmployee($userinfo['EmployeeID'], $edulevel );
            if (isset($success)) {
                $userinfo['EducationID'] = $edulevel;
                return ['Updated to ' . $edulevel , $userinfo];
            }
            else {
                return ['Update Error. ' . $updateerror, $userinfo];
            }
        }
    }
    else {
        //make new employee
        [$error, $employeeid] = insertEmployee($edulevel);
        if (isset($employeeid)) {
            [$usererror, $success] = updateUserAccount($userinfo['UserID'], $employeeid);
            if (isset($success)) {
                $userinfo['EducationID'] = $edulevel;
                $userinfo['EmployeeID'] = $employeeid;
                return ['Added education ' . $edulevel, $userinfo];
            }
            else { 
                return ['Failed to update user to reference employee. ' . $error . $usererror, NULL];
            } 
        }
        else {
            return ['Failed to create employee. ' . $error, NULL];
        }
    } 
}

function updateEmployee($employeeid, $edulevel) {
    $stmt = $GLOBALS['conn']->prepare("UPDATE Employee SET EducationID=? WHERE Employee.EmployeeID = ?");
    $stmt->bind_param('ii', $edulevel, $employeeid);
    $stmt->execute();
    $result = $stmt->affected_rows;
    if ($result > 0) {
        return [NULL, $result];
    }
    return ['Failed to update Employee table. ' . $stmt->error, NULL];
}

function updateUserAccount($userid, $employeeid) {
    $stmt = $GLOBALS['conn']->prepare("UPDATE UserAccount SET EmployeeID=? WHERE UserAccount.UserID = ?");
    $stmt->bind_param('ii', $employeeid, $userid);
    $stmt->execute();
    $result = $stmt->affected_rows;
    if ($result) {
        return [NULL, $result];
    }
    return ['Failed to update User Account. ' . $stmt->error, NULL];
}

function insertEmployee($edulevel) {
    $stmt = $GLOBALS['conn']->prepare("INSERT INTO Employee (EducationID) VALUES (?)");
    $stmt->bind_param('i', $edulevel);
    $stmt->execute();
    $employeeid = $stmt->insert_id;
    if (isset($employeeid)) {
        return [NULL, $employeeid];
    }
    else {
        return ['Failed to insert employee. ' . $stmt->error, NULL];
    }
}

function getUserInfo($userid) {
    try {
    // should really use bycrpt for passwords
        $stmt = $GLOBALS['conn']->prepare("SELECT ua.UserID, ua.Email, ua.Firstname, ua.Lastname, ua.EmployeeID, ee.EducationID
                                            FROM useraccount AS ua
                                            LEFT JOIN Employee AS ee ON ua.EmployeeID = ee.EmployeeID
                                            WHERE ua.UserID = ?");
        $stmt->bind_param('i', $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        var_dump($row);
        if (isset($row['UserID'])) {
            return [NULL, $row];
        }
        else {
            return ['User info not found...try logging in again.' . $stmt->error, NULL];
        }
    }
    catch (Exception $e) {
        return ['Failed to find user info. ' . $e, NULL];
    }
}

function getEduOpts() {
    try {
        $result = $GLOBALS['conn']->query("SELECT EducationID, Title FROM Education");
        $edulevs = $result->fetch_all(MYSQLI_ASSOC);
        if (isset($edulevs)) {
            return [NULL, $edulevs];
        }
        return ['Failed to find Education levels.', NULL];
    }
    catch (Exception $e) {
        return ['Failed to find Education levels. ' . $e, NULL];
    }
}

function printUserInfo($userinfo) {
    //check out login.php, use issetor($userinfo['Email']) etc, the string in the brackets is case sensitive, must match the select above
    return '<div class="container justify-content-md-center">
                <h4>User Profile</h4>
                    <p>' . issetor($userinfo['Email']) . '
                    <p>' . issetor($userinfo['Firstname']) . '
                    <p>' . issetor($userinfo['Lastname']) . '
                    <p>' . issetor($userinfo['EmployeeID']) . '
                    <p>' . issetor($userinfo['EmployerID']) . '
                <form class="form" action="account.php" method="POST">
                    <div class="input-group flex-nowrap">
                            <span for="edulevel" class="input-group-text">Education Level:</span>
                            <select class="form-control" name="edulevel" id="edulevel">' .
                                printAsOpts(getEduOpts(), 'EducationID', 'Title', issetor($userinfo['EducationID'])) . 
                            '</select>
                            <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>';
}

?>
