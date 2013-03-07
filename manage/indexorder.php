<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/pagination_class_1.0/Pagination.php");
function layout($page_id) {
    switch($page_id) {
        default: //Default, ie when the page_id does not match with predefined cases
            defaultorder($page_id);
			break;
        case '': //When it is null
		    break;
		case 'paid': 
			defaultorder($page_id);
		    break;
		case 'cancelled': 
			defaultorder($page_id);
		    break;
		case 'commision': 
			Commission();
		    break;
		
	}
}
$page_id = $_GET["page"];
layout($page_id);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Order Details</title>
</head>

<body>
<?php
function defaultorder($page_id)
{
//pagination
 $select = mysql_query("SELECT * FROM `order` WHERE `order_status`='$page_id'");
 $num  = mysql_num_rows($select);
 $Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
 echo '<br/><br/><br/>'; 
 echo $Pagination->display();
 echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
 
 //end
$selectquery = mysql_query("SELECT * FROM `order` WHERE `order_status`='$page_id' LIMIT $start,$end") or die("SELECT * FROM `order` WHERE `order_status`='$page_id' LIMIT $start,$end".mysql_error());
?>
<br /><br /><br />
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px"">

                <div class="head">
                <?php
                if($page_id=='paid')
				{			
                ?>
                <h2>Paid Order</h2>
                <?php
				}
				elseif($page_id=='cancelled')
				{			
                ?>
                <h2>Cancelled Order</h2>
                <?php
				}
				?>
				</div>


                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="20">ID</th><th width="30">Item</th><th width="380">Username</th><th width="80" nowrap>Quantity</th><th width="100">Total <br/>Amount</th><th width="110">Delivery</th></tr>

					<?php
					while($result = mysql_fetch_array("$selectquery"))
					{
					?>
					<td style="text-align:center"><?php echo $result["oder_id"] ?></td>
					<td style="text-align:center"><?php echo $result["deal_name"] ?></td>
                    <td style="text-align:center">
					<?php
					 $userid =  $result["user_id"];
					 $selectuser = mysql_query("select username from user where ID='$userid'") or die("select username from user where ID='$userid'".mysql_error());
					 $nameresult = mysql_fetch_array($selectuser);
					 $username = $nameresult["username"];
					 echo $username;
					 ?></td>
                    <td style="text-align:center"><?php echo $result["quantity"] ?></td>
                    <td style="text-align:center"><?php echo $result["total_amount"] ?></td>
                    <td style="text-align:center"><?php echo $result["delivery"] ?></td>
                    <?php
					}
					?>
                    </table>

				</div>

</div>
<?php 
}
function Commission()
{
?>
<br /><br /><br />
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px"">

                <div class="head">
                <h2>Commission</h2>
                <div class="sect">
                
					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="20">Deal Name</th><th width="30">Purchased</th><th width="380">Deal Price</th><th width="20"></th><th width="80" nowrap>% of Commision</th><th width="100">Commission set by </th><th width="50">Commission Amount</th></tr>

					
					<tr><td colspan="9"><ul class="paginator"><li class="current">1</li></ul></tr>

					<tr><td></td><td></td><td></td><td></td><td>Total Commission Amount</td><td>AED <?php echo aed ?></td></tr>

                    </table>

				</div>

</div>
<?php 
}
?>

</body>
</html>
