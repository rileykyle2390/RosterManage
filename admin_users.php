<?php
require_once('settings.php');
require_once('db.php');
require_once('template.php');
require_once('authentication_library.php');
session_start();
if(!is_logged()) header('location: signin.php');
$pdo=DB::connect($settings);
$q = $pdo->prepare('SELECT * FROM users WHERE userID = ? ');
$q->execute([$_SESSION['user/ID']]);
$record=$q->fetch();
if($record['role'] == 'user' || $record['role'] == 'hc') die('This area is for authorized users only. Coaches cannot edit other accounts, ask your general manager to do so. If you are a general manager, contact an admin to gain access. Otherwise, <a href="home.php">visit the home page.</a>');
Template::showHeader('Manage Users');
if ($record['role'] == 'su'){ //If site admin, see all users
	echo '<a href="admin_create_user.php">Add a new user</a>'; //Only site admins can add any users and edit all users.
    $q = $pdo->prepare('SELECT * FROM `users`');
    $q->execute([]);
}
//Headcoach cannot edit accounts, GM is their boss
//GMs can fire headcoaches ONLY (cannot change normal users) and edit their accounts.
else{
	$q = $pdo->prepare('SELECT * FROM `users` WHERE teamID = ? and role = ?');
	$q->execute([$record['teamID'], "hc"]);
}
echo '<table class="table">';
echo'<thead>';
echo '<tr>';
echo '<th scope="col">Name</th>';
echo '<th scope="col">Email</th>';
echo '<th scope="col">Role</th>';
echo '<th scope="col">Edit</th>';
echo '<th scope="col">Delete</th>';
echo '</tr>';
echo '</thead>';
while($row=$q->fetch()){
	echo '<tr>';
	echo '<td>'.$row['first_name'].' '. $row['last_name'].'</td>';
	echo '<td>'.$row['email'].'</td>';
	echo '<td>'.$row['role'].'</td>';
	echo '<td><a href="admin_modify_user.php?id='.$row['userID'].'">Edit</a></td>';
	echo '<td><a href="admin_delete_user.php?id='.$row['userID'].'">Delete</a></td>';
	echo '<tr>';
}
echo '</table>';

Template::showFooter();
