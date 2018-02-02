<?php include "header.php"; ?>
<?php include "checkiner.php"; ?>

<?php  
if (isset($_POST['Confirm'])){
		$name = mysql_real_escape_string($_POST['name']);
		$description = mysql_real_escape_string($_POST['description']);
		$department = mysql_real_escape_string($_POST['department']);
		$faculty_id = $_SESSION['faculty_id'];
		$date = date('Y-m-d');
			
		$qr = "insert into requisition_book (`b_name`,`description`,`department`,`faculty_id`,`date`) value ('$name','$description','$department','$faculty_id','$date')";		
		$result = mysql_query($qr) or die(mysql_error());
		if ($result){										
			$smsg = "Requisition Successfully.";
		}else{
			$fRmsg = "Requisition Failed.";
		}
		
}

?>



<div class="container">
	<div class="row">		
        <div class="col-md-12 col-body-custom">			
			<?php include "adminMenu.php"; ?>
			
		<div class="panel panel-info">
			<div class="panel-heading">Requisition Book List</div>
               
			<?php if(!isset($_SESSION['type'])){?>			   
				<!--// for admin panel-->
				<table class="table">
				<?php 
					$sql = mysql_query("select * from requisition_book");
					if(mysql_num_rows($sql)>0){?>
						<tr>
						<th>Book Name</th>
						<th>Description/Author Name</th>
						<th>Faculty Name</th>
						<th>Department</th>
						<th>Requisition Date</th>
						</tr>
						<?php while($r=mysql_fetch_array($sql)){
							$f_id = $r['faculty_id'];
							$qry = mysql_fetch_array(mysql_query("select * from student_faculty where s_id='$f_id'"));
							?>
								<tr>
									<td class="danger"><?php echo $r['b_name'];?></td>
									<td class="warning"><?php echo $r['description'];?></td>
									<td class="danger"><?php echo $qry['s_name'];?></td>
									<td class="warning"><?php echo $r['department'];?></td>
									<td class="danger"><?php echo $r['date'];?></td>
								</tr>
							
							<?php }?>  
					 </table>
			<?php } }  ?>   
						   
			   <!--// for faculty panel-->
			   <?php if(isset($_SESSION['type'])){?>
					<div class="row" style="margin-top:20px; margin-bottom:20px;">								
						<div class="col-md-6 col-md-offset-2">
							<form class="form-horizontal" action="" method="POST">
							 <?php if(isset($smsg)){ ?><div class="alert alert-info" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
							 <?php if(isset($fRmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fRmsg; ?> </div><?php } ?>
					 
						<div class="row" style="margin-bottom:8px;">    
							<div class="col-md-4 col-body-3-custom">Book Name</div>			
							<div class="col-md-8"><input type="text" name="name" id="name" class="form-control" placeholder="Requisition Book Name" required></div>								  
						</div>
						<div class="row" style="margin-bottom:8px;">    
							<div class="col-md-4 col-body-3-custom">Description</div>			
							<div class="col-md-8"><textarea class="form-control" rows="5" name="description" id="Description" placeholder="author name or description here..." required></textarea></div>								  
						</div>
						<div class="row" style="margin-bottom:8px;">    
							<div class="col-md-4 col-body-3-custom">Department</div>			
							<div class="col-md-8">
							<select class="form-control" name="department" id="department" required>
								<option></option>
								<option>cse</option>
								<option>eee</option>
								<option>english</option>
								<option>bba</option>
								<option>law</option>
								<option>sociology</option>
								<option>architecture</option>
								<option>pharmacy</option>
								<option>mathematics</option>
								<option>economics</option>
							</select>
							</div>								  
						</div>
						<div class="row">    
							<div class="col-md-4"></div>			
							<div class="col-md-8"><button class="btn btn-info" type="submit" name="Confirm">Confirm</button>
							</div>								  
						</div>
					 </form>
						
						</div>							
					</div>

			   <?php } ?>
						   
            </div> 
			
        </div>            
     </div> 
</div>
<?php include "footer.php"; ?>