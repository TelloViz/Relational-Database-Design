<?php
require_once('base.php');

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
  $inject = [
      'title' => 'All Job Posts',
      'body' => ''
  ];
  [$error, $posts] = getAllPosts();
  if (isset($posts)) {
      $inject['body'] = printPosts($posts);
  }
  else {
      $inject['warning'] = 'Failed to fetch job posts. ' . $error;
  }
  return $inject;
}

if (doesDBExist()) {
  $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database'], $GLOBALS['port']);
  require_once('posts/getposts.php');
  $inject = printHomepage();
}
else {
  $inject = printInitTableLink();
}
printMain($inject);

?>

