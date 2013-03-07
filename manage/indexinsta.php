<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/function.php");
include("../includes/pagination_class_1.0/Pagination.php");
function layout($page_id) {
    switch($page_id) {
        default: //Default, ie when the page_id does not match with predefined cases
            liveinsta('review');
			break;
        case '': //When it is null
		    liveinsta('review');
			break;		    
		case 'review': 
			liveinsta($page_id);
		    break;
		case 'live': 
			liveinsta($page_id);
		    break;
		case 'approved': 
			liveinsta($page_id);
		    break;
		case 'cancelled': 
			liveinsta($page_id);
		    break;
		case 'failed': 
			liveinsta($page_id);
		    break;
		case 'returned': 
			liveinsta($page_id);
		    break;
		case 'showall': 
			showallinsta();
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
<title>Insta Index</title>
</head>

<body>
<?php
function liveinsta($page_id)
{
 //pagination
 $select = mysql_query("select * from insta where stage = '$page_id'");
 $num  = mysql_num_rows($select);
 $Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
 echo '<br/><br/><br/>'; 
 echo $Pagination->display();
 echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
 //end 
  $selectquery = mysql_query("select * from insta where stage ='$page_id' LIMIT $start,$end") or die ("select * from insta where stage ='$page_id' LIMIT $start,$end".mysql_error());
  
?>
<br /><br /><br />
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px"">

                <div class="head">
                
                <h2>
                <?php
				if($page_id == 'live')
				 echo "Current Insta Deals";
				elseif($page_id == 'approved')
				 echo "Approved Insta Deals";
				elseif($page_id == 'cancelled')
				 echo "Cancelled Insta Deals";
				elseif($page_id == 'failed')
				 echo "Failed Insta Deals";				
				elseif($page_id == 'returned')
				 echo "Returned Insta Deals";				 
				
				?>
                </h2>				

				
                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="20">ID</th><th width="30">Status</th><th width="20"></th><th width="80" nowrap>City</th><th width="80">Category</th><th width="100">Start Date </th><th> End Date</th><th width="50">Sold</th><th width="80" nowrap>Market Price</th><th width="60" nowrap>99 AED Price</th><th width="110">Edit</th><th width="110">Details</th><th width="110">Delete</th></tr>

					<?php
					while($result = mysql_fetch_array($selectquery))
					{
					echo "success";
					?>
                    <tr>
                      <td style="text-align:center"><?php echo $result["id"] ?></td>
                      <td style="text-align:center">
                      <?php
					    if($page_id=='draft')
						 echo '<img src=../images/icons/_s_black.png></img>';
						elseif($page_id == 'draft')
						 echo '<img src=../images/icons/_s_blue.png></img>';
				        elseif($page_id == 'approved')
				          echo '<img src="../images/icons/_s_orange.png"></img>';
						elseif($page_id == 'cancelled')
				          echo '<img src="../images/icons/_s_red.png.png"></img>';
						?>
                      </td>
                     
                      <td></td>
                      <td style="text-align:center">
					  <?php
					   $cityid = $result["city_id"];
					   $cityname = selectcity($cityid);
					   echo $cityname;					   
					   ?>
                      <td style="text-align:center">
					  <?php
					   $categoryid = $result["category"];
					   $catname = selectcategory($categoryid);
					   echo $catname;
					  ?> 
                      <td style="text-align:center"><?php echo $result["begin_time"] ?></td>
                      <td style="text-align:center"><?php echo $result["end_time"] ?>
                      <td style="text-align:center"><?php echo "0" ?></td>
                      <td style="text-align:center"><?php echo $result["market_price"] ?></td>
                      <td style="text-align:center"><?php echo $result["deals_price"] ?>
                      <td style="text-align:center">
                      <a href="EditInsta.php?dealid=<?php echo $result["id"]?>"><img src="../images/icons/_d_edit.png" title="edit"/></a>&nbsp;</td>
                      <td style="text-align:center">
                      <a href="instadetails.php?dealid=<?php echo $result["id"]?>"
                       class="lightview"
                       data-lightview-type="ajax"
                       data-lightview-options="
                       ajax: { 
                              type: 'post',
                               
                             }
                             "><img src="../images/icons/_d_details.png" title="Details"/></a>
                     </td>
                      <td style="text-align:center">
                      <a href="indexinsta.php?actions=delete&dealid=<?php echo $result["id"]?>&page=<?php echo $page_id ?>"><img src="../images/icons/_deleteimg.png" title="Delete" /></a> 
                      </td>
                     </tr> 
                     <?php 
					 }?>
					

					<tr><td colspan="9" nowrap>

					<img valign="middle" src="../images/icons/_s_black.png" title="Deal under review" alt="Under Review" /> Deal under review (not yet approved)

					<!--<img valign="middle" src="../images/icons/_s_green.png" title="Deal has tipped" alt="Tipped Deal" /> Deal Tipped-->

					<img valign="middle" src="../images/icons/_s_red.png" title="Deal failed" alt="Failed Deal" />Failed Deal

					<img valign="middle" src="../images/icons/_s_blue.png" title="Deal is live" alt="Live Deal" />Live Deal

					<img valign="middle" src="../images/icons/_s_orange.png" title="Deal has been approved and scheduled" alt="Scheduled Deal" /> Approved Deal (yet to start)
                    </td>

					</tr>

                    </table>

				</div>

</div>
<?php
}

// function to show all deals
function showallinsta()
{
//pagination
 $select = mysql_query("select * from insta");
 $num  = mysql_num_rows($select);
 $Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
 echo '<br/><br/><br/>'; 
 echo $Pagination->display();
 echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
 //end 
 $selectinsta = mysql_query("select * from insta LIMIT $start,$end") or die ("select * from insta".mysql_error());
 
?>
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px"">
 <div class="head">
    <h2>Show All Insta Deals</h2>
    <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="20">ID</th><th width="80" nowrap>City</th><th width="80">Category</th><th width="100">Start Date </th><th> End Date</th><th width="50">Sold</th><th width="80" nowrap>Market Price</th><th width="60" nowrap>99 AED Price</th><th width="110">Edit</th><th width="110">Details</th><th width="110">Delete</th></tr>

					<?php
					while($result = mysql_fetch_array($selectinsta))
					{
					
					?>
                    <tr>
                      <td style="text-align:center"><?php echo $result["id"] ?></td>
                      
                      <td style="text-align:center">
					  <?php
					   $cityid = $result["city_id"];
					   $cityname = selectcity($cityid);
					   echo $cityname;					   
					   ?>
                       </td>
                      <td style="text-align:center">
					  <?php
					   $categoryid = $result["category"];
					   $catname = selectcategory($categoryid);
					   echo $catname;
					  ?> </td>
                      <td style="text-align:center"><?php echo $result["begin_time"] ?></td>
                      <td style="text-align:center"><?php echo $result["end_time"] ?></td>
                      <td style="text-align:center"><?php echo "0" ?></td>
                      <td style="text-align:center"><?php echo $result["market_price"] ?></td>
                      <td style="text-align:center"><?php echo $result["deals_price"] ?></td>
                      <td style="text-align:center">
                      <a href="EditInsta.php?dealid=<?php echo $result["id"]?>"><img src="../images/icons/_d_edit.png" title="edit"/></a>&nbsp;</td>
                      <td style="text-align:center">
                      <a href="instadetails.php?dealid=<?php echo $result["id"]?>"
                       class="lightview"
                       data-lightview-type="ajax"
                       data-lightview-options="
                       ajax: { 
                              type: 'post',
                               
                             }
                             "><img src="../images/icons/_d_details.png" title="Details"/></a>
                     </td>
                      <td style="text-align:center">
                      <a href="indexinsta.php?actions=delete&dealid=<?php echo $result["id"]?>&page=<?php echo $page_id ?>"><img src="../images/icons/_deleteimg.png" title="Delete" /></a> 
                      </td>
                     </tr> 
                     <?php 
					 }?>
					

					<tr><td colspan="9" nowrap>

					<img valign="middle" src="../images/icons/_s_black.png" title="Deal under review" alt="Under Review" /> Deal under review (not yet approved)

					<!--<img valign="middle" src="../images/icons/_s_green.png" title="Deal has tipped" alt="Tipped Deal" /> Deal Tipped-->

					<img valign="middle" src="../images/icons/_s_red.png" title="Deal failed" alt="Failed Deal" />Failed Deal

					<img valign="middle" src="../images/icons/_s_blue.png" title="Deal is live" alt="Live Deal" />Live Deal

					<img valign="middle" src="../images/icons/_s_orange.png" title="Deal has been approved and scheduled" alt="Scheduled Deal" /> Approved Deal (yet to start)
                    </td>

					</tr>

                    </table>

				</div>
                </div>
                </div>
                
<?php
 
}

if(isset($_GET["actions"]))
{
 $dealid   = $_GET["dealid"];
 $page     = $_GET["page"];
 $deletequery = mysql_query("Delete from insta where id='$dealid'") or die("Delete from insta where id='$dealid'".mysql_error());
 if($deletequery)
 {
    if($page=='review')
	   header("location:indexinsta.php?page=review");
    elseif($page=='approved')
       header("location:indexinsta.php?page=approved");
	elseif($page=='cancelled')
       header("location:indexinsta.php?page=cancelled");
	elseif($page=='live')
       header("location:indexinsta.php?page=live");
	elseif($page=='failed')
       header("location:indexinsta.php?page=failed");
	elseif($page=='returned')
       header("location:indexinsta.php?page=returned");
	elseif($page=='showall')
       header("location:indexinsta.php?page=showall");
}
}
?>
</body>
</html>
