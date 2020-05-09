<?php
require_once('settings.php');
require_once('functions.php');
require_once('db.php');
require_once('authentication_library.php');
require_once('template.php');
session_start();
if(!is_logged()) header('location: signin.php');
$pdo=DB::connect($settings);
$q = $pdo->prepare('SELECT * FROM users WHERE userID = ? ');
$q->execute([$_SESSION['user/ID']]);
$record=$q->fetch();
if($record['role'] != 'su') die('Only site admins can add users. Instead, <a href="signup.php">you can sign up.</a>');
$pdo = null;
Template::showHeader('Create User');

function create(){
if(count($_POST)>0){
    require('settings.php');
    //Check if the user already exists. Emails can never conflict so that is how we check
    $pdo = DB::connect($settings);
    $q = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $q->execute([$_POST['email']]);
    if($q->rowCount() > 0)
        return 'There is already a user with that email.'; 
    if ($_POST['teamID'] == "NULL") $teamID = null;
    else $teamID = $_POST['teamID'];
    $q = $pdo-> prepare('INSERT INTO users(teamID, email, first_name, last_name, password, role)
    VALUES(?,?,?,?,?,?)');
    $q->execute([$teamID, $_POST['email'], $_POST['first_name'], $_POST['last_name'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['role']]);
    echo 'You successfully added a user. Now you can <a href="admin_users.php"> view the users</a>.';
    return "";
}
}
if(count($_POST)>0){
    $error = create();
if(isset($error[0])) echo $error;
}
?>



<form action ="admin_create_user.php" method="POST">
    <div class="form-group">
        <label for="teamID">TeamID</label>
        <input name ="teamID" class="form-control" value ="NULL"/>
        <small id="teamIDInfo" class="form-text text-muted">For a normal user- make sure this is set to NULL</small>
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input name ="first_name" class="form-control" required/>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input name ="last_name"  class="form-control" required />
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type = "email" name ="email" class="form-control" required/>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <input name ="role" required class="form-control" value ="user"/>
    </div>
    <div class="form-group"> 
        <label for="password">Password</label>
        <input type = "password" name ="password" required minlength= "8" pattern =".{8,}" class="form-control"/>
    </div>
    <button type ="submit" class = "btn btn-primary">Add user</button>
</form>
<?php
Template::showFooter();