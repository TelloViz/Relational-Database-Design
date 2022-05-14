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
        isset($P['post_sal_min']) &&
        isset($P['post_edu']) &&
        isset($P['post_jobtype']))
    {
        if (
            checkEducationID($P['post_edu']) &&
            checkJobTypeID($P['post_jobtype']) &&
            checkExpReqID($P['post_qual'])
        )
        {
            return ['Would be success', NULL];
        }
    }
    else {
        return ["Missing Required Fields", NULL];
    }
}

function checkEducationID($eduid) {
    return TRUE;
}

function checkJobTypeID($jobtypeid) {
    return TRUE;
}

function checkExpReqID($expid) {
    return TRUE;
}

?>
