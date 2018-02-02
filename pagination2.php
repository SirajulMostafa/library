<?php

      if(isset($_GET['d'])){
        $department = $_GET['d'];
        $query = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM book_record b, student_faculty s where b.status!='return' and s.s_department='$department' and b.student_id=s.s_id"));
        $parametar="d=".$_GET['d']."&";;
      }elseif(isset($_GET['t'])){
        $type = $_GET['t'];
        $query = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM book_record b, student_faculty s where b.status!='return' and s.type='$type' and b.student_id=s.s_id"));
        $parametar="t=".$_GET['t']."&";;
      }elseif(isset($_GET['m'])){
        $today = date('Y-m-d');
        $query = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM book_record b, student_faculty s where b.status!='return' and b.expire_date <'$today' and b.student_id=s.s_id"));
        $parametar="m=".$_GET['m']."&";;
      }else{
        $query = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM book_record b, student_faculty s where b.status!='return' and b.student_id=s.s_id"));  
        } 


$total = $query['total'];
$limit = 5;
$page = ceil($total/$limit);
//echo $page;
echo "total find=".$total;
if($total>$limit){
  if(isset($_GET['d']) or isset($_GET['t']) or isset($_GET['m'])){
?>


<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a href="?<?php echo $parametar; ?>p=<?php echo "0&limit=0"; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
	<?php    
		$lastPagee = $page-1;
		$lastPageeLimit = $lastPagee*$limit;
		//echo $lastPagee;
		for($i=0; $i<$page ; $i++){		
			$lim = $limit*$i;
			if($i>0 and $i<$lastPagee){
				echo "<li><a href='?$parametar p=$i&limit=$lim'>$i</a>";
			}
		 } ?>
    <li>	
      <a href="?<?php echo $parametar; ?>p=<?php echo $lastPagee."&limit=".$lastPageeLimit; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<?php }else{?>

<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <a href="?p=<?php echo "0&limit=0"; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
  <?php 
    $lastPagee = $page-1;
    $lastPageeLimit = $lastPagee*$limit;
    //echo $lastPagee;
    for($i=0; $i<$page ; $i++){   
      $lim = $limit*$i;
      if($i>0 and $i<$lastPagee){
        echo "<li><a href='?p=$i&limit=$lim'>$i</a>";
      }
     } ?>
    <li>  
      <a href="?p=<?php echo $lastPagee."&limit=".$lastPageeLimit; ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>


<?php } }?>