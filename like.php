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
$q = $pdo->prepare('SELECT * FROM player_user_fans WHERE userID = ? and playerID=?');
$q->execute([$_SESSION['user/ID'], $_GET['id']]);
if ($q->rowCount()==0){
    $q = $pdo->prepare('INSERT INTO player_user_fans (userID, playerID) VALUES (?, ?)');
    $q->execute([$_SESSION['user/ID'], $_GET['id']]);
} else{
    $q = $pdo->prepare('DELETE FROM player_user_fans WHERE userID = ? and playerID=?');
    $q->execute([$_SESSION['user/ID'], $_GET['id']]);
}
echo 'Thanks';