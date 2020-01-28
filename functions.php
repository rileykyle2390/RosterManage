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