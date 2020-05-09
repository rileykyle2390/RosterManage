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
if ($record['role'] != 'su'){ //If site admin, can decline all trades
    //Otherwise, headcoach/gm only decline own trades
    $q = $pdo->prepare('SELECT * FROM `trades` WHERE teamIDIn = ? and tradeID = ?');
    $q->execute([$record['teamID'], $_GET['id']]);
    $row=$q->fetch();
    if(!isset($row))die('You can only manage incoming trades for your team.<a href="home.php">Visit the home page.</a>');
}
$q = $pdo-> prepare('DELETE FROM trades WHERE tradeID = ? ');
$q->execute([$_GET['id']]);
header('location: admin_trade.php');