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
if ($record['role'] == 'su'){ //If site admin, see all trades
    $q = $pdo->prepare('SELECT * FROM `trades`');
    $q->execute([]);
}
//Otherwise, headcoach/gm only see their incoming trades
else{
	$q = $pdo->prepare('SELECT * FROM `trades` WHERE teamIDIn = ? ');
	$q->execute([$record['teamID']]);
}
echo '<a href="admin_propose_trade.php">Propose a trade</a>';
echo '</br>';
$playerIDIn = array();
$playerIDOut = array();
while($record=$q->fetch()){
    array_push($playerIDIn, $record['playerIDIn']);
    array_push($playerIDOut, $record['playerIDOut']);
}
if(!isset($playerIDIn[0])){
    echo 'No Incoming Trades.';
}
else{
    echo '<table class="table">';
    echo'<thead>';
    echo '<tr>';
    echo '<th scope="col">Player In</th>';
    echo '<th scope="col">Player Out</th>';
    echo '<th scope="col">Accept</th>';
    echo '<th scope="col">Decline</th>';
    echo '</tr>';
    echo '</thead>';
    for($i = 0; $i < count($playerIDIn); $i++){
        $q = $pdo->prepare('SELECT * FROM player WHERE playerID = ? ');
        $q->execute([$playerIDIn[$i]]);
        $row=$q->fetch();
        echo '<tr>';
        echo '<td>'.$row['first_name'].' '. $row['last_name'].'</td>';
        $q = $pdo->prepare('SELECT * FROM player WHERE playerID = ? ');
        $q->execute([$playerIDOut[$i]]);
        $row=$q->fetch();
        echo '<td>'.$row['first_name'].' '. $row['last_name'].'</td>';
        $q = $pdo->prepare('SELECT * FROM trades WHERE playerIDIn = ? and playerIDOut = ? ');
        $q->execute([$playerIDIn[$i], $playerIDOut[$i]]);
        $row=$q->fetch();
        echo '<td><a href="admin_trade_accept.php?id='.$row['tradeID'].'">Accept</a></td>';
        echo '<td><a href="admin_trade_decline.php?id='.$row['tradeID'].'">Decline</a></td>';
        echo '<tr>';
    }
    echo '</table>';

}

Template::showFooter();