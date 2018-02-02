<?php include "header.php"; ?>
<?php include "checkiner.php"; ?>
<?php
$pS='';
if(isset($_GET['s'])){
	$pS = $_GET['s'];
}
?>

<div class="container">
	<div class="row">		
        <div class="col-md-12 col-body-custom">			
			<?php include "adminMenu.php"; ?>

			<?php
				if(isset($_GET['m'])!=''){ 
						$date = date('Y-m-d');
						$id = $_GET['m'];
						$status = "member";
						$qry_member = mysql_query("update student_faculty set mem_date='$date', status='$status' where id='$id'");
					
						if($qry_member){
							$smsg = "Confirm Member successfully";
						}
				}
			
			?>
		<div class="panel panel-warning">
			<div class="panel-heading">
				<form class="form-horizontal" action="" method="GET">
						<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>	 																	 					
							<div class="row">    
								<div class="col-md-9"><input type="text" name="s" value="<?php if($pS!=''){ echo $pS; } ?>" class="form-control" placeholder="Student Id" required></div>			
								<div class="col-md-3"><button class="btn btn-warning" type="submit">search</button>
								</div>								  
							</div>
				        </form>
			</div>
                              <!-- Table -->
                              <table class="table">
                                <?php
								 if(isset($_GET['s'])!=''){ 
									$s_id = $_GET['s'];
									$qr = "SELECT * FROM student_faculty WHERE status ='normal' and s_id = '".$s_id."'";					
								    $result1 = mysql_query($qr) or die(mysql_error());
																	
							  	if (mysql_num_rows($result1) > 0) {?>                             		 
										  <thead>
										  <tr>
											 <th>Student Id</th>
											 <th>Name</th>
											 <th>Department</th>
											 <th>Status</th>
											 <th>Reg. Date</th>											 
											 <th>Action</th>										 
										  </tr>
										  </thead>                                                                           
										<?php
                                        while($row = mysql_fetch_array($result1)) {											
											echo "<tbody><tr>";
                                            echo "<td>".$row["s_id"]."</td>";
											echo "<td>".$row["s_name"]."</td>";
											echo "<td>".$row["s_department"]."</td>";
											echo "<td>".$row["status"]."</td>";
											echo "<td>".$row["reg_date"]."</td>";										
											echo "<td>";
                                            echo '<a href="/library/member.php?s='.$s_id.'&m='.$row['id'].'">'."<u>confirm</u>".'</a>';
                                            echo "</td>";										
											echo "</tr></tbody> ";
                                        } ?>  
										
								<?php } }?> 
                                
                              </table>
            </div> 
			
			
			
			
        </div>            
     </div> 
</div>
<?php include "footer.php"; ?>