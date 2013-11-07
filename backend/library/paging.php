<?php
//
// Paging
//

// FIXME : fix number of page displayed


function  paging($base_url,$total,$per_page,$cur_page,$show='3') {

  
  $maxPage = ceil($total/$per_page);
  if($maxPage<=1) return;

  $self = $_SERVER['PHP_SELF'];
  
  $start = max(1,$cur_page - $show - max(0,$show-$cur_page));
  $end = min ($maxPage,$cur_page + $show + max(0,$show-$cur_page)  );
  
  
  // previous
  
  if($cur_page>1&&$maxPage>1) {
    $page = $cur_page -1;
    $prems .="<a href=\"$base_url$page\" class=\"disabled\">&#9668;</a> ";
  }
  else {
    $prems .='<span class="disabled">&#9668;</span> ';
  }
  
  // next
  
  if($cur_page<$maxPage) {
    $page = $cur_page +1;
    $dernz .="<a href=\"$base_url$page\" >&#9658;</a> ";
  }
  else {
    $dernz .='<span class="disabled">&#9658;</span> ';
  }

  // First 
  
  
  // Last
	if($start>1) {
	 
    $nav .= " <a href=\"$base_url\1\">1</a> ";
    if($start>2) {
	    $nav .= "<span>&hellip;</span>";
	  }
	}
  for($page = $start; $page <= $end; $page++) {
     if ($page == $cur_page)    {
        $nav .= " <span class=\"current\">$page</span> "; // no need to create a link to current page
     }
     else {
        $nav .= " <a href=\"$base_url$page\">$page</a> ";
     } 
  }
	if($end<$maxPage) {
	  if($end<$maxPage-1) {
  	  $nav .= "<span>&hellip;</span>";
	  }
	  $nav .= " <a href=\"$base_url$maxPage\">$maxPage</a> ";
  }
  return "<div class='pagination'>$prems$nav$dernz</div>";

}
