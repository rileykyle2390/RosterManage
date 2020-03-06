<?php
require_once('functions.php');
function create(){
if(count($_POST)>0){
    //MUST CHECK IF FILE EXISTS
    if(!file_exists('bengalsRoster.json')){
        $h=fopen('bengalsRoster.json', 'w+');
        fwrite($h, '');
        fclose($h);
    }
    $players = readJSON('bengalsRoster.json');
    foreach($players as $player){
         if($player['number']==$_POST['number'])
             return 'The player you entered is already on the roster.'; 
        }
    $playersArray = readJSON('bengalsRoster.json');
    $newPlayer = array(
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'number' => $_POST['number'],
        'age' => $_POST['age'],
        'position' => $_POST['position'],
        'height' => $_POST['height'],
        'weight' => $_POST['weight'],
        'experience' => $_POST['experience'],
        'college' => $_POST['college'],
        'picture' => $_POST['picture']
    );
    $playersArray[] = $newPlayer;
    writeJSON('bengalsRoster.json',$playersArray);
    echo 'You successfully added a player. Now you can <a href="index.php"> view the roster </a>.';
    return "";
}
}
if(count($_POST)>0){
    $error = create();
if(isset($error[0])) echo $error;
}
?>



<form action ="create.php" method="POST">
First Name
<input name ="first_name" required/> <br />
Last Name
<input name ="last_name" required /> <br />
Number
<input name ="number" required/> <br />
Age
<input name ="age" required /> <br />
Position
<input name ="position" required/> <br />
Height
<input name ="height" required /> <br />
Weight
<input name ="weight" required/> <br />
Experience
<input name ="experience" required /> <br />
College
<input name ="college" required/> <br />
Link to picture
<input name ="picture" required /> <br />
<button type ="submit">Add player to Bengals Roster</button>
</form>