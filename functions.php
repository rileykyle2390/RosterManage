<?php
function jsonToArray(string $file){
  return json_decode(file_get_contents($file), true);
}

function showItem($id, $heading, $picture, $body, $number, $position){
    if(!isset($body)){
        $body =  '<a href="http://localhost/git/RosterManage/detail.php?id='.$id.'" class="btn btn-primary">View Player</a>'; 
    }
    echo '<div class="grid-item">
    <div class="card" style="width: 18rem;">
      <img src="'.$picture.'" class="card-img-top" alt="'.$heading.'">
     <div class="card-body">
         <h5 class="card-title">#'.$number.', '.$position.'</h5>
         <p class="card-text">'.$heading.'</p>
      '.$body.'
     </div>
    </div>
    </div>';
  }

  function detailItem($id, $heading, $age, $height, $weight, $experience, $college, $picture){
    echo '<h1><center>'. $heading .'</center></h1>
    <hr>
        <div class="media">
            <img src="'.$picture.'" class="mr-3" alt=" '.$heading.'" width = "500">
            <div class="media-body">
                <p> Age: '.$age.'</p>
                <p> Height: '.$height.'</p>
                <p> Weight: '.$weight.'</p>
                <p> Experience: '.$experience.'</p>
                <p> College: '.$college.'</p>
            </div>
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
    writeJSON($file,$input);
  }