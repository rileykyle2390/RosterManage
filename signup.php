<?php
require_once('settings.php');
require_once('user.php');
require_once('authentication_library.php');
require_once('template.php');
session_start();
if(is_logged()) header('location: home.php');
if(count($_POST)>0){
$error = signup();
if(isset($error[0])) echo $error;
else header('location: signin.php');
}
Template::showHeader('Sign Up');
?>
<form action ="signup.php" method="POST">
<div class="form-group">
E-mail
<input type = "email" name ="email" required class="form-control"/>
</div>
<div class="form-group">
Password
<input type = "password" name ="password" required minlength= "8" pattern =".{8,}" class="form-control"/>
</div>
<div class="form-group">
First Name
<input type = "text" name ="first_name" required class="form-control"/>
</div>
<div class="form-group">
Last Name
<input type = "text" name ="last_name" required class="form-control"/>
</div>
<button type ="submit" class = "btn btn-primary">Create account</button>
<p>
Already have an account? <a href="signin.php">Log in to your account</a>
</p>
</form>
<?php
Template::showFooter();