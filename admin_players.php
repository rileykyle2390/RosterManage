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
Template::showHeader('Manage Players');
if ($record['role'] == 'su'){ //If site admin, see all players
	echo '<a href="create.php">Add a new player</a>'; //Only site admins can add players to teams
    $q = $pdo->prepare('SELECT * FROM `player`');
    $q->execute([]);
}
//Otherwise, headcoach/gm only see their team
else{
	$q = $pdo->prepare('SELECT * FROM `player` WHERE teamID = ? ');
	$q->execute([$record['teamID']]);
}
echo '<table class="table">';
echo'<thead>';
echo '<tr>';
echo '<th scope="col">Name</th>';
echo '<th scope="col">Number</th>';
echo '<th scope="col">Position</th>';
echo '<th scope="col">Edit</th>';
echo '<th scope="col">Drop</th>';
echo '</tr>';
echo '</thead>';
while($row=$q->fetch()){
	echo '<tr>';
	echo '<td>'.$row['first_name'].' '. $row['last_name'].'</td>';
	echo '<td>'.$row['number'].'</td>';
	echo '<td>'.$row['position'].'</td>';
	echo '<td><a href="edit.php?id='.$row['playerID'].'">Edit</a></td>';
	echo '<td><a href="delete.php?id='.$row['playerID'].'">Drop</a></td>';
	echo '<tr>';
}
echo '</table>';

Template::showFooter();