<?php 
require_once('../base.php');

$inject = [
    'title' => 'Required Views',
    'body' => '<div class="container">
                <ul>
                    <li><a href="getEmpGT3Posts.php">Get Employers with 3 or more Job Posts</a></li>
                    <li><a href="getEmployeesWhoApplied.php">Get Employees who applied to at least one job</a></li>
                    <li><a href="getEmployeesAndEmployers.php">Get Users that are both Employees and Employers</a></li>
                </ul>
               </div>'

];

printMain($inject);

?>
