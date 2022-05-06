<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "schemers";
$port = 3306;

function runSQLFile($relativepath, $servername, $username, $password, $database, $port) {

  $basepath = dirname( dirname(__FILE__) ); //gives parent of parent of current file
  $scriptfullpath = $basepath . $relativepath;

  $conn = new mysqli($servername, $username, $password, $database, $port);

  $query = $conn->query("SHOW VARIABLES LIKE 'basedir'");
  $row = $query->fetch_assoc();
  $sqldir = $row['Value'] . '/bin'; //gets the location of cmd 'mysql' so we can execute .sql files with it without it being on path

  $command = "mysql --user='{$username}' --password='{$password}' -h '{$servername}' -D '{$database}' < '{$scriptfullpath}'";
  $output = shell_exec($sqldir . '/' . $command);
  return $output;
}

try {
  $res1 = runSQLFile('/createtables.sql', $servername, $username, $password, '', $port);
  $res2 = runSQLFile('/CreateAndPopulate_States_ZipCodes.sql', $servername, $username, $password, $database, $port);
  $res3 = runSQLFile('/MOCK_AddressTable_creation.sql', $servername, $username, $password, $database, $port);

  $inject = [
    "body" => "<div class='container'>
                <a href='/cs332/'>Return Home</a>
                <ul>
                  <li>Create DB and Tables output: {$res1}</li>
                  <li>Create DB and Tables output: {$res2}</li>
                  <li>Create DB and Tables output: {$res3}</li>
                </ul>
              </div>",
    "title" => "Initialize the db success"
  ];
}
catch (Exception $e) {
  $inject = [
    "title" => "Initlize the db failed",
    "body" => "Failed to initialize the db, error: {$e->getMessage()}"
  ];
}

require_once('base.php');
printMain($inject);
?>

