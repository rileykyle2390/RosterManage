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
if($record['role'] != 'su') die('Only site admins can add players. If you are a head coach or general manager, contact a site admin to add a new player. Otherwise, <a href="home.php">visit the home page.</a>');
$pdo = null;
Template::showHeader('Create Player');

function create(){
if(count($_POST)>0){
    require('settings.php');
    //Check if the player is already on the roster. Numbers can never conflict so that is how we check
    $pdo = DB::connect($settings);
    $q = $pdo->prepare('SELECT * FROM player WHERE number = ? and teamID = ?');
    $q->execute([$_POST['number'], $_POST['teamID']]);
    if($q->rowCount() > 0)
        return 'There is already a player on the roster with that number.'; 

    $q = $pdo-> prepare('INSERT INTO player(number, teamID, age, experience, college, height, weight, position, first_name, last_name, picture)
    VALUES(?,?,?,?,?,?,?,?,?,?,?)');
    $q->execute([$_POST['number'], $_POST['teamID'], $_POST['age'], $_POST['experience'], $_POST['college'], $_POST['height'], $_POST['weight'], $_POST['position'], $_POST['first_name'], $_POST['last_name'],$_POST['picture']]);
    echo 'You successfully added a player. Now you can <a href="admin_players.php"> view the players</a>.';
    return "";
}
}
if(count($_POST)>0){
    $error = create();
if(isset($error[0])) echo $error;
}
?>



<form action ="create.php" method="POST">
<div class="form-group">
First Name
<input name ="first_name" class="form-control" required/>
</div>
<div class="form-group">
Last Name
<input name ="last_name" class="form-control" required />
</div>
<div class="form-group">
Number
<input name ="number" class="form-control" required/>
</div>
<div class="form-group">
Age
<input name ="age" class="form-control" required />
</div>
<div class="form-group">
Position
<input name ="position" class="form-control" required/>
</div>
<div class="form-group">
Height
<input name ="height" class="form-control" required />
</div>
<div class="form-group">
Weight
<input name ="weight" class="form-control" required/>
</div>
<div class="form-group">
Experience
<input name ="experience" class="form-control" required />
</div>
<div class="form-group">
College
<input name ="college" class="form-control" required/>
</div>
<div class="form-group">
Link to picture
<input name ="picture" class="form-control" required />
</div>
<div class="form-group">
Team ID
<input name ="teamID" class="form-control" required />
</div>
<button type ="submit" class = "btn btn-primary">Add player to roster</button>
</form>
<?php
Template::showFooter();