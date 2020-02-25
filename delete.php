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
    $h=fopen('bengalsRoster.json', 'r');
    while(!feof($h)){
        $line = fgets($h);
        if(!strstr($line, $_POST['number'])){ 
            return 'The player you entered is not on the roster.';
        }
    }
    fclose($h);
    $playersArray = readJSON('bengalsRoster.json');
    $toDelete = array_search($_POST['number'], array_column($playersArray, 'number'));
    deleteJSON('bengalsRoster.json',$toDelete);
    echo 'You deleted a player. Now you can <a href="index.php"> view the roster </a>.';
    return "";
}
}
if(count($_POST)>0){
    $error = create();
if(isset($error[0])) echo $error;
}
?>


<form action ="delete.php" method="POST">
Number
<input name ="number" required/> <br />
<button type ="submit">Delete a player according to their number</button>
</form>