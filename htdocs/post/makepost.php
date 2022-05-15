<?php
require_once('../base.php');

// for reference
$s = "CREATE TABLE IF NOT EXISTS JobPosts (
    JobPostID INT(5) NOT NULL AUTO_INCREMENT,
    EmployerID INT(10) NOT NULL,
    EducationID INT(5) NOT NULL,
    JobTypeID INT(10) UNSIGNED NOT NULL,
    ExpReqID  INT(2) NOT NULL,
    AddressID INT(10) NOT NULL,
    SalaryMin INT(10) UNSIGNED NOT NULL,
    SalaryMax INT(10) UNSIGNED,
    CONSTRAINT SMaxAboveSMin CHECK( SalaryMax >= SalaryMin ),

    Title VARCHAR(255) NOT NULL,
    JobDesc TEXT,
    JobResp TEXT,
    JobQual TEXT,
    ContactEmail VARCHAR(255) NOT NULL,
    ContactPhone  VARCHAR(15),
    ContactMessage TEXT,

    Time_Stamp DATETIME NOT NULL DEFAULT NOW(),
    DatePosted DATETIME,
    DeadLine DATETIME,

    PRIMARY KEY (JobPostID),
    FOREIGN KEY (EmployerID) REFERENCES Employers(EmployerID),
    FOREIGN KEY (EducationID) REFERENCES Education(EducationID),
    FOREIGN KEY (JobTypeID) REFERENCES JobTypes(JobTypeID),
    FOREIGN KEY (ExpReqID) REFERENCES ExpReq(ExpReqID),
    FOREIGN KEY (AddressID) REFERENCES Addresses(AddressID)
);";

function makePost($P) {
    if (isset($P['post_title']) &&  
        isset($P['post_desc']) &&  
        isset($P['post_qual']) &&  
        isset($P['post_expreq']) &&  
        isset($P['post_resp']) &&  
        isset($P['post_sal']) &&
        isset($P['post_edu']) &&
        isset($P['post_jobtype']))
    {
        //validate FK constraints before trying to post
        [$eduerr, $eduid] = checkEducationID($P['post_edu']);
        [$jteerr, $jobtypeid] = checkJobTypeID($P['post_jobtype']);
        [$experr, $expreqid] = checkExpReqID($P['post_expreq']);
        [$deaderr, $deadformatted] = checkDeadlineFormat($P['post_dead']);
        if ( isset($eduid) && isset($jobtypeid) && isset($expreqid) && isset($deadformatted)) {
            // Should try to actuall insert into post table now
            try {
                $email = (isset($P['post_cont_email'])) ? ($P['post_cont_email']) : ($_SESSION['employeremail']);

                $stmt = $GLOBALS['conn']->prepare("INSERT INTO JobPosts
                    (EmployerID, EducationID, JobTypeID, ExpReqID ,
                        SalaryID, Title, JobDesc, JobResp, JobQual,
                        ContactEmail, ContactPhone, ContactMessage, Deadline)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bind_param('iiiiisssssssi',
                    $_SESSION['employerid'], $eduid, $jobtypeid, $expreqid,
                    $P['post_sal'], $P['post_title'], $P['post_desc'], $P['post_resp'], $P['post_qual'],
                    $email, $P['post_cont_phone'], $P['post_cont_msg'],$deadformatted);
                $stmt->execute();
                $jobpostid = $stmt->insert_id;
                if (isset($jobpostid)) {
                    return [NULL, $jobpostid];
                }
                else {
                    return ['Failed to create job post. ' . $stmt->error, NULL];
                }
            }
            catch (Exception $e) {
                return ['Catch: Failed to create job post. ' . $e, NULL];
            }
        }
        else //couldn't validate foreign key constraints
        {
            return ['Error: ' . issetor($eduerr) . issetor($jterr) . issetor($experr) . issetor($deaderr) , NULL];
        }
    }
    else {
        return ["Missing Required Fields", NULL];
    }
}

function checkEducationID($eduid) {
    try {
        $stmt = $GLOBALS['conn']->prepare("SELECT EducationID, Title FROM Education WHERE EducationID = ?");
        $stmt->bind_param('i', $eduid);
        $stmt->execute();
        $result = $stmt->get_result();
        $edulev = $result->fetch_assoc();
        if (isset($edulev)) {
            return [NULL, TRUE];
        }
        return ['Failed to find Education level: ' . $eduid, NULL];
    }
    catch (Exception $e) {
        return ['Failed to find Education level: ' . $eduid . $e, NULL];
    }
}

function checkExpReqID($expid) {
    try {
        $stmt = $GLOBALS['conn']->prepare("SELECT ExpReqID, Title FROM ExpReq WHERE ExpReqID = ?");
        $stmt->bind_param('i', $expid);
        $stmt->execute();
        $result = $stmt->get_result();
        $expreq = $result->fetch_assoc();
        if (isset($expreq)) {
            return [NULL, $expreq];
        }
        return ['Failed to find Experience level: ' . $expid, NULL];
    }
    catch (Exception $e) {
        return ['Failed to find Experience level: ' . $expid . $e, NULL];
    }
}

function checkJobTypeID($jobtypeid) {
    try {
        $stmt = $GLOBALS['conn']->prepare("SELECT JobTypeID, Title FROM JobTypes WHERE JobTypeID = ?");
        $stmt->bind_param('i', $jobtypeid);
        $stmt->execute();
        $result = $stmt->get_result();
        $jobtype = $result->fetch_assoc();
        if (isset($jobtype)) {
            return [NULL, $jobtype];
        }
        return ['Failed to find JobTypeID: ' . $jobtypeid, NULL];
    }
    catch (Exception $e) {
        return ['Failed to find JobTypeID: ' . $jobtypeid . $e, NULL];
    }
}

function checkDeadlineFormat($deadline) {
    // should use regex or something to see if in sql date format
    // or, nicely receive any format and try to make into sql format, return as 'YYYY-MM-DD'
    return [NULL, $deadline];
}

?>
