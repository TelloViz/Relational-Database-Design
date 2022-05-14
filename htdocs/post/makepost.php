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
    return ["Error", NULL];
}

?>
