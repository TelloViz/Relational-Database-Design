<?php
require_once('../base.php');

session_start();

$inject = [
    "title" => "Create Job Posting"
];

// if user is not logged in ... redirect to login page
if(!isset($_SESSION['userid'])) {
    header('Refresh: 2;url=/cs332/auth/login.php');
    $inject['body'] = '<div class="container"><p class="alert-danger">Must Be Logged in. Redirecting...</p><a href="/cs332/auth/login.php">Click Here if you dont redirect automatically</a></div>';
}
// otherwise, user is registered & logged in
// create employer
else if ( isset($_SESSION['employerid']) ) {
    header('Refresh: 2;url=/cs332/employer/?employerid=' . $_SESSION['employerid']);
    $inject['body'] = '<div class="container"><p class="alert-danger">Already an Employer. Redirecting...</p><a href="/cs332/employer/?employerid=' . $_SESSION['employerid'] . '">Click Here if you dont redirect automatically</a></div>';
}
else {
    if(!empty($_POST['employername'])
    && !empty($_POST['email'])
    && !empty($_POST['phonenumber'])
    && !empty($_POST['streetaddress'])
    && !empty($_POST['city'])
    && !empty($_POST['state'])
    && !empty($_POST['zipcode'])
    && !empty($_POST['userrole'])) {

        [$error, $success] = makeEmployer($_POST['employername'], $_POST['email'], $_POST['phonenumber'],
                            $_POST['streetaddress'], $_POST['city'], $_POST['state'], $_POST['zipcode'], $_POST['userrole']);
        $inject['body'] = $_SESSION['employerid'];
        if($success) {
            header('Refresh: 2;url=/cs332/employer/?employerid=' . $_SESSION['employerid']);
            $inject['body'] = '<div class="container"><p>Successfully Created Employer as:' . $_SESSION['employerid'] .
            ', redirecting...</p><a href="/cs332/employer/?employerid=' . $_SESSION['employerid'] . '">Click Here if you dont redirect automatically</a></div>';
        }
        else {
            $inject = printEmployerForm($error);
        }
    }
    else {
        $inject = printJobPosting();
    }
}

printMain($inject);

function printJobPosting($error = "") {
    // create job posting
    $employerBody= '
    <div class="container">
        <div class="alert-danger"><p>' . $error . '</p></div>
        <h4>Create Job Posting</h4>
        <form action="employercreate.php" method="post">
            <div class="mb-3">
                <label for="Jobtitle" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="Jobtitle" name="Jobtitle" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
              <label for="Jobdesc">Job Description</label><br>
              <textarea id="Jobdesc" name="Jobdesc" rows="4" cols="50">
              </textarea>
            </div>
            <div class="mb-3"><br>
              <label for="Qual">Qualifications</label><br>
              <textarea id="Qual" name="Qual" rows="4" cols="50">
              </textarea>
            </div>
            <div class="mb-3"><br>
              <label for="responsibilities">Responsibilities</label><br>
              <textarea id="Qual" name="Qual" rows="4" cols="50">
              </textarea>
            </div>
            <div>
            <label for="jobtype" class="form-label">Job Type</label>
                <select name="userrole" id="userrole" required>
                    <option value="">--- Choose a role ---</option>
                    <option value="1">Full-Time</option>
                    <option value="2">Part-Time</option>
                    <option value="3">Contract</option>
                    <option value="4">Temporary</option>
                    <option value="5">Internship</option>
                </select>
            </div> <br>
            <div>
            <label for="edurequired" class="form-label">Education Required</label>
                <select name="edurequired" id="edurequired" required>
                    <option value="">--- Choose a role ---</option>
                    <option value="1">No Education Required</option>
                    <option value="2">High School Degree</option>
                    <option value="3">Associate Degree</option>
                    <option value="4">Bachelor Degree</option>
                    <option value="5">Master Degree</option>
                    <option value="6">Doctoral Degree</option>
                </select>
            </div>
            <div>
            <div class="mb-3">
            <br>
                <label for="StAddress" class="form-label">Street Address</label>
                <input type="phone" class="form-control" id="StAdress" name="StAddress" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city">
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" name="state">
            </div>
            <div class="mb-3">
                <label for="zipcode" class="form-label">ZipCode</label>
                <input type="text" class="form-control" id="zipcode" name="zipcode">
            </div>
            <div class="mb-3">
                <label for="contactinfo" class="form-label">Contact Info</label>
                <input type="text" class="form-control" id="contactinfo" name="contactinfo">
            </div>
            <div class="mb-3">
              <label for="dateposted">Current Date</label>
              <input type="date" id="dateposted" name="dateposted">
            </div>
            </div> <br>
            <div class="mb-3">
              <label for="deadline">Application Deadline</label>
              <input type="date" id="deadline" name="deadline">
            </div><br><br>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div> ';

    $inject= [
    "body" => $employerBody,
    "title" => "Create Employer"
    ];
    return $inject;
}
