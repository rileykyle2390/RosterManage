<?php
require_once('settings.php');
require_once('functions.php');
require_once('db.php');
require_once('authentication_library.php');
require_once('template.php');
session_start();
if(!is_logged()){
  echo 'Only logged in users can view player details. Please <a href="signin.php">log in.</a>';
  die();
}
if(!isset($_GET['id']) || $_GET['id'] < 0){
  echo 'We are not sure how you got here. Please visit <a href="home.php">the Home Page</a>';
  die();
}
$pdo = DB::connect($settings);
$q = $pdo->prepare('SELECT * FROM `player` WHERE playerID = ? ');
$q->execute([$_GET['id']]);
$record = $q->fetch();
Template::showHeader($record['first_name'].' '. $record['last_name'].' #'.$record['number'].', '.$record['position']);
detailItem($record['playerID'], $record['first_name'].' '. $record['last_name'].' #'.$record['number'].', '.$record['position'], $record['age'], $record['height'], $record['weight'], $record['experience'], $record['college'], $record['picture']);
Template::showFooter($_GET['id']);