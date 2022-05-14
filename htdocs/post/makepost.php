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
function getJobTypeOpts() {
    try {
        $result = $GLOBALS['conn']->query("SELECT JobTypeID, Title FROM JobTypes");
        $jobtypes = $result->fetch_all(MYSQLI_ASSOC);
        if (isset($jobtypes)) {
            return [NULL, $jobtypes];
        }
        return ['Failed to find Education levels.', NULL];
    }
    catch (Exception $e) {
        return ['Failed to find Education levels. ' . $e, NULL];
    }
}

function printOneOpt($val, $text) {
    return '<option value="' . $val . '">' . $text . '</option>';
}
// this took more fanegaling than expected
function printAsOpts($rows, $val_key, $text_key) {
    $opts = "";
    if (isset($rows[0])) {
        return printOneOpt('', $rows[0]); //error message
    }
    else {
        foreach ($rows[1] as $row) {
            if (isset($row)) {
                $opts = $opts . printOneOpt($row[$val_key], $row[$text_key]);
            }
        }
        return $opts;
    }
}

function printPostForm($P = [], $error = "") {
    // set up create employer form
    return '<div class="container">  
                <div class="alert-danger"><p>' . issetor($error) . '</p></div>
                <h4>Post Job Listing</h4>  
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="post_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="post_title" name="post_title"' .
                            ifNotEmptyValueAttribute(issetor($P['post_title'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="post_desc" class="form-label">Job Description</label>
                        <input type="text" class="form-control" id="post_desc" name="post_desc"' .
                            ifNotEmptyValueAttribute(issetor($P['post_desc'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="post_qual" class="form-label">Qualifications</label>
                        <input type="text" class="form-control" id="post_qual" name="post_qual"' .
                            ifNotEmptyValueAttribute(issetor($P['post_qual'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="post_resp" class="form-label">Responsiblities</label>
                        <input type="textbody" class="form-control" id="post_resp" name="post_resp"' .
                            ifNotEmptyValueAttribute(issetor($P['post_resp'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="post_edu" class="form-label">Education</label>
                        <select class="form-select" id="post_edu" name="post_edu" required>' .
                        // Should update to selecting the one in $P['post_edu'] if there is one
                            printAsOpts(getEduOpts(), 'EducationID', 'Title') . 
                        '</select>
                    </div>
                    <div class="mb-3">
                        <label for="post_jobtype" class="form-label">Job Type</label>
                        <select class="form-select" id="post_jobtype" name="post_jobtype" required>' .
                        // Should update to selecting the one in $P['post_jobtype'] if there is one
                            printAsOpts(getJobTypeOpts(), 'JobTypeID', 'Title') . 
                        '</select>
                    </div>
                    <div class="mb-3">
                        <h6>Salary</h6>
                        <label for="post_sal_min" class="form-label">Min</label>
                        <input type="number" class="form-control" id="post_sal_min" name="post_sal_min">
                        <label for="post_sal_min" class="form-label">Max</label>
                        <input type="number" class="form-control" id="post_sal_max" name="post_sal_max">
                    </div>
                    <div class="mb-3">
                        <label for="post_dead" class="form-label">Deadline</label>
                        <input type="text" class="form-control" id="post_dead" name="post_dead" placeholder="YYYY-MM-DD"' .
                            ifNotEmptyValueAttribute(issetor($P['post_dead'])) .
                        'required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div> ';
}

?>
