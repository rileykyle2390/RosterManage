<?php
require_once('functions.php');
$players = jsonToArray('bengalsRoster.json');
if(!isset($_GET['id'])){
    echo 'Please visit <a href="index.php">the Roster</a>';
    die();
}
if($_GET['id'] < 0 || $_GET['id'] > count($players)-1){
    echo 'Please visit <a href="index.php">the Roster</a>';
    die();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title><?= $players[$_GET['id']]['first_name'].' '.$players[$_GET['id']]['last_name']?></title>
  </head>
  <body>
  <div class="container">
  <?= detailItem($_GET['id'], $players[$_GET['id']]['first_name'].' '.$players[$_GET['id']]['last_name'].' #'.$players[$_GET['id']]['number'].', '.$players[$_GET['id']]['position'], $players[$_GET['id']]['age'], $players[$_GET['id']]['height'], $players[$_GET['id']]['weight'], $players[$_GET['id']]['experience'], $players[$_GET['id']]['college'], $players[$_GET['id']]['picture'])?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>