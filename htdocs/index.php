<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "schemers";
$port = 3306;

function doesDBExist() {
  $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], '', $GLOBALS['port']);
  $s = 'SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME="' . $GLOBALS['database'] . '"';
  $query = $conn->query($s);
  $row = $query->fetch_object();
  $dbExists = (bool) $row->exists;
  $conn->close();
  return $dbExists;
}

function printInitTableLink() {

  $body = '<div class="container text-center">
            <h4>DB not initialized yet</h4>
            <form action="/cs332/init.php" method="POST">
              <button type="submit" class="btn btn-primary">Create DB and populate with data</button>
            </form>
          </div>';

  $inject = [
    "body" => $body,
    "title" => "Schemers Job Search - Not created yet"
  ];

  return $inject;
}

function printHomepage() {
  //$conn = new mysqli($servername, $username, $password, $database, $port);

  $body = '<div class="container text-center">
            <h4>Home Page</h4>
            <p>Connected Successfully</p>
          </div>';

  $inject = [
    "body" => $body,
    "title" => "Schemers Job Search"
  ];

  return $inject;
}




if (doesDBExist()) {
  $inject = printHomepage();
}
else {
  $inject = printInitTableLink();
}

require_once('base.php');
printMain($inject);

?>

