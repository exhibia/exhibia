<?php
if(!empty($_REQUEST['ajax'])){

db_query("update testimonials set status = '$_REQUEST[status]' where id = '$_REQUEST[id]'");
db_query("update testimonials set text = '" . addslashes(urldecode($_REQUEST['testimonial'])) . "' where id = '$_REQUEST[id]'");
echo db_error();

}else{
$PRODUCTSPERPAGE = '10';
if(!empty($_REQUEST['pageno'])){
$StartRow = $_REQUEST['pageno'];
}else{
$StartRow = 0;
}

    $query="select * from testimonials left join registration as r on testimonials.user_id=r.id left join avatar as a on r.avatarid=a.id";
    
      if(!empty($_REQUEST['status'])){
      
      $query .= " and status = $_REQUEST[status]";
      
      }

      if(!empty($_REQUEST['date_from'])){
      
      $query .= " and date >= '$_REQUEST[date_from]'";
      
      }

      if(!empty($_REQUEST['date_to'])){
      
      $query .= " and date <= '$_REQUEST[date_to]'";
      
      }
    

$result=db_query($query);
    $totalrows=db_num_rows($result);
    echo db_error();
    $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);

    $total = db_num_rows($result);

    $query .= " order by testimonials.test_id";
    $query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";

    $result =db_query($query);

  

    $result=db_query($query);
    $totalcat = db_num_rows($result);

    $totalrows=db_num_rows($result);
    $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
    //$query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
    $result =db_query($query);
}