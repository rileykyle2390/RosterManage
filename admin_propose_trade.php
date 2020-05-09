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
if($record['role'] == 'user') die('Only authorized users can trade players. <a href="home.php">Visit the home page.</a>');
$pdo = null;
Template::showHeader('Propose Trade');


function trade(){
    if(count($_POST)>0){
        require('settings.php');
        //Make sure playerIDIn is on roster, make sure playerIDOut is not on roster. Make sure teamIDIn and teamIDOut are correct per players chosen.
        $pdo = DB::connect($settings);
        $q = $pdo->prepare('SELECT * FROM player WHERE playerID = ? and teamID = ?');
        $q->execute([$_POST['playerIDOut'], $_POST['teamIDOut']]);
        if($q->rowCount() == 0)
            return 'Outgoing player is not on given team.';
        $q = $pdo->prepare('SELECT * FROM player WHERE playerID = ? and teamID = ?');
        $q->execute([$_POST['playerIDIn'], $_POST['teamIDIn']]);
        if($q->rowCount() == 0)
            return 'Incoming player is not on given team.';    
        $q = $pdo-> prepare('INSERT INTO trades(teamIDIn, teamIDOut, playerIDIn, playerIDOut)
        VALUES(?,?,?,?)');
        $q->execute([$_POST['teamIDIn'], $_POST['teamIDOut'], $_POST['playerIDIn'], $_POST['playerIDOut']]);
        echo 'You successfully proposed a trade. Now you can <a href="admin.php"> return to the admin section</a>.';
        return "";
    }
}
if(count($_POST)>0){
    $error = trade();
if(isset($error[0])) echo $error;
}
?>
<form action ="admin_propose_trade.php" method="POST">
<div class="form-group">
Team ID of Incoming Player
<input name ="teamIDIn" class="form-control" required/>
</div>
<div class="form-group">
Team ID of Outgoing Player
<input name ="teamIDOut" class="form-control" required/>
</div>
<div class="form-group">
Player ID of Incoming Player
<input name ="playerIDIn" class="form-control" required/>
</div>
<div class="form-group">
Player ID of Outgoing Player
<input name ="playerIDOut" class="form-control" required/>
</div>
<button type ="submit" class = "btn btn-primary">Propose Trade</button>
</form>
<?php
Template::showFooter();