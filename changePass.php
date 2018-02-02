<?php include "header.php"; ?>
<?php include "checkiner.php"; ?>
<?php //print_r($_SESSION);
if(isset($_POST['Submit'])){
	
	$oldPass  = $_POST['oldPass'];
	$newPass  = $_POST['newPass'];
	$confPass  = $_POST['confPass'];
	$user_level  = $_SESSION['user_level'];
	$qr = mysql_fetch_array(mysql_query("SELECT * FROM `user` where user_level='$user_level'"));
	if($qr['password']==$oldPass){
		if($newPass==$confPass){
			@mysql_query("update user set password = '$newPass' where user_level='$user_level'");
			$fmsg  = "password  change  successfully";
		}else{
			$fmsg  = "new pass  and  confirm  pass not match";
		}
		
	}else{
		$fmsg  = "old password wrong";
	}
}


?>

<div class="container">
	<div class="row">		
        <div class="col-md-12 col-body-custom">			
			<?php include "adminMenu.php"; ?>
			
		<div class="panel panel-info">
			<div class="panel-heading">Change Password</div>
                            <div class="row" style="margin-top:17px;">
								<div class="col-md-2"></div>
								<div class="col-md-8">
						<form class="form-horizontal" action="" method="POST">
							
							    <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
								<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
								                                               
							  <div class="form-group">
                                <label for="oldpassword" class="col-sm-3 control-label">Old Password</label>
                                <div class="col-sm-6">
                                  <input type="password" name="oldPass" id="oldpassword" class="form-control" placeholder="Old Password" required>
                                </div>
                              </div>
							  <div class="form-group">
                                <label for="newpassword" class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-6">
                                  <input type="password" name="newPass" id="newpassword" class="form-control" placeholder="New Password" required>
                                </div>
                              </div>
                             <div class="form-group">
                                <label for="confpassword" class="col-sm-3 control-label">Confirm Password</label>
                                <div class="col-sm-6">
                                  <input type="password" name="confPass" id="confpassword" class="form-control" placeholder="Confirm Password" required>
                                </div>
                              </div>
                             
                              <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">
								  <button class="btn btn-warning" type="submit" name="Submit">Submit</button>     
                                </div>
                              </div>
                         </form>
								
								
								
								</div>
								<div class="col-md-2">
								</div>
							</div>
            </div> 
			
        </div>            
     </div> 
</div>
<?php include "footer.php"; ?>