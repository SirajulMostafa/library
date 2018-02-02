<?php include "header.php"; ?>
<?php include "checkiner.php"; ?>
<?php 
$pQ = "";
if(isset($_GET['q'])){
	$pQ = $_GET['q'];
}
$pA='';
if(isset($_GET['a'])){
	$pA = $_GET['a'];
}
$pD='';
if(isset($_GET['d'])){
	$pD = $_GET['d'];
}
$pLimit='';
if(isset($_GET['limit'])){
	$pLimit = $_GET['limit'];
}

?>

<?php
if(isset($_POST['bookConfirm'])){
	
	$book_id = $_POST['id'];
	$std_id = $_POST['stdnt_id'];
	$provide_date = date('Y-m-d');
    $expire_date  = date("Y-m-d", strtotime(date("Y-m-d") . " + 7 Day"));
	
	$qr_insrt = "INSERT INTO `book_record` (`book_id`,`student_id`,`provide_date`,`expire_date`) VALUES ('$book_id','$std_id','$provide_date','$expire_date')";
	
	if(mysql_query($qr_insrt)){
	        $qr_stock = mysql_fetch_array(mysql_query("select * from book where id='$book_id'"));
			if($qr_stock['b_temp_stock'] > 0){
				$now_stock = $qr_stock['b_temp_stock'] - 1;
				@mysql_query("update book set b_temp_stock='$now_stock' where id='$book_id'");
			}
			
			//for mail sent student, when admin issue of book
			//echo "SELECT * FROM student_faculty WHERE s_id='$std_id'";exit;
			/*$mail=mysql_fetch_array(mysql_query("SELECT * FROM student_faculty WHERE s_id='$std_id'"));
			$email = "infobulibrary@gmail.com";
			$mailtoUser =$mail['email'];
			$mailtouserName =$mail['s_name'];
			$subject = 'bu issue of book';
			$message = "Hello,<br>Mr/Ms. $mailtouserName, already you receive book, your last date $expire_date for return on due  date.<br><br>Regards<br>BU Library Management";
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";																
			$headers .= 'From: bu-library <bulibrary@gmail.com>' . "\r\n";
		
			mail($mailtoUser,$subject,$message,$headers);*/
			//end mail sent
			
			$smsg = "Book confirm Successfully.";
			
        }else{
            $fmsg ="confirm Failed";
        }
	
}


?>



<div class="container">
	<div class="row">		
        <div class="col-md-12 col-body-custom">			
			<?php include "adminMenu.php"; ?>
			
			<div class="row" style="margin-top:25px;">
				 <div class="col-md-12">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<form class="navbar-form navbar-left" action="" method="GET">
								<div class="form-group">
									<input type="text" size="90" class="form-control" value="<?php if($pQ!=''){ echo $pQ; } ?>" placeholder="Book Search" name="q" required>
								</div>
							<button class="btn btn-info" type="submit">Search</button>
							</form>
						</div>
						<div class="col-md-2"></div>
					</div>
					

