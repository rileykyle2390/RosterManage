<?php
require_once('authentication_library.php');

class Template{
	static function showHeader($title){
		?>
		<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<base href="http://localhost/RosterManage/" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title><?= $title ?></title>
  </head>
  <body>
  <div class="container">
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php">Roster Viewer</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only"></span></a>
      </li>
	  <?php if(!is_logged()){ ?>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Sign up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signin.php">Sign in</a>
      </li>
	  <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="signout.php">Sign out</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Admin Area</a>
      </li>
	  <?php } ?>
    </ul>
  </div>
</nav>
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

    <h1><?= $title ?></h1> 
	<?php
	}
	
	static function showFooter($id=null){
		?>
	</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<?php if(isset($id)){ ?>
	<script>
	$(document).on('click','.btn-like',function(){
		var like;
		var button=$(this);
		if($(this).hasClass('btn-primary')) like=false;
		else like=true;
		$.get('like.php?id='+<?= $id ?>,function(data){
			like=!like;
			if(like){
				button.removeClass('btn-primary').addClass('btn-outline-primary');
				button.text('Stop being a fan of this player');
			}else{
				button.removeClass('btn-outline-primary').addClass('btn-primary');
				button.text('Become a fan of this player');
			}
		});
	});
	</script>
	<?php } ?>
  </body>
</html>
<?php
	}
}