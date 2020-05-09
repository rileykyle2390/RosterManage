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
if($record['role'] == 'user') die('Regular users cannot edit players. Please <a href="home.php">visit the home page.</a>');
if($record['role'] != 'su') $team = $record['teamID'];
$q = $pdo->prepare('SELECT * FROM player WHERE playerID = ? ');
$q->execute([$_GET['id']]);
$record=$q->fetch();
if(isset($team)){
    if($record['teamID'] != $team) die('You can only drop your own players if you are not an admin.  You can <a href="admin_players.php">return to a list of your players.</a>');
}
$pdo = null;
Template::showHeader('Drop Player');
function delete(){
if(count($_POST)>0){
    require('settings.php');
    if($_POST['playerID'] != $_GET['id']) return "Incorrect player ID number.";
    $pdo = DB::connect($settings);
    $q = $pdo->prepare('DELETE FROM `player` WHERE playerID = ? ');
    $q->execute([$_POST['playerID']]);
    echo 'You dropped a player. You can <a href="admin_players.php">return to a list of your players.</a>';
    return "";
    
   
}
}
if(count($_POST)>0){
    $error = delete();
if(isset($error[0])) echo $error;
}
?>


<form action ="delete.php?id=<?= $_GET['id'] ?>" method="POST">
<div class="form-group">
To drop player, input this player's ID number. It is one plus the value in the text box.
<input name ="playerID" value="<?= $record['playerID'] - 1?>"required class="form-control"/>
</div>
<button type ="submit" class="btn btn-primary">Drop Player</button>
</form>
<?php
Template::showFooter();