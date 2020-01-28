<?php
require_once('functions.php');
$players = jsonToArray('bengalsRoster.json');

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<style>
    .grid-container {
      display: grid;
      justify-content: space-evenly;  
      grid-template-columns: auto auto auto auto;
      padding: 10px;
    }
    .grid-item {
    padding: 5px 0;
    font-size: 30px;
    text-align: center; 
    }   
</style>
    <title>Player Roster</title>
  </head>
  <body>
    <h1><center>Roster</center></h1>
    <hr>
    <div class="grid-container">
    <?php
    for($i=0; $i < count($players); $i++){
      
        showItem($i, $players[$i]['first_name'].' '. $players[$i]['last_name'], $players[$i]['picture'],'<a href="http://localhost/git/RosterManage/detail.php?id='.$i.'" class="btn btn-primary">View Player</a>',$players[$i]['number'], $players[$i]['position']);
    }
    ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>