<div class="row">
	<div class="col-md-12" style="margin-top:10px;">
	
	<!--Table Block-->
	 <div class="panel panel-warning">
	    
		
	<!--|||by Author Name|||-->	
		<?php if($pQ=='b_author' or $pA!=''){?>
	<div class="panel-heading"><a href="books.php">Book List</a> | <a href="?q=b_author">Author Name</a> | <a href="?q=depart">Department</a></div>
	<div class="row">
              <div class="col-md-4">	
	   <table class="table">
	   <?php		  
			$sql = mysql_query("select DISTINCT(b_author_name) from book limit 0,30") or die(mysql_error());								
			if (mysql_num_rows($sql) > 0) { ?>                             		
				  <thead>
					  <tr>					 
						 <th>Author Name</th>						 
					  </tr>
				 </thead>                                                                    
					<?php
					while($row = mysql_fetch_array($sql)) {
						echo ' <tbody><tr>';
						echo '<td class="info"><a href="?q=b_author&a='.$row["b_author_name"].'">'.$row["b_author_name"]."</a></td>";				
						echo "</tr></tbody> ";
					} ?> 									                                                                         
		   </table>
		   </div>
		   <?php if($pA!='') {?>
		   <div class="col-md-8">
				<h3>Author Name : <u><?php echo ucfirst($pA); ?></u></h3>
				<table class="table">
				   <?php
						//echo "select * from book where b_author_name='$pA' limit 0,10"; exit;
						$sql = mysql_query("select * from book where b_author_name='$pA' limit 0,10") or die(mysql_error());								
						if (mysql_num_rows($sql) > 0) { ?>                             		
							  <thead>
								  <tr>
									 <th>Book Name</th>
									 <th>Self No.</th>
									 <th>Column No.</th>
									 <th>Category</th>
								  </tr>
							 </thead>                                                                    
								<?php
								while($row = mysql_fetch_array($sql)) {
									echo ' <tbody> <tr>';
									echo '<td class="danger"><a href="?q='.$row["b_name"].'">'.$row["b_name"]."</a></td>";
									echo '<td class="success">'.$row["b_self"]."</td>";
									echo '<td class="danger">'.$row["b_self_colum"]."</td>";
									echo '<td class="success">'.$row["b_cat_name"]."</td>";
									echo "</tr></tbody> ";
								} ?> 									                                                                         
					   </table><?php } ?>	
		   </div>
		   <?php } ?>
		   </div>
		<?php } ?>	
		<?php } ?> 
	<!--End by Author Name-->
	
	 <!--|||by department|||-->
	<?php if($pQ=='depart'){ ?>	
	<div class="panel-heading"><a href="books.php">Book List</a> | <a href="?q=b_author">Author Name</a> | <a href="?q=depart">Department</a></div>
	<div class="row">
              <div class="col-md-4">
				<table class="table">
	   <?php
			$sql = mysql_query("select DISTINCT(b_cat_name) from book limit 0,30") or die(mysql_error());								
			if (mysql_num_rows($sql) > 0) { ?>                             		
				  <thead>
					  <tr>
						 <th>Department</th>						 
					  </tr>
				 </thead>                                                                    
					<?php
					while($row = mysql_fetch_array($sql)) {
						echo ' <tbody> <tr>';	
						echo '<td class="info"><a href="?q=depart&d='.$row["b_cat_name"].'">'.strtoupper($row["b_cat_name"])."</a></td>";						
						echo "</tr></tbody> ";
					} ?> 									                                                                         
		   </table>
		   </div>
		   <?php if($pD!='') {?>
		    <div class="col-md-8">
				<h3>Department Name : <u><?php echo strtoupper($pD); ?></u></h3>
				<table class="table">
				   <?php
						//echo "select * from book where b_author_name='$pD' limit 0,10"; exit;
						$sql = mysql_query("select * from book where b_cat_name='$pD' limit 0,10") or die(mysql_error());								
						if (mysql_num_rows($sql) > 0) { ?>                             		
							  <thead>
								  <tr>
									 <th>Book Name</th>
									 <th>Self No.</th>
									 <th>Column No.</th>
									 <th>Author Name</th>
								  </tr>
							 </thead>                                                                    
								<?php
								while($row = mysql_fetch_array($sql)) {
									echo ' <tbody> <tr>';
									echo '<td class="danger"><a href="?q='.$row["b_name"].'">'.$row["b_name"]."</a></td>";
									echo '<td class="success">'.$row["b_self"]."</td>";
									echo '<td class="danger">'.$row["b_self_colum"]."</td>";
									echo '<td class="success">'.$row["b_author_name"]."</td>";
									echo "</tr></tbody> ";
								} ?> 									                                                                         
					   </table><?php } ?>	
			</div>
			<?php } ?>
		  </div>
		<?php } ?>	
			<?php } ?>
			<!--End by Author Name-->
		

        <!-- by book list-->		
	<?php if(empty($pQ)){ ?>
	<div class="panel-heading"><a href="books.php">Book List</a> | <a href="?q=b_author">Author Name</a> | <a href="?q=depart">Department</a></div>
			<table class="table">
	    <?php
			$limit = 6;
			if($pLimit!=''){
				$start = $pLimit;
			}else{
				$start = 0;
			}
			//echo "select * from book limit $start, $limit";
			$sql = mysql_query("select * from book limit $start, $limit") or die(mysql_error());								
			if (mysql_num_rows($sql) > 0) { ?>                             		
				  <thead>
					  <tr>
						 <th></th>
						 <th>Book Name</th>
						 <th>Author Name</th>
						 <th>Self_Num.</th>
						 <th>Self_row</th>
						 <th>Self_Col.</th>
						 <th>Category</th>
						 <th>Stock</th>
					  </tr>
				 </thead>                                                                    
					<?php
					while($row = mysql_fetch_array($sql)) {
						echo ' <tbody> <tr>';
						echo '<td class="info">'.$row["id"]."</td>";
						echo '<td class="danger"><a href="?q='.$row["b_name"].'">'.$row["b_name"]."</a></td>";
						echo '<td class="warning">'.$row["b_author_name"]."</td>";
						echo '<td class="success">'.$row["b_self"]."</td>";
						echo '<td class="info">'.$row["b_self_row"]."</td>";
						echo '<td class="danger">'.$row["b_self_colum"]."</td>";
						echo '<td class="success">'.$row["b_cat_name"]."</td>";
						echo '<td class="info">'.$row["b_stock"]."</td>";
						echo "</tr></tbody> ";
					} ?> 									                                                                       
		  
		   </table>
		<span style="text-align:center"><?php include "pagination.php"; ?></span>
			<?php } ?>
			<?php } ?>
		<!--End book list-->	
		
		<!--|||///Find Book List-->
	<?php if($pQ !=''){	?>
			<?php	
				$srch_key = trim($_GET['q']);
				//echo $srch_key;
				if($srch_key!='b_author'){
					$qr = mysql_fetch_array(mysql_query("SELECT * FROM book WHERE b_name= '$srch_key' "));	
				}else{
					exit;
				}
				//echo "SELECT * FROM `book` WHERE `b_name` LIKE '%".$srch_key."%' ";
				$total_self_row = $qr['b_self_row'];
				$self_colum =  $qr['b_self_colum'];
				$self_number = $qr['b_self'];
				$self_name = $qr['b_cat_name'];
				$book_stock = $qr['b_temp_stock'];  
				$search_key_id = $qr['id']; 
				if($qr){
					//echo  "";
				}else{
					echo  '<span style="text-align:center;color:red;"><h4> '.$srch_key.' Book Stock Not Available..</h4></span>';exit;
				}
				?>
				
		<div class="row">
		 <div class="col-md-1"></div>
		 <div class="col-md-10">
			<div class="panel panel-warning">
			  <div class="panel-heading">
			      <div class="row">
					<div class="col-md-4">
						<span class="panel-heading-custom">Book Name : <?php echo $srch_key;?></span>
					</div>
				<?php if(!isset($_SESSION['type'])){?>
					<?php 
						if($_GET['q']!=''){						
							$b_name = $_GET['q'];
							//echo "select * from book where `b_name` LIKE '%$b_name%'";
							$stck_check_qry = mysql_fetch_array(mysql_query("select * from book where `b_name` LIKE '%$b_name%'"));
							//echo $stck_check_qry['b_temp_stock'];
							if($stck_check_qry['b_temp_stock'] > 0){?>
							
						<div class="col-md-6 col-offset-2">
						<form class="form-horizontal" action="" method="POST">
							 																	 					
							<div class="row">    
								<div class="col-md-9"><input type="text" name="student" id="Student" class="form-control" placeholder="Student Id" required></div>			
								<div class="col-md-3"><button class="btn btn-warning" type="submit" name="Submit">search</button>
								</div>								  
							</div>
				        </form>
					</div>										
						<?php  } else{ ?>
							<div class="col-md-6 col-offset-2">
								<div class="well"><?php echo $srch_key;?> Book, At Present Stock Not Available..</div>
					</div>	
							
				<?php } } }?>
					
				</div>
			  </div>
			  <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
			  <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
			  
			  <?php if(isset($_POST['Submit'])){ 	
			        $s_id = $_POST['student'];

					//member check
					$qrs = mysql_fetch_array(mysql_query("SELECT * FROM student_faculty WHERE status='member' and s_id = '".$s_id."'"));

					//hoy many book taken
					$qrd = mysql_num_rows(mysql_query("SELECT * FROM book_record WHERE status!='return' and student_id = '".$s_id."'"));
					//0 bt member, 1 bt member

					if($qrs){
						if($qrd<4){
							$f='wxy';
						}else{
							$notMember =  "you already taken 4 book...";
						}
					}else{
						$notMember =  "Not Member...";
					}

			  ?>
			  <div class="row">
			   <div class="col-md-4"></div>
				<div class="col-md-4">
				  <?php 
				  if(isset($f)){?>
					<table class="table">
                                <tr>
                                	<td>Name :</td>
                                    <td><?php echo $qrs['s_name']; ?></td>
                                </tr>
                                <tr>
                                	<td>Id :</td>
                                    <td><?php echo $qrs['s_id']; ?></td>
                                </tr>
                                <tr>
                                	<td>Department :</td>
                                    <td><?php echo $qrs['s_department']; ?></td>
                                </tr>  
								<tr>
                                	<td> </td>
                                    <td>
									<form class="form-horizontal" action="" method="POST">
																															    
										<input type="hidden" name="id" id="Id" class="form-control" value="<?php echo $search_key_id; ?>">
										<input type="hidden" name="stdnt_id" id="Stdnt_id" class="form-control" value="<?php echo $qrs['s_id']; ?>">										
										<button class="btn btn-info" type="submit" name="bookConfirm">Issue Of Book</button>
									</form>
									</td>
                                </tr>  								
                              </table>
				  <?php } else{
					   echo '<span class="panel-heading-custom">'.$notMember.'</span>'; } 
					   ?>
				</div>
				<div class="col-md-4"></div>
			  </div>		  
				  <?php } ?>
			  			  
			  <div class="panel-heading" style="text-align:center;"><h3>Self Number : <?php echo $self_number;?> - <?php echo strtoupper($self_name); ?></h3></div>
			    <table class="table">
				<?php
				$i = 0;
				while($i < $total_self_row){		  
						  $cnt = $i+$i;
						  $odd = $cnt+1;
						  $even = $cnt+2;
		  
		    ?>	
		
			<tr>
				<td 
				<?php if($self_colum != $odd){ 
							echo "";
						}else{
							echo "class='self-custom'";}?> style="padding:10px;border: 10px solid #cccccc;">
				<?php 
					if($self_colum != $odd){ 
							echo '<span class="badge">'.$odd.'</span>';
						} else{
							echo '<div class="well well-sm" style="margin-top:125px;">';
									echo '<span class="panel-heading-custom">I am here, Self Column:'.$self_colum.'</span>';
									echo '<span class="panel-heading-custom">, Available Book:'.$book_stock.'</span>';
								echo '</div>';
							}
				?>
				</td>
				
				<td <?php if($self_colum != $even){ 
							echo "";
						  }else{
							  echo "class='self-custom'";}?> style="padding:10px;border: 10px solid #cccccc;">
				<?php 
					if($self_colum != $even){ 
							echo '<span class="badge">'.$even.'</span>';
						}else{
							echo '<div class="well well-sm" style="margin-top:125px;">';
									echo '<span class="panel-heading-custom">I am here, Self Column:'.$self_colum.'</span>';
									echo '<span class="panel-heading-custom">, Available Book:'.$book_stock.'</span>';
								echo '</div>';
						}
				?>
				</td>				
			</tr>
			
	       <?php $i++; } ?>
		   </table>
          </div>
    </div>
	<div class="col-md-1"></div>
	</div> 
	<?php } ?>
								
								
		</div>
	</div>
				
				 </div>
				 
			</div>
		
        </div>            
     </div> 
</div></div>

<?php include "footer.php"; ?>