<?php include "header.php"; ?>
<?php include "checkiner.php"; ?>

<?php
    if(isset($_POST['Submit'])){
		
		$b_name = mysql_real_escape_string($_POST['b_name']);
	    $a_name = mysql_real_escape_string($_POST['a_name']);     
		$s_num = mysql_real_escape_string($_POST['s_num']);
		$s_row = mysql_real_escape_string($_POST['s_row']);
		$s_col = mysql_real_escape_string($_POST['s_col']);
		$dpartmnt = mysql_real_escape_string($_POST['dpartmnt']);
		$b_stock = mysql_real_escape_string($_POST['b_stock']);
		$date = date('Y-m-d');
		
        $qry = "INSERT INTO `book` (b_name, b_author_name, b_self, b_self_row, b_self_colum, b_cat_name, b_stock, b_temp_stock, b_entry_date) VALUES ('$b_name', '$a_name', '$s_num', '$s_row', '$s_col', '$dpartmnt', '$b_stock', '$b_stock', '$date')";
		
        $rslt = mysql_query($qry) or die(mysql_error());
        if($rslt){
            $smsg = "New Book Submit Successfully.";
        }else{
            $fmsg ="Submit Failed";
        }
		
    }
?>

<div class="container">
	<div class="row">		
        <div class="col-md-12 col-body-custom">			
			<?php include "adminMenu.php"; ?>
			
		<div class="panel panel-info">
			<div class="panel-heading">New Book</div>
                            <div class="row" style="margin-top:17px;">
								<div class="col-md-2"></div>
								<div class="col-md-8">
						<form class="form-horizontal" action="" method="POST">
							
							    <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
								<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
								<div class="form-group">
                                <label for="bookName" class="col-sm-3 control-label">Book Name</label>
                                <div class="col-sm-6">
                                  <input type="text" name="b_name" id="bookName" class="form-control" placeholder="Book Name" required>
                                </div>
                              </div> 
							  <div class="form-group">
                                <label for="authorName" class="col-sm-3 control-label">Author Name</label>
                                <div class="col-sm-6">
                                  <input type="text" name="a_name" id="authorName" class="form-control" placeholder="Author Name" required>
                                </div>
                              </div>
                           
                              <div class="form-group">
                                <label for="department" class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-6">
                                  <select class="form-control" name="dpartmnt" id="department" required>
									                 <option></option>
                                    <option>cse</option>
                                    <option>eee</option>
                                    <option>english</option>
                  									<option>bba</option>
                  									<option>law</option>
                  									<option>psychology</option>
                                    <option>sociology</option>
                                    <option>economics</option>
                                    <option>administration</option>
                                    <option>english language</option>
                                    <option>mathematics</option>
                                    <option>chemistry</option>
                                    <option>pharmacy</option>
                                    <option>telecommucation</option>
                                    <option>human resource</option>
                                    <option>arcitecture</option>
                                    <option>literature</option>
                                    <option>history</option>
                                    <option>journal</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="selfNum" class="col-sm-3 control-label">Self Number</label>
                                <div class="col-sm-6">
                                  <select class="form-control" name="s_num" id="selfNum" required>
                                      <option></option>
                                      <option>1</option>
                                      <option>1(A)</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      <option>5(A)</option>
                                      <option>5(B)</option>                        
                                      <option>6(A)</option>
                                      <option>6(B)</option>                                  
                                      <option>7(A)</option>
                                      <option>7(B)</option>
                                      <option>8(A)</option>
                                      <option>8(B)</option>
                                      <option>9(A)</option>
                                      <option>9(B)</option>
                                      <option>10(A)</option>
                                      <option>10(B)</option>
                                      <option>11(A)</option>
                                      <option>11(B)</option>
                                      <option>12(A)</option>
                                      <option>12(B)</option>
                                      <option>13(A)</option>
                                      <option>13(B)</option>
                                      <option>16(A)</option>
                                      <option>16(B)</option>
                                  </select>
                                </div>
                              </div>
							  <div class="form-group">
                                <label for="selfRow" class="col-sm-3 control-label">Total Self Row</label>
                                <div class="col-sm-6">
                                  <input type="text" name="s_row" id="selfRow" class="form-control" placeholder="Total Self Row" required>
                                </div>
                              </div>
							  <div class="form-group">
                                <label for="selfColum" class="col-sm-3 control-label">Self Column</label>
                                <div class="col-sm-6">
                                  <input type="text" name="s_col" id="selfColum" class="form-control" placeholder="Self Column" required>
                                </div>
                              </div>
                             <div class="form-group">
                                <label for="bookStock" class="col-sm-3 control-label">Book Stock</label>
                                <div class="col-sm-6">
                                  <input type="text" name="b_stock" id="bookStock" class="form-control" placeholder="Course Code" required>
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
									<table class="table"><tr>
                      <?php 
                        $sq = mysql_query("select * from self");
                        $x = 0;
                        while($rs=mysql_fetch_array($sq)){
    
                              echo '<td style="background-color:#DAF7A6;">'.$rs['self_name'].'</td>';
                              echo '<td style="background-color:#f0ad4e; color:#fff;">'.$rs['self_row'].'</td>';
                              $x++;
                              if ($x % 2 == 0) { echo "</tr><tr>"; } 
                                  
                                  
                        } ?>
</tr>
									</table>
								</div>
							</div>
            </div> 
			
        </div>            
     </div> 
</div>
<?php include "footer.php"; ?>