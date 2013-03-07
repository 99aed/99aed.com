<?php
error_reporting(E_ERROR | E_PARSE);
include("../includes/db.php");
include("../includes/function.php");
$deal_id = $_GET["dealid"];

$selectdeal = mysql_query("select * from deals where id='$deal_id'") or die ("select * from deals where id='$deal_id'".mysql_error());
$result     = mysql_fetch_array($selectdeal);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deal Details</title>
</head>

<body>
<style>
div.block{
  overflow:hidden;
}
div.block label{
  width:160px;
  display:block;
  float:left;
  text-align:left;
}
div.block .input{
  margin-left:4px;
  float:left;
}
</style>
<form action="" method="post" name="dealdetail">

  <div class="block" style="margin-bottom:20px;">
     <label><font size="+1">Deal Details</font></label>
     </div>
  <div class="block" style="margin-bottom:20px;">
    <label><b>Item name:</b></label>
    <?php echo $result["name"];?>
  </div>
  <div class="block" style="margin-bottom:20px;">
    <label><b>Deal time:</b></label>
    <label>Starts:&nbsp;<?php echo $result["begin_time"]?></label>
    <label>Ends:&nbsp;<?php echo $result["end_time"]?></label>
  </div>
  <div class="block" style="margin-bottom:20px;">
  <label><b>Deal Status:</b></label>
    <?php echo $result["stage"]?>
    </div>
  
  <div class="block" style="margin-bottom:20px;">
    <label><b>Quantity:</b></label>
    <label>At least:<?php echo $result["min_number"] ?></label>
    <label>At most:<?php echo $result["max_number"] ?></label>
    </div>
    <div class="block" style="margin-bottom:20px;">
    
    <label><b>Market Price:</b></label>
    <label><?php echo $result["market_price"] ?></label>
    <label><b>Deal Price</b></label>
    <label><?php echo $result["deals_price"] ?></label>
  </div>
 <!--<div class="block" style="margin-bottom:20px;">
    <label>Deal Status</label>
   &nbsp;<?php //echo $result["now_number"] ?>
 </div>-->
  <div class="block" style="margin-bottom:20px;">
    <label><b>Payment Status</b></label>
    </div>
  <div class="block" style="margin-bottom:20px;">
    <label><b>Item Balance</b></label>
   </div>

</form>
</body>
</html>
