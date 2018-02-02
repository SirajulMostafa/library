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
			// return book
				if(isset($_GET['b_id'])!=''){ 
						$date = date('Y-m-d');
						$id = $_GET['id'];
						$book_id = $_GET['b_id'];
						$status = "return";
						$qry_return = mysql_query("update book_record set return_date='$date', status='$status' where id='$id'");
						
						$qr_stock = mysql_fetch_array(mysql_query("select * from book where id='$book_id'"));						
						$now_stock = $qr_stock['b_temp_stock'] + 1;
						@mysql_query("update book set b_temp_stock='$now_stock' where id='$book_id'");
					
						if($qry_return){
							$smsg = "successfully return book";
						}
				}
			
			?>
			<?php
			// renew book
				if(isset($_GET['book_id'])!=''){ 
						$date = date('Y-m-d');
						$id = $_GET['id'];
						$book_id = $_GET['book_id'];
						$status = "renew";

						//renew hole expire date add hobe 7days from renew date.
						$expire_date_update = date('Y-m-d',strtotime($date . "+7 days"));

						$qry_renew = mysql_query("update book_record set expire_date='$expire_date_update', renew_date='$date', status='$status' where id='$id'");		

						if($qry_renew){
							$smsg = "successfully renew book";
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
				<?php
					if(isset($_GET['s'])!=''){ ?>
				         <span style="margin-left:200px;background-color:#008000; color:#fff; padding:5px;">Dedline Date</span> | 
				         <span style="background-color:#FFC300; color:#000; padding:5px;">Expire Date</span>

				 <?php } ?>
			</div>
                              <!-- Table -->
                              <table class="table">
                                <?php
								 if(isset($_GET['s'])!=''){ 
									$s_id = $_GET['s'];
									$qr = "SELECT * FROM book_record WHERE status !='return' and student_id = '".$s_id."'";					
								    $result1 = mysql_query($qr);

								    $check_reslt = mysql_num_rows($result1);
								    if($check_reslt > 0){
								    	//echo "result here";
								    }else{
								    	echo "<h3 style='color:red;'>Book not found, For this -".$s_id. "</h3>"; exit;
								    }
																	
									
							  	if (mysql_num_rows($result1) > 0) {?>                             		 
										  <thead>
										  <tr>
											 <th>Student Id</th>
											 <th>Book Name</th>
											 <th>Receive Date</th>
											 <th>Last Date</th>
											 <th>Fine</th>											 
											 <th>Action</th>										 
										  </tr>
										  </thead>                                                                           
										<?php
                                        while($row = mysql_fetch_array($result1)) {
																						
											$then = $row['expire_date'];
											$then = strtotime($then);
											$now = time();
											$difference = $now - $then;
											$days = floor($difference / (60*60*24) );
											//10 means 10 taka
											$fine_amount = $days*10;
										
											
											$qr_book_name = mysql_fetch_array(mysql_query("select * from book where id='".$row['book_id']."'"));
											echo "<tbody><tr>";
                                            echo "<td>".$row["student_id"]."</td>";
											echo "<td>".$qr_book_name["b_name"]."</td>";
											echo "<td>".$row["provide_date"]."</td>";
											if($row['expire_date'] < date('Y-m-d')){
												echo "<td style='background-color:#FFC300 ;color:#000;'>".$row["expire_date"]."</td>";
											}else{
												echo "<td style='background-color:#008000;color:#fff;'>".$row["expire_date"]."</td>";
											}
											echo "<td>";
											if($row['expire_date'] < date('Y-m-d')){
												echo $days." Days =".$fine_amount."Tk"; 
											} 
											echo "</td>";											
											echo "<td>";
                                            echo '<a href="/library/return.php?s='.$s_id.'&b_id='.$row["book_id"].'&id='.$row["id"].'">'."<u>Return</u>".'</a>';
                                             
                                            echo ($row['expire_date'] < date('Y-m-d')) ? ' | <a href="/library/return.php?s='.$s_id.'&book_id='.$row["book_id"].'&id='.$row["id"].'">'."<u>Renew</u>".'</a>' : '';

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