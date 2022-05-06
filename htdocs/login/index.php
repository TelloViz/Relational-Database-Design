<?php 

// set up login page
$loginBody= '
<div id = "frm"; style="text-align: center;">  
    <h1>Create Account Login</h1>  
        <form name="Login" action="login.php" onsubmit="return validation()" method="POST">  
            <p>  
                <label> Create User Name: </label>  
                <input type="text" id="UserID" name="user" />  
            </p>  
            <p>  
                <label> Create Password: </label>  
                <input type="password" id ="Password" name="pass" />  
            </p>  
            <p>     
                <input type ="submit" id ="btn" value ="Create Account" />  
            </p>  
        </form>  
    </div> ';

$injectLogin = [
"body" => $loginBody,
"title" => "Login Page"
];

require_once('../base.php');
printMain($injectLogin);


?>