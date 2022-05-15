<?php

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

function getExpReqOpts() {
    try {
        $result = $GLOBALS['conn']->query("SELECT ExpReqID, Title FROM ExpReq");
        $jobtypes = $result->fetch_all(MYSQLI_ASSOC);
        if (isset($jobtypes)) {
            return [NULL, $jobtypes];
        }
        return ['Failed to find Experience Required levels.', NULL];
    }
    catch (Exception $e) {
        return ['Failed to find Experience Required levels. ' . $e, NULL];
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

function getSalaryOpts() {
    try {
        $result = $GLOBALS['conn']->query("SELECT SalaryID, Title FROM Salary");
        $salaries = $result->fetch_all(MYSQLI_ASSOC);
        if (isset($salaries)) {
            return [NULL, $salaries];
        }
        return ['Failed to find Salary levels.', NULL];
    }
    catch (Exception $e) {
        return ['Failed to find Salary levels. ' . $e, NULL];
    }
}


function printPostForm($P = [], $error = "") {
    // set up create employer form
    return '<div class="container">  
                <div class="alert-danger"><p>' . issetor($error) . '</p></div>
                <h4>Post Job Listing</h4>  
                <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="post_title" class="form-label">* Title</label>
                        <input type="text" class="form-control" id="post_title" name="post_title"' .
                            ifNotEmptyValueAttribute(issetor($P['post_title'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="post_desc" class="form-label">Job Description</label>
                        <textarea class="form-control" id="post_desc" name="post_desc" rows="4" cols="50">' .
                            issetor($P['post_desc']) .
                        '</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="post_qual" class="form-label">Qualifications</label>
                        <textarea class="form-control" id="post_qual" name="post_qual" rows="4" cols="50">' .
                            issetor($P['post_qual']) .
                        '</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="post_resp" class="form-label">Responsiblities</label>
                        <textarea class="form-control" id="post_resp" name="post_resp" rows="4" cols="50">' .
                            issetor($P['post_resp']) .
                        '</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="post_edu" class="form-label">* Education</label>
                        <select class="form-select" id="post_edu" name="post_edu" required>' .
                        // Should update to selecting the one in $P['post_edu'] if there is one
                            printAsOpts(getEduOpts(), 'EducationID', 'Title') . 
                        '</select>
                    </div>
                    <div class="mb-3">
                        <label for="post_expreq" class="form-label">* Experience Required</label>
                        <select class="form-select" id="post_expreq" name="post_expreq" required>' .
                            printAsOpts(getExpReqOpts(), 'ExpReqID', 'Title') . 
                        '</select>
                    </div>
                    <div class="mb-3">
                        <label for="post_jobtype" class="form-label">* Job Type</label>
                        <select class="form-select" id="post_jobtype" name="post_jobtype" required>' .
                        // Should update to selecting the one in $P['post_jobtype'] if there is one
                            printAsOpts(getJobTypeOpts(), 'JobTypeID', 'Title') . 
                        '</select>
                    </div>
                    <div class="mb-3">
                        <h6>Salary</h6>
                        <label for="post_sal" class="form-label">* Salary Range</label>
                        <select class="form-select" id="post_sal" name="post_sal" required>' .
                            printAsOpts(getSalaryOpts(), 'SalaryID', 'Title') . 
                        '</select>
                    </div>
                    <div class="mb-3">
                        <label for="post_cont_email" class="form-label">* Contact Email</label>
                        <input type="text" class="form-control" id="post_cont_email" name="post_cont_email"' .
                            ifNotEmptyValueAttribute((isset($P['post_cont_email'])) ? ($P['post_cont_email']) : ($_SESSION['employeremail'])) .
                        'required>
                    </div>
                    <div class="mb-3">
                        <label for="post_dead" class="form-label">* Deadline</label>
                        <input type="date" class="form-control" id="post_dead" name="post_dead" placeholder="YYYY-MM-DD"' .
                            ifNotEmptyValueAttribute(issetor($P['post_dead'])) .
                        'required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div> ';
}

?>
