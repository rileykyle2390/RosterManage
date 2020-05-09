<?php
require_once('settings.php');
require_once('template.php');
require_once('db.php');
require_once('authentication_library.php');
session_start();
if(!is_logged()) header('location: signin.php');
$pdo=DB::connect($settings);
$q = $pdo->prepare('SELECT * FROM users WHERE userID = ? ');
$q->execute([$_SESSION['user/ID']]);
$record=$q->fetch();
if($record['role'] == 'user') die('This area is for authorized users only. If you are a head coach or general manager, contact an admin to gain access. Otherwise, <a href="home.php">visit the home page.</a>');
Template::showHeader('Admin Section');
?>
  <body>
    <div class="list-group">
  <a href="admin_players.php" class="list-group-item list-group-item-action">Manage Players</a>
  <a href="admin_users.php" class="list-group-item list-group-item-action">Manage Users</a>
  <a href="admin_trade.php" class="list-group-item list-group-item-action">View Trades</a>
</div>
</body>
<?php
Template::showFooter();
?>