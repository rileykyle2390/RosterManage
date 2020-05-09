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
    if($record['teamID'] != $team) die('You can only edit your own players if you are not an admin.  You can <a href="admin_players.php">return to a list of your players.</a>');
}
$pdo = null;
Template::showHeader('Edit Player');

function edit(){
if(count($_POST)>0){
    require('settings.php');
    //Must make sure we do not create 2 players with the same number on the same team
    $pdo = DB::connect($settings);
    $q = $pdo->prepare('SELECT * FROM player WHERE playerID = ?');
    $q->execute([$_POST['playerID']]);
    $player = $q->fetch();
    $q = $pdo->prepare('SELECT * FROM player WHERE number = ? and teamID = ? and playerID != ?');
    $q-> execute([$_POST['number'], $player['teamID'], $_POST['playerID']]);
    if($q->rowCount() != 0 ) return 'Another player on the team is already using that number. Cannot have duplicates.';
    $q = $pdo-> prepare('UPDATE player SET age = ?,experience = ?,college=?,height=?,weight=?,position=?,first_name=?,last_name=?,picture = ?, number = ?
    WHERE playerID = ?');
    $q->execute([$_POST['age'], $_POST['experience'], $_POST['college'], $_POST['height'], $_POST['weight'], $_POST['position'], $_POST['first_name'], $_POST['last_name'],$_POST['picture'], $_POST['number'], $_POST['playerID']]);
    echo 'You successfully edited a player.  You can <a href="admin_players.php">return to a list of your players.</a>';
    return "";
}
}
if(count($_POST)>0){
    $error = edit();
if(isset($error[0])) echo $error;
}
?>


<form action ="edit.php?id=<?= $_GET['id'] ?>" method="POST">
<div class="form-group">
Player ID
<input name ="playerID" value="<?= $record['playerID'] ?>" readonly class="form-control"/>
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
Number
<input name ="number" value="<?= $record['number'] ?>"required class="form-control"/>
</div>
<div class="form-group">
Age
<input name ="age" value="<?= $record['age'] ?>" required class="form-control"/>
</div>
<div class="form-group">
Position
<input name ="position" value="<?= $record['position'] ?>" required class="form-control"/>
</div>
<div class="form-group">
Height
<input name ="height" value="<?= $record['height'] ?>" required class="form-control"/>
</div>
<div class="form-group">
Weight
<input name ="weight" value="<?= $record['weight'] ?>" required class="form-control"/>
</div>
<div class="form-group">
Experience
<input name ="experience" value="<?= $record['experience'] ?>" required class="form-control"/>
</div>
<div class="form-group">
College
<input name ="college" value="<?= $record['college'] ?>"required class="form-control"/>
</div>
<div class="form-group">
Link to picture
<input name ="picture" value="<?= $record['picture'] ?>"required class="form-control"/>
</div>
<button type ="submit" class= "btn btn-primary">Edit player</button>
</form>
<?php
Template::showFooter();