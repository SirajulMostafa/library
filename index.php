<?php include "header.php"; ?>
<?php include "check.php"; ?>

<?php  
	if (isset($_POST['SignIn'])){
			$username = mysql_real_escape_string($_POST['username']);
			$password = mysql_real_escape_string($_POST['password']);
			
		if($username=='admin'){
			$qr = "SELECT * FROM `user` WHERE userName='$username' and password='$password'";			 
			$result = mysql_query($qr) or die(mysql_error());
		}else{
			// s_id --- user name
			$qr = "SELECT * FROM `student_faculty` WHERE s_id='$username' and password='$password'";			 
			$result = mysql_query($qr) or die(mysql_error());
		}
			
			//user level
			$rs = mysql_fetch_array($result);
			
			$count = mysql_num_rows($result);
			
			if ($count == 1){								
				$_SESSION['user_level'] = $rs['user_level'];
				$_SESSION['type'] = $rs['type'];
				$_SESSION['id'] = $rs['id'];
				
				$_SESSION['faculty_id'] = $rs['s_id'];
				if($rs['user_level']=='Admin'){
					header('Location: /library/home.php');exit;
				}else{
					header('Location: /library/books.php');exit;
				}
				
			}else{
				$fmsg = "Invalid username/password.";
			}
	}
	
?>
<?php  
	if (isset($_POST['Registration'])){
			$name = mysql_real_escape_string($_POST['name']);
			$id = mysql_real_escape_string($_POST['id']);
			$department = mysql_real_escape_string($_POST['department']);
			$type = mysql_real_escape_string($_POST['type']);
			$password = mysql_real_escape_string($_POST['password']);
			$email = mysql_real_escape_string($_POST['email']);
			if($type=='student'){
					$status = "normal";
			}else{
				$status = "member";
			}
			
			$date = date('Y-m-d');
			
			$qr = mysql_fetch_array(mysql_query("SELECT * FROM `student_faculty` WHERE s_id='$id'"));
		    if($qr['s_id']==$id){
				$fRmsg = "already this id registerd";
			}else{
				$qr = "insert into student_faculty (`s_name`,`s_id`,`password`,`email`,`s_department`,`status`,`type`,`reg_date`) value ('$name','$id','$password','$email','$department','$status','$type','$date')";		
				$result = mysql_query($qr) or die(mysql_error());
				if ($result){										
					$smsg = "Registration Successfully.";
				}else{
					$fRmsg = "Registration Failed.";
				}
			}
	}
	
?>
<div class="container">
	<div class="row">		
        <div class="col-md-6 col-body-custom">		
			<div class="row col-body-2-custom">
				<div class="col-md-10"><h3>Registration</h3></div>
			</div>
            <div class="row" style="border-right:1px #ccc solid;margin-top:30px;">    
				<div class="col-md-1"></div>
				<div class="col-md-10">
				<form class="form-horizontal" action="" method="POST">
				
				 <?php if(isset($smsg)){ ?><div class="alert alert-info" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
				 <?php if(isset($fRmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fRmsg; ?> </div><?php } ?>
				 
					<div class="row" style="margin-bottom:8px;">    
						<div class="col-md-4 col-body-3-custom">Name</div>			
						<div class="col-md-8"><input type="text" name="name" id="name" class="form-control" placeholder="Name" required></div>								  
					</div>
					<div class="row" style="margin-bottom:8px;">    
						<div class="col-md-4 col-body-3-custom">ID</div>			
						<div class="col-md-8"><input type="text" name="id" id="id" class="form-control" placeholder="student or faculty id" required></div>								  
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
					<div class="row" style="margin-bottom:8px;">    
						<div class="col-md-4 col-body-3-custom">Type</div>			
						<div class="col-md-8">
						<select class="form-control" name="type" id="type" required>
							<option></option>
							<option>student</option>
							<option>faculty</option>					
                        </select>
						</div>								  
					</div>
					<div class="row" style="margin-bottom:12px;">    
						<div class="col-md-4 col-body-3-custom">Email</div>			
						<div class="col-md-8"><input type="email" name="email" id="email" class="form-control" placeholder="Email" required></div>								  
					</div>
					<div class="row" style="margin-bottom:12px;">    
						<div class="col-md-4 col-body-3-custom">Password</div>			
						<div class="col-md-8"><input type="password" name="password" id="Password" class="form-control" placeholder="Password" required></div>								  
					</div>
					<div class="row">    
						<div class="col-md-4"></div>			
						<div class="col-md-8"><button class="btn btn-info" type="submit" name="Registration">Registration</button>
						</div>								  
					</div>
				 </form>
				</div>	
				<div class="col-md-1"></div>
			</div>	  				  			                                                                             	 			  
        </div>  
		<div class="col-md-6 col-body-custom">		
				<div class="row col-body-2-custom">
				<div class="col-md-10"><h3>Sign In</h3></div>
			</div>
            <div class="row" style="margin-top:30px;">    
				<div class="col-md-1"></div>
				<div class="col-md-10">
				<form class="form-horizontal" action="" method="POST">
				<?php if(isset($_GET['try'])){?><div class="alert alert-danger" role="alert"> <?php echo $_GET['try']; ?> </div><?php } ?>
				 <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
				 
					<div class="row" style="margin-bottom:8px;">    
						<div class="col-md-4 col-body-3-custom">User Name</div>			
						<div class="col-md-8"><input type="text" name="username" id="Username" class="form-control" placeholder="User Name" required></div>								  
					</div>
					<div class="row" style="margin-bottom:12px;">    
						<div class="col-md-4 col-body-3-custom">Password</div>			
						<div class="col-md-8"><input type="password" name="password" id="Password" class="form-control" placeholder="Password" required></div>								  
					</div>
					<div class="row">    
						<div class="col-md-4"></div>			
						<div class="col-md-8"><button class="btn btn-info" type="submit" name="SignIn">Login</button>
						</div>								  
					</div>
				 </form>
				</div>	
				<div class="col-md-1"></div>
			</div>	  			
		</div> 		
     </div> 
</div>
<?php include "footer.php"; ?>