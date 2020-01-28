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
         <h5 class="card-title">'.$heading.'</h5>
         <p class="card-text">#'.$number.', '.$position.'</p>
      '.$body.'
     </div>
    </div>
    </div>';
  }