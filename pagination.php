<?php 
	
if($total_found_rows > $config_max_records_per_page){ 

?>

	<ul class="pagination">

	<?php
		
		if($total_pages <= 100){
			$pages_split = 10;
		}
		if(($total_pages <= 1000) AND ($total_pages > 100)){
			$pages_split = 100;
		}
		if(($total_pages <= 10000) AND ($total_pages > 1000)){
			$pages_split = 1000;
		}
		if($page > 1 ){
			$prev_class = "";
		}else{
			$prev_class = "disabled";
		}
		if($page <> $total_pages){
			$next_class = "";
		}else{
			$next_class = "disabled";
		}

	    $url_query_strings = http_build_query(array_merge($_GET,array('page' => $i)));
	    $prev_page = $page - 1;
	    $next_page  = $page + 1;
		
		if($page > 1 ){
			echo "<li class='prev $prev_class'><a href='?$url_query_strings&page=$prev_page'><</a></li>";
		}
		
		while ($i < $total_pages){
	    	$i++;
			if(($i == 1) OR (($page <= 3 ) AND ($i <= 6)) OR (( $i >  $total_pages - 6) AND ($page > $total_pages - 3 )) OR (is_int($i / $pages_split)) OR (($page > 3 ) AND ($i >= $page - 2) AND ($i <= $page + 3)) OR ($i == $total_pages)){
		        if($page == $i ){
		        	$page_class = "active"; 
		        }else{ 
		        	$page_class = "";
		    	}
		    	echo "<li class='$page_class'><a href='?$url_query_strings&page=$i'>$i</a></li>";
			}
		}
		if($page <> $total_pages){
			echo "<li class='next $next_class'><a href='?$url_query_strings&page=$next_page'>></a></li>";
		}

	?>

	</ul>

<?php
}
?>