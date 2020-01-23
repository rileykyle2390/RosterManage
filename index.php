<?php
$players = [
    [
        'first_name' => 'Andy',
        'last_name' => 'Dalton',
        'number' => '14',
        'age' => '32',
        'position' => 'QB',
        'height' => '6-2',
        'weight' => '220',
        'experience' => '9',
        'college' => 'Texas Christian',
        'picture' => 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/evzci5wn5ytzjjxc23tl.jpg'
    ],
    [
        'first_name' => 'Geno',
        'last_name' => 'Atkins',
        'number' => '97',
        'age' => '31',
        'position' => 'DT',
        'height' => '6-1',
        'weight' => '300',
        'experience' => '10',
        'college' => 'Georgia',
        'picture' => 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/dgsnj9f7wn6q1xhjpycm.jpg'
   ],
   [
        'first_name' => 'Jessie',
        'last_name' => 'Bates III',
        'number' => '30',
        'age' => '22',
        'position' => 'S',
        'height' => '6-1',
        'weight' => '200',
        'experience' => '2',
        'college' => 'Wake Forest',
        'picture' => 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/iwfegboegy8w0kovcv3b.jpg'
   ],
    [
        'first_name' => 'Giovanni',
        'last_name' => 'Bernard',
        'number' => '25',
        'age' => '28',
        'position' => 'HB',
        'height' => '5-9',
        'weight' => '205',
        'experience' => '7',
        'college' => 'North Carolina',
        'picture' => 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/gh1fmzovrod6suib3rul.jpg'
    ],
    [
        'first_name' => 'Tyler',
        'last_name' => 'Boyd',
        'number' => '83',
        'age' => '25',
        'position' => 'WR',
        'height' => '6-2',
        'weight' => '203',
        'experience' => '4',
        'college' => 'Pittsburgh',
        'picture' => 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/twx0xw8bftxsqbu94ano.jpg'
    ],
    [
        'first_name' => 'Randy',
        'last_name' => 'Bullock',
        'number' => '4',
        'age' => '30',
        'position' => 'K',
        'height' => '5-9',
        'weight' => '210',
        'experience' => '8',
        'college' => 'Texas A&M',
        'picture' => 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/mlq9cacnwys3jyr29pyc.jpg'
    ],
    [
        'first_name' => 'Carlos',
        'last_name' => 'Dunlap',
        'number' => '96',
        'age' => '30',
        'position' => 'DE',
        'height' => '6-6',
        'weight' => '285',
        'experience' => '10',
        'college' => 'Florida',
        'picture' => 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/mxhk9fcuyena3pqjqdss.jpg'
    ],
    [
        'first_name' => 'Joe',
        'last_name' => 'Mixon',
        'number' => '28',
        'age' => '23',
        'position' => 'HB',
        'height' => '6-1',
        'weight' => '220',
        'experience' => '3',
        'college' => 'Oklahoma',
        'picture' => 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/fcwse1oumaizk6uqnztc.jpg'
    ],
    [
        'first_name' => 'A.J.',
        'last_name' => 'Green',
        'number' => '18',
        'age' => '31',
        'position' => 'WR',
        'height' => '6-4',
        'weight' => '210',
        'experience' => '9',
        'college' => 'Georgia',
        'picture' => 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/ouuz0wumam8froyuxv2d.jpg'
    ],
    [
        'first_name' => 'Dre',
        'last_name' => 'Kirkpatrick',
        'number' => '27',
        'age' => '30',
        'position' => 'CB',
        'height' => '6-2',
        'weight' => '190',
        'experience' => '8',
        'college' => 'Alabama',
        'picture' => 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/qlfuys6o36ztraxqpgrg.jpg'
    ],
];

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
  grid-template-columns: auto auto auto auto;
  padding 30px;
    }
    .grid-item {
    padding 30px;
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
       echo '<div class="grid-item">
       <div class="card" style="width: 18rem;">
         <img src="'.$players[$i]['picture'].'" class="card-img-top" alt="'.$players[$i]['first_name'].' '.$players[$i]['last_name'].'">
        <div class="card-body">
            <h5 class="card-title">'.$players[$i]['first_name'].' '.$players[$i]['last_name'].'</h5>
            <p class="card-text">#'.$players[$i]['number'].', '.$players[$i]['position'].'</p>
         <a href="http://localhost/git/RosterManage/detail.php?id='.$i.'" class="btn btn-primary">Visit Profile</a>
        </div>
    </div>
    </div>';
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