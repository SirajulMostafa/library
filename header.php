<?php
session_start();
require('config.php');
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
    <title>LMS <?php 
					if(isset($_SESSION['user_level'])){ 
							   echo "| Admin";
					}
					elseif(isset($_SESSION['type'])){
							 if($_SESSION['type']=='student'){
							   echo "| Student";
							 }else{
							   echo "| Faculty";
							 }
					}
					else{
						echo "| HOME";
						$link = '<a href="/library/index.php">';
						$link2 = '</a>';
					}
			?></title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="css/style.css" rel="stylesheet">
	
  </head>

<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 col-head-cus">
			<?php if(isset($link)){ echo $link;} ?>
				<img src="images/Logo.png" class="img-thumbnail" style="margin:5px;" alt="logo"><?php if(isset($link2)){ echo $link2;} ?>

	<?php if(isset($_SESSION['user_level'])){ 
				echo '<span style="float:right; margin-right:200px; margin-top:20px;"><b>Welcome : Admin</b></span>';
			}
			elseif(isset($_SESSION['type'])){ 
				if($_SESSION['type']=='student'){
					   echo '<span style="float:right; margin-right:200px; margin-top:20px;"><b>Welcome : Student</b></span>';
					 }else{
					   echo '<span style="float:right; margin-right:200px; margin-top:20px;"><b>Welcome : Faculty</b></span>';
					 }

			} ?>
		</div>
	</div>
</div>