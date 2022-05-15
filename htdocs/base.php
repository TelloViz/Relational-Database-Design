
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "schemers";
$port = 3306;

session_start();

  function issetor(&$var, $default = false) {
      return isset($var) ? $var : $default;
  }

  function loginlinks() {
  return (isset($_SESSION['userid'])) ? ('
      <li class="nav-item">
        <a class="nav-link" href="/cs332/auth/account.php">Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/cs332/auth/logout.php">Log Out</a>
      </li>') :
      ('<li class="nav-item">
      <a class="nav-link" href="/cs332/auth/">Log In / Register</a>
    </li>');
  }
function employerlinks() {
  return (isset($_SESSION['employerid'])) ? ('
      <li class="nav-item">
        <a class="nav-link" href="/cs332/employer">Employer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/cs332/post">Post Job</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/cs332/post/createpost.php">Create Post</a>
      </li>
      </li>') : (
      '<li class="nav-item">
        <a class="nav-link" href="/cs332/employer/create.php">Create Employer</a>
      </li>');
  }

  //used to fill form with what the user submitted in case it fails
function ifNotEmptyValueAttribute($value) {
    if (isset($value)) {
        if ($value == "") {return "";}
        return ' value="' . htmlspecialchars($value) . '" ';
    }
    return "";
}

function printMain($inject) {

    echo '
  <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

      <title>' . issetor($inject['title']) . '</title>
    </head>
    <body class="p-0 m-0">
      <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="/cs332">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">' .
          /*
            <li class="nav-item">
              <a class="nav-link" href="/cs332/auth/register.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/cs332/auth/login.php">Log In</a>
            </li>
          */
          loginlinks() . 
          //employeelinks() . 
          employerlinks() . 
            '<li class="nav-item">
              <a class="nav-link" href="/cs332/search/">All Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/cs332/init.php">Reset DB</a>
            </li>
            <!--
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
            !-->
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

  <div class="alert-danger">' . issetor($inject['warning']) . '</div>
  <div class="alert-success">' . issetor($inject['success']) . '</div>
  ' . issetor($inject['body']) . '
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>';

}

?>