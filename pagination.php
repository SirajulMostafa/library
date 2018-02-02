<?php

$query = mysql_fetch_array(mysql_query("select count(*) as total from book"));

$total = $query['total'];
$limit = 6;
$page = ceil($total/$limit);
//echo $page;

?>


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