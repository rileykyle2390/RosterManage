<?php
require_once('settings.php');
require_once('functions.php');
require_once('db.php');
require_once('authentication_library.php');
require_once('template.php');
session_start();
if(!is_logged()) header('location: signin.php');
if(!isset($_GET['id']) || $_GET['id'] < 0){
    echo 'We are not sure how you got here. Please visit <a href="home.php">the Home Page</a>';
    die();
  }
$pdo=DB::connect($settings);
$q = $pdo->prepare('SELECT * FROM users WHERE userID = ? ');
$q->execute([$_SESSION['user/ID']]);
$record=$q->fetch();
if($record['role'] == 'user' || $record['role'] == 'hc') die('Regular users and head coaches cannot edit users. Please <a href="home.php">visit the home page.</a>');
if($record['role'] != 'su') $team = $record['teamID'];
$q = $pdo->prepare('SELECT * FROM users WHERE userID = ? ');
$q->execute([$_GET['id']]);
$record=$q->fetch();
if(isset($team)){
    if($record['teamID'] != $team || $record['role'] != "hc") die('You can only edit head coaches if you are a general manager. You can <a href="admin_users.php">return to a list of your employees.</a>');
}
$pdo = null;
Template::showHeader('Edit User');

function edit(){
if(count($_POST)>0){
    require('settings.php');
    //Must make sure we do not create 2 accounts with the same email
    //Do not need to edit Team ID.
    $pdo = DB::connect($settings);
    $q = $pdo->prepare('SELECT * FROM users WHERE email = ? and userID != ?');
    $q-> execute([$_POST['email'], $_GET['id']]);
    if($q->rowCount() != 0 ) return 'Another user exists with that email. Cannot have duplicates.';
    $q = $pdo-> prepare('UPDATE users SET first_name= ?,last_name=?,email = ?
    WHERE userID = ?');
    $q->execute([$_POST['first_name'], $_POST['last_name'],$_POST['email'], $_GET['id']]);
    echo 'You successfully edited a user.  You can <a href="admin_users.php">return to a list of your users.</a>';
    return "";
}
}
if(count($_POST)>0){
    $error = edit();
if(isset($error[0])) echo $error;
}
?>


<form action ="admin_modify_user.php?id=<?= $_GET['id'] ?>" method="POST">
<div class="form-group">
User ID
<input name ="userID" value="<?= $record['userID'] ?>" readonly class="form-control"/>
</div>
<div class="form-group">
First Name
<input name ="first_name" value="<?= $record['first_name'] ?>" required class="form-control"/>
</div>
<div class="form-group">
Last Name
<input name ="last_name" value="<?= $record['last_name'] ?>"required class="form-control"/>
</div>
<div class="form-group">
Email
<input type = "email" name ="email" value="<?= $record['email'] ?>"required class="form-control"/>
</div>
<button type ="submit" class ="btn btn-primary">Edit User</button>
</form>
<?php
Template::showFooter();