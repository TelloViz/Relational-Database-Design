<?php
  require_once('../base.php');

  function printLogin($injectLogin) {
    echo '
    <html>  
    <head>  
        <title>' . issetor($injectLogin['title']) . '</title> 
    </head>
      <body>
        '. issetor($injectLogin['body']) .'
      </body>

      <!-- Insert script here to insert data into database TABLE UserAccount-->

    </html>';
  }
?>