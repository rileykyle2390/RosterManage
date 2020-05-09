<?php
require_once('settings.php');
require_once('functions.php');
require_once('db.php');
require_once('template.php');
session_start();
Template::showHeader('Roster');
if(!isset($_GET['id'])){
  echo 'Please visit <a href="home.php">the Home Page</a>';
  die();
}
$pdo = DB::connect($settings);
?>
   
  <body>
    
    <div class="grid-container">
    <?php
    $q = $pdo->prepare('SELECT * FROM `player` WHERE teamID = ? ');
    $q->execute([$_GET['id']]);
    while($record=$q->fetch()){
        showItem($record['playerID'], $record['first_name'].' '. $record['last_name'], $record['picture'],'<a href="http://localhost/RosterManage/detail.php?id='.$record['playerID'].'" class="btn btn-primary">View Player</a>',$record['number'], $record['position']);
    }
    ?>
    </div>
  </body>
<?php
Template::showFooter();
?>
