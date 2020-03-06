<?php
require_once('functions.php');
function delete(){
if(count($_POST)>0){
    //MUST CHECK IF FILE EXISTS
    if(!file_exists('bengalsRoster.json')){
        $h=fopen('bengalsRoster.json', 'w+');
        fwrite($h, '');
        fclose($h);
    }
    $toDelete = -1;
    $players = readJSON('bengalsRoster.json');
    foreach($players as $key=>$player){
         if($player['number']==$_POST['number']) 
             $toDelete = $key;
    }
    if($toDelete != -1){
            deleteJSON('bengalsRoster.json',$toDelete);
            echo 'You deleted a player. Now you can <a href="index.php"> view the roster </a>.';
            return "";
    }
    return 'The player you are trying to delete is not yet on the roster according to the used number.';
}
}
if(count($_POST)>0){
    $error = delete();
if(isset($error[0])) echo $error;
}
?>


<form action ="delete.php" method="POST">
Number
<input name ="number" required/> <br />
<button type ="submit">Delete a player according to their number</button>
</form>