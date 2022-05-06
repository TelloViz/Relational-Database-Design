<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "schemers";
$port = 3306;
?>

<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$body = '<div class="container text-center">
          <h4>Home Page</h4>
          <p>Connected Successfully</p>
        </div>';

$inject = [
  "body" => $body,
  "title" => "Schemers Job Search"
];

require_once('base.php');
printMain($inject);

?>

