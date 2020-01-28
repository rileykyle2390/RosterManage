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
    <h1><center><?= $players[$_GET['id']]['first_name'].' '.$players[$_GET['id']]['last_name'].' #'.$players[$_GET['id']]['number'].', '.$players[$_GET['id']]['position'] ?></center></h1>
    <hr>
        <div class="media">
            <img src="<?= $players[$_GET['id']]['picture']?>" class="mr-3" alt="<?= $players[$_GET['id']]['first_name'].' '.$players[$_GET['id']]['last_name']?>" width = "500">
            <div class="media-body">
                <p> <?= 'Age: '.$players[$_GET['id']]['age']?></p>
                <p> <?= 'Height: '.$players[$_GET['id']]['height']?></p>
                <p> <?= 'Weight: '.$players[$_GET['id']]['weight']?></p>
                <p> <?= 'Experience: '.$players[$_GET['id']]['experience']?></p>
                <p> <?= 'College: '.$players[$_GET['id']]['college']?></p>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>