<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/function.php");
include("../includes/pagination_class_1.0/Pagination.php");
$page_id = $_GET["page"];
layout($page_id);
function layout($page_id) {
    switch($page_id) {
        default: //Default, ie when the page_id does not match with predefined cases
            couponpage('unused');
			break;
        case '': //When it is null
		    couponpage('unused');
			break;		    
		case 'unused': 
			couponpage($page_id);
		    break;
		case 'used': 
			couponpage($page_id);
		    break;
		case 'expired': 
			couponpage($page_id);
		    break;
		case 'current': 
			couponpage($page_id);
		    break;
		
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Coupon Index</title>
</head>

<body>
<?php
function couponpage($page_id)
{
//pagination
 $select = mysql_query("select * from card");
 $num  = mysql_num_rows($select);
 $Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
 echo '<br/><br/><br/>'; 
 echo $Pagination->display();
 echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
 //end 
 
 $selectquery = mysql_query("select * from card LIMIT $start,$end") or die ("select * from card LIMIT $start,$end".mysql_error());
 
?>
<br /><br /><br />
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px"">

                <div class="head">
                <h2>
                <?php
                if($page_id=='unused')
				 echo "Unused Voucher";
				elseif($page_id=='used')
				 echo "Consumed Voucher";
				elseif($page_id=='expired')
				 echo "Expired Voucher";
				
				?>
                </h2>           


                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="30">ID</th><th width="380">Deal Name</th><th width="30">Couponcode</th><th width="20">Username</th><th width="80" nowrap>Valid Till</th></tr>

					<?php
					while($result = mysql_fetch_array($selectquery))
					{
					?>
                    <tr>
                      <td style="text-align:center"><?php echo $result["id"] ?></td>
                      <td style="text-align:center"><?php echo $result["dealname"] ?></td>
                      <td style="text-align:center"><img src="<?php echo $result["couponpath"] ?>"/></td>                      
                      <td style="text-align:center"><?php ?></td>
                      <td style="text-align:center"><?php echo $result["end_time"] ?></td>
                    </tr>
                    <?php
					 }
					 ?>
						

                    </table>

				</div>
</div>
<?php
}
?>

</body>
</html>
