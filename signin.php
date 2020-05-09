<?php
require_once('settings.php');
require_once('user.php');
require_once('authentication_library.php');
require_once('template.php');
session_start();
if(is_logged()) header('location: home.php');
if(count($_POST)>0){
    $error = signin();
    if(isset($error[0])) echo $error;
    else header('location: home.php');
}
Template::showHeader('Sign in');
?>

<form action ="signin.php" method="POST">
<div class="form-group">
E-mail
<input type = "email" name ="email" required class="form-control"/>
</div>
<div class="form-group">
Password
<input type = "password" name ="password" required minlength= "8" pattern =".{8,}" class="form-control"/>
</div>
<button type ="submit" class ="btn btn-primary">Log in</button>
<p>
Don't have an account? <a href="signup.php">Create your account</a>
</p>
</form>
<?php
Template::showFooter();