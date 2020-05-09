<?php
require_once('settings.php');
require_once('db.php');
require_once('authentication_library.php');
require_once('template.php');
session_start();
if(!is_logged()) header('location: signin.php');
$pdo=DB::connect($settings);
$q = $pdo->prepare('SELECT * FROM users WHERE userID = ? ');
$q->execute([$_SESSION['user/ID']]);
$record=$q->fetch();
if($record['role'] == 'user') die('This area is for authorized users only. If you are a head coach or general manager, contact an admin to gain access. Otherwise, <a href="home.php">visit the home page.</a>');
Template::showHeader('View Trades');
if ($record['role'] != 'su'){ //If site admin, can accept all trades
    //Otherwise, headcoach/gm only accept own trades
    $q = $pdo->prepare('SELECT * FROM `trades` WHERE teamIDIn = ? and tradeID = ?');
    $q->execute([$record['teamID'], $_GET['id']]);
    $row=$q->fetch();
    if(!isset($row))die('You can only manage incoming trades for your team.<a href="home.php">Visit the home page.</a>');
}
//Make sure there are no number conflicts
function trade(){
    if(count($_POST)>0){
        require('settings.php');
        $pdo = DB::connect($settings);
        //Check incoming players for conflict
        $q = $pdo->prepare('SELECT * FROM `trades` WHERE tradeID = ?');
        $q->execute([$_GET['id']]);
        $row=$q->fetch();
        $q = $pdo->prepare('SELECT * FROM `player` WHERE number = ? and teamID = ?');
        $q->execute([$_POST['playerNumberIn'], $row['teamIDOut']]);
        if($q->rowCount()!=0) return "Incoming player has the same number as a player on your team.";
        //Check outgoing player for conflict
        $q = $pdo->prepare('SELECT * FROM `player` WHERE number = ? and teamID = ?');
        $q->execute([$_POST['playerNumberOut'], $row['teamIDIn']]);
        if($q->rowCount()!=0) return "Outgoing player has the same number as a player on other team.";
        //This trade is fine
        //Move player out
        $q = $pdo-> prepare('UPDATE player SET teamID = ?, number = ?
        WHERE playerID = ?');
        $q->execute([$row['teamIDOut'], $_POST['playerNumberIn'], $row['playerIDIn']]);
        //Move player in
        $q = $pdo-> prepare('UPDATE player SET teamID = ?, number = ?
        WHERE playerID = ?');
        $q->execute([$row['teamIDIn'], $_POST['playerNumberOut'], $row['playerIDOut']]);
        $q = $pdo-> prepare('DELETE FROM trades WHERE tradeID = ? ');
        $q->execute([$_GET['id']]);
        echo 'You successfully traded a player.  You can <a href="admin_players.php">return to a list of your players.</a>';
        return "";
    }
}
if(count($_POST)>0){
    $error = trade();
if(isset($error[0])) echo $error;
}
?>
<form action ="admin_trade_accept.php?id=<?= $_GET['id'] ?>" method="POST">
<div class="form-group">
Incoming Player New Number
<input name ="playerNumberIn" required class="form-control"/>
</div>
<div class="form-group">
Outgoing Player New Number
<input name ="playerNumberOut" required class="form-control"/>
</div>
<button type ="submit" class= "btn btn-primary">Accept Trade</button>
</form>
<?php
Template::showFooter();