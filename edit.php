<?php
require_once('functions.php');
function edit(){
if(count($_POST)>0){
    //MUST CHECK IF FILE EXISTS
    if(!file_exists('bengalsRoster.json')){
        $h=fopen('bengalsRoster.json', 'w+');
        fwrite($h, '');
        fclose($h);
    }
    $toChange = -1;
    $players = readJSON('bengalsRoster.json');
    foreach($players as $key=>$player){
         if($player['number']==$_POST['number']){
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
        $toChange = $key;
        }
    }
    if($toChange != -1){
        modifyJSON('bengalsRoster.json',$newPlayer,$toChange);
        echo 'You changed a player. Now you can <a href="index.php"> view the roster </a>.';
        return "";
    }
    return 'The player you are trying to edit is not yet on the roster according to the used number.';
}
}
if(count($_POST)>0){
    $error = edit();
if(isset($error[0])) echo $error;
}
?>


<form action ="edit.php" method="POST">
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
<button type ="submit">Edit a player according to their number</button>
</form>