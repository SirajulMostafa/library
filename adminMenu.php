<?php
//print_r($_SESSION);
//print_r($_SERVER['REQUEST_URI']);
$url = $_SERVER['REQUEST_URI'];
$file_name = str_replace("/library/","",$url);
?>

<div class="well well-sm">
	<ul class="nav nav-pills">
	  <?php if(!isset($_SESSION['type'])){?>
			<li <?php if (preg_match("/home/i", $file_name)) { echo 'class="active"'; }?>><a href="/library/home.php">Home</a></li>
	  <?php } ?>
	  <li <?php if (preg_match("/books/i", $file_name)){ echo 'class="active"'; }?>><a href="/library/books.php">Book List</a></li>
	  <?php if(!isset($_SESSION['type'])){?>
			<li <?php if (preg_match("/return/i", $file_name)){ echo 'class="active"'; }?>><a href="/library/return.php">Return Book</a></li>
			<li <?php if (preg_match("/newBook/i", $file_name)){ echo 'class="active"'; }?>><a href="/library/newBook.php">New Book</a></li>
			<li <?php if (preg_match("/member/i", $file_name)){ echo 'class="active"'; }?>><a href="/library/member.php">Confirm Member</a></li>
	  <?php } ?>
	  <?php if($_SESSION['type']!='student'){?>
			<li <?php if (preg_match("/requisition/i", $file_name)){ echo 'class="active"'; }?>><a href="/library/requisition.php">Requisition Book</a></li>
	  <?php } ?>
	  <?php if($_SESSION['user_level']!='Admin'){?>
			<li <?php if (preg_match("/history/i", $file_name)){ echo 'class="active"'; }?>><a href="/library/history.php">My History</a></li>
	  <?php } ?>
	  <?php if(!isset($_SESSION['type'])){?>
	  <li <?php if (preg_match("/report/i", $file_name)){ echo 'class="active"'; }?>><a href="/library/report.php">Report</a></li>
	  <li <?php if (preg_match("/changePass/i", $file_name)){ echo 'class="active"'; }?>><a href="/library/changePass.php">Change Password</a></li>
	  <?php } ?>
	  <li <?php if (preg_match("/logout/i", $file_name)){ echo 'class="active"'; }?>><a href="/library/logout.php">Log Out</a></li>
	</ul>
</div>
