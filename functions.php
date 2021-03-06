<?php
require_once('db.php');

function jsonToArray(string $file){
  return json_decode(file_get_contents($file), true);
}

function showItem($id, $heading, $picture, $body, $number, $position){
    if(!isset($body)){
        $body =  '<a href="http://localhost/RosterManage/detail.php?id='.$id.'" class="btn btn-primary">View Player</a>'; 
    }
    echo '<div class="grid-item">
    <div class="card" style="width: 18rem;">
      <img src="'.$picture.'" class="card-img-top" alt="'.$heading.'"  width = "250">
     <div class="card-body">
         <h5 class="card-title">#'.$number.', '.$position.'</h5>
         <p class="card-text">'.$heading.'</p>
      '.$body.'
     </div>
    </div>
    </div>';
  }

  function detailItem($id, $heading, $age, $height, $weight, $experience, $college, $picture){
    require('settings.php');
    echo'
    <hr>
        <div class="media">
            <img src="'.$picture.'" class="mr-3" alt=" '.$heading.'" width = "500">
            <div class="media-body">
                <p> Age: '.$age.'</p>
                <p> Height: '.$height.'</p>
                <p> Weight: '.$weight.'</p>
                <p> Experience: '.$experience.'</p>
                <p> College: '.$college.'</p>';
                $pdo=DB::connect($settings);
                $q = $pdo->prepare('SELECT * FROM player_user_fans WHERE userID = ? and playerID=?');
                $q->execute([$_SESSION['user/ID'], $id]);
                if ($q->rowCount() == 0)
                echo '<p> <button class="btn btn-primary btn-like">Become a fan of this player</button></p>';
                else
                echo '<p> <button class="btn btn-outline-primary btn-like">Stop being a fan of this player</button></p>';
            echo'</div>
        </div>';
  }

  function filterInput($data,$allowed_fields){
    for($i=0;$i<count(array_keys($data));$i++)
      if(!in_array(array_keys($data)[$i],$allowed_fields)) unset($data[array_keys($data)[$i]]);
    return $data;
  }
  
  function writeJSON($file,$data){
    $h=fopen($file,'w+');
    fwrite($h,is_array($data) ? json_encode($data) : $data);
    fclose($h);
  }
  
  function readJSON($file,$index=null){
    $h=fopen($file,'r');
    $output='';
    while(!feof($h)) $output.=fgets($h);
    fclose($h);
    $output=json_decode($output,true);
    return !isset($index) ? $output : (isset($output[$index]) ? $output[$index] : null);
  }
  
  function modifyJSON($file,$data,$index){
    $input=readJSON($file);
    $input[$index]=array_merge($input[$index],$data);
    writeJSON($file,$input);
  }
  
  function deleteJSON($file,$index){
    $input=readJSON($file);
    unset($input[$index]);
    $input = array_values($input);
    writeJSON($file,$input);
  }