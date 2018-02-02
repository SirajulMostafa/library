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
$pD='';
if(isset($_GET['d'])){
	$pD = $_GET['d'];
}
$pT='';
if(isset($_GET['t'])){
	$pT = $_GET['t'];
}
$pM='';
if(isset($_GET['m'])){
	$pM = $_GET['m'];
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

			<div class="row">
				<div class="col-md-4">
					<div class="row">    
						<div class="col-md-8">	
						<form class="form-horizontal" action="" method="GET">
							<select class="form-control" name="t" id="type" required>
									<option>By Type : </option>
									<option <?php if($pT=="student"){ echo 'selected';} ?> >student</option>
									<option <?php if($pT=="faculty"){ echo 'selected';} ?> >faculty</option>
							</select>
						</div>			
						<div class="col-md-4"><button class="btn btn-info" type="submit">Submit</button></div>
						</form>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">    
						<div class="col-md-8">	
						<form class="form-horizontal" action="" method="GET">
							<select class="form-control" name="d" id="department" required>
									<option>By Deparment : </option>
									<option <?php if($pD=="cse"){ echo 'selected';} ?> >cse</option>
									<option <?php if($pD=="eee"){ echo 'selected';} ?> >eee</option>
									<option <?php if($pD=="english"){ echo 'selected';} ?> >english</option>
									<option <?php if($pD=="bba"){ echo 'selected';} ?> >bba</option>
									<option <?php if($pD=="law"){ echo 'selected';} ?> >law</option>
									<option <?php if($pD=="socology"){ echo 'selected';} ?> >socology</option>
							</select>
						</div>			
						<div class="col-md-4"><button class="btn btn-info" type="submit">Submit</button></div>
						</form>
					</div>
                </div>
				<div class="col-md-4">
					<div class="row">    
						<div class="col-md-8">	
						<form class="form-horizontal" action="" method="GET">
							<select class="form-control" name="m" id="time" required>
									<option>By Time : </option>
									<option <?php if($pM=="expire"){ echo 'selected';} ?> >expire</option>
							</select>
						</div>			
						<div class="col-md-4"><button class="btn btn-info" type="submit">Submit</button></div>
						</form>
					</div>
				</div>
			</div>
	
    </div>

	<table class="table">
	    <?php
			$limit = 5;
			if($pLimit!=''){
				$start = $pLimit;
			}else{
				$start = 0;
			}
			//echo "select * from book limit $start, $limit";
			if(isset($_GET['d'])){
				$department = $_GET['d'];
				$sql = mysql_query("SELECT b.id as slno, b.student_id, b.provide_date, b.expire_date, b.renew_date, b.status, b.book_id, s.s_name, s.s_department, s.type FROM book_record b, student_faculty s where b.status!='return' and s.s_department='$department' and b.student_id=s.s_id limit $start, $limit") or die(mysql_error());
			}elseif(isset($_GET['t'])){
				$type = $_GET['t'];
				$sql = mysql_query("SELECT b.id as slno, b.student_id, b.provide_date, b.expire_date, b.renew_date, b.status, b.book_id, s.s_name, s.s_department, s.type FROM book_record b, student_faculty s where b.status!='return' and s.type='$type' and b.student_id=s.s_id limit $start, $limit") or die(mysql_error());

			}elseif(isset($_GET['m'])){
				$today = date('Y-m-d');
				$sql = mysql_query("SELECT b.id as slno, b.student_id, b.provide_date, b.expire_date, b.renew_date, b.status, b.book_id, s.s_name, s.s_department, s.type FROM book_record b, student_faculty s where b.status!='return' and b.expire_date<'$today' and b.student_id=s.s_id limit $start, $limit") or die(mysql_error());
				
			}else{
				$sql = mysql_query("SELECT b.id as slno, b.student_id, b.provide_date, b.expire_date, b.renew_date, b.status, b.book_id, s.s_name, s.s_department, s.type FROM book_record b, student_faculty s where b.status!='return' and b.student_id=s.s_id limit $start, $limit") or die(mysql_error());	
				}							
			if (mysql_num_rows($sql) > 0) { ?>                             		
				  <thead>
					  <tr>
						 <th></th>
						 <th>Book Name</th>
						 <th>Type</th>
						 <th>ID</th>
						 <th>Name</th>
						 <th>Receive Date</th>
						 <th>Expire Date</th>
						 <th>Renew Date</th>
						 <th>Status</th>
						 <th>Department</th>
					  </tr>
				 </thead>                                                                    
					<?php
					while($row = mysql_fetch_array($sql)) {

						$book_id = $row["book_id"];
						$sqlr =mysql_fetch_array(mysql_query("SELECT * FROM book where id=$book_id"));	

						echo ' <tbody> <tr>';
						echo '<td class="info">'.$row["slno"]."</td>";
						echo '<td class="danger">'.$sqlr["b_name"]."</td>";
						echo '<td class="info">'.$row["type"]."</td>";
						echo '<td class="warning">'.$row["student_id"]."</td>";
						echo '<td class="success">'.$row["s_name"]."</td>";
						echo '<td class="info">'.$row["provide_date"]."</td>";
						echo '<td class="danger">'.$row["expire_date"]."</td>";
						echo '<td class="success">'.$row["renew_date"]."</td>";
						echo '<td class="info">'.$row["status"]."</td>";
						echo '<td class="info">'.$row["s_department"]."</td>";
						echo "</tr></tbody> ";
					} ?> 									                                                                       
		  
		   </table>
		<span style="text-align:center"><?php include "pagination2.php"; ?></span>
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