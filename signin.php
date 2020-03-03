<?php
require_once('authentication_library.php');
if(count($_POST)>0){
    $error = signin('user_info.csv.php');
    if(isset($error[0])) echo $error;
}
?>
<h1> Sign in </h1>
<form action ="signin.php" method="POST">
E-mail
<input type = "email" name ="email" required/> <br />
Password
<input type = "password" name ="password" required minlength= "8" pattern =".{8,}"/> <br />
<button type ="submit">Log in</button>
</form>