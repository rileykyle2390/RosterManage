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
if($record['role'] == 'user' || $record['role'] == 'hc' ) die('Regular users cannot edit players. Please <a href="home.php">visit the home page.</a>');
if($record['role'] != 'su') $team = $record['teamID'];
$q = $pdo->prepare('SELECT * FROM users WHERE userID = ? ');
$q->execute([$_GET['id']]);
$record=$q->fetch();
if(isset($team)){
    if($record['teamID'] != $team) die('You can only delete your own employees if you are not an admin. You can <a href="admin_users.php">return to a list of your employees.</a>');
}
$pdo = null;
Template::showHeader('Delete User');
function delete(){
if(count($_POST)>0){
    require('settings.php');
    if($_POST['userID'] != $_GET['id']) return "Incorrect user ID number.";
    $pdo = DB::connect($settings);
    $q = $pdo->prepare('DELETE FROM `users` WHERE userID = ? ');
    $q->execute([$_POST['userID']]);
    echo 'You obliterated a user account. That is kinda cruel. You can <a href="admin_users.php">return to see those who remain.</a>';
    return "";
    
   
}
}
if(count($_POST)>0){
    $error = delete();
if(isset($error[0])) echo $error;
}
?>


<form action ="admin_delete_user.php?id=<?= $_GET['id'] ?>" method="POST">
<div class="form-group">
To delete a user, input the user's ID number. It is one plus the value in the text box.
<input name ="userID" value="<?= $record['userID'] - 1?>"required class="form-control"/>
</div>
<button type ="submit" class="btn btn-primary">Delete User</button>
</form>
<?php
Template::showFooter();