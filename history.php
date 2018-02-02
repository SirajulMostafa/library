<?php include "header.php"; ?>
<?php include "checkiner.php"; ?>
<?php 
$pQ = "";
if(isset($_GET['q'])){
	$pQ = $_GET['q'];
}
$pLimit='';
if(isset($_GET['limit'])){
	$pLimit = $_GET['limit'];
}
?>




<div class="container">
	<div class="row">		
        <div class="col-md-12 col-body-custom">			
			<?php include "adminMenu.php"; ?>
			
			<div class="row" style="margin-top:25px;">
				 <div class="col-md-12">
					
			

<div class="row">
	<div class="col-md-12" style="margin-top:10px;">
	
	<!--Table Block-->
	 <div class="panel panel-warning">	

        <!-- by book list-->		
	<?php if(empty($pQ)){ ?>
	<div class="panel-heading">

			History <span style="margin-left:200px;background-color:#dff0d8 ; color:#000; padding:5px;">Already return</span> | 
				         <span style="background-color:#f2dede; color:#000; padding:5px;">Expire Date</span>
    </div>

	<table class="table">
	    <?php
			$limit = 5;
			if($pLimit!=''){
				$start = $pLimit;
			}else{
				$start = 0;
			}
			$student_id=$_SESSION['faculty_id'];
			//echo "select * from book limit $start, $limit";
				$sql = mysql_query("SELECT b.id as slno, b.student_id, b.provide_date, b.expire_date, b.return_date, b.renew_date, b.status, b.book_id, s.s_name FROM book_record b, student_faculty s where b.student_id=$student_id and b.student_id=s.s_id ORDER BY status ") or die(mysql_error());								
			if (mysql_num_rows($sql) > 0) { ?>                             		
				  <thead>
					  <tr>
						 <th></th>
						 <th>Book Name</th>
						 <th>Receive Date</th>
						 <th>Expire Date</th>
						 <th>return Date</th>
						 <th>Renew Date</th>
						 <th>Status</th>
					  </tr>
				 </thead>                                                                    
					<?php
					while($row = mysql_fetch_array($sql)) {
						$today = date('Y-m-d');
						if($row['status']=='return'){
							$color= "success";
						}elseif($today > $row["expire_date"]){
							$color= "danger";
						}else {
							$color= "";
						}
						
						$book_id = $row["book_id"];
						$sqlr =mysql_fetch_array(mysql_query("SELECT * FROM book where id=$book_id"));	

						echo ' <tbody> ';
						echo '<tr class="'.$color.'">';
						echo '<td>'.$row["slno"]."</td>";
						echo '<td>'.$sqlr["b_name"]."</td>";
						echo '<td>'.$row["provide_date"]."</td>";
						echo '<td>'.$row["expire_date"]."</td>";
						echo '<td>'.$row["return_date"]."</td>";
						echo '<td>'.$row["renew_date"]."</td>";
						echo '<td>'.$row["status"]."</td>";
						echo "</tr></tbody> ";
					} ?> 									                                                                       
		  
		   </table>
			<?php } ?>
			<?php } ?>
		<!--End book list-->							
								
		</div>
	</div>
				
				 </div>
				 
			</div>
		
        </div>            
     </div> 
</div></div>

<?php include "footer.php"; ?>