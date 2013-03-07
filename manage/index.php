<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/function.php");
include("../includes/pagination_class_1.0/Pagination.php");
function layout($page_id) {
    switch($page_id) {
        default: //Default, ie when the page_id does not match with predefined cases
            defaultdeal();
			break;
        case '': //When it is null
		    defaultdeal();
		    break;
	    case 'review':
		    livedeal($page_id);
            break;
        case 'live':
		    livedeal($page_id);
            break;
        case 'approved':
            livedeal($page_id);
            break;
        case 'cancelled':
            livedeal($page_id);
			break;		
		case 'draft':
            livedeal($page_id);
			break;
		case 'failed':
            livedeal($page_id);
			break;
		case 'pending':
            livedeal($page_id);
			break;
		case 'returned':
            livedeal($page_id);
			break;
		case 'tipped':
            livedeal($page_id);
			break;
		case 'show-all':
            showdeal($page_id);
			break;		
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>99AED Admin Panel</title>

<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "72061590-94d3-4587-a6b8-276169315952", doNotHash: false, doNotCopy: false, hashAddressBar: false});
</script>
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
 <?php
 $page_id = $_GET["page"];
 layout($page_id);
 
function defaultdeal()
{
?>
<form action="" method="post" name="index">
<br /><br /><br />

  <div id="content" class="clear mainwide panel"  style="background:#fff;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px">

        <div class="box" style="margin-top:5px;">

          <div class="head" style="margin-top:10px; border:none;">

            <h2 style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:42px; color:#6d6d6d">Dashboard</h2>                      

          </div>
  <div style="background-color: #F6F6F6; border: 1px solid #E6E6E6; box-shadow: 0 0 10px 0 #EEEEEE inset;font-size: 20px; margin: 30px auto 0;min-height: 40px; padding: 16px 0 4px 20px; text-align: center; width: 890px;">  <strong>Sales</strong> <span style="margin-left:8px"> Today: </span><span style="margin-left:0px; color:#779500"><strong><?php ?></strong> </span> <span style="margin-left:8px"> This Month: </span><span style="margin-left:0px; color:#C00"><strong><?php ?></strong> </span> <span style="margin-left:8px"> This Year: </span><span style="margin-left:0px; color:#000"><strong><?php ?></strong> </span> </div>


 <div style="width:900px;margin:20px auto">

            <div style="float:left;width:410px">

              <div style="background: none repeat scroll 0 0 #E6E6E6; border: 1px solid #D9D8D8; box-shadow: 0 0 10px #CFCCCC inset; font-family: 'Lucida Grande','Lucida Sans Unicode',Verdana,Arial,sans-serif; font-size: 12px;margin: 17px 30px 0 0; padding:10px 20px 20px;">
<span style="font-size:16px; color:#5c5c5c;"><img src="/themes/adnav/images/icons/16/fatcow/cart.png" align="absmiddle" border="0"> <b>Orders</b></span>
                <table style="background-color: #EDEDED;border: 1px solid #DCDADA; border-collapse: separate; border-spacing: 1px; display: table; line-height: 25px;  margin: 10px 0 0;  width:100%;">

                  <tbody style="display: table-row-group vertical-align: middle; border-color: inherit;">

                    <tr style="display: table-row; vertical-align: inherit; border-color: inherit;">

                      <td colspan="2" style="text-align:center;   padding: 0 0 0 10px;"></td>

                    </tr>

                    <tr>

                      <td width="80%" style="    border-bottom: 1px solid #DCDADA;
    padding: 0 0 0 10px;"> Today's Regular Deals Orders </td>

                      <td width="20%" style=" border-bottom: 1px solid #DCDADA;"><span style="color: #248;"><strong><?php ?></strong></span></td>

                    </tr>

                    <tr>

                      <td width="80%" style="border-bottom: 1px solid #DCDADA;padding: 0 0 0 10px;"> Today's Insta Deals Orders </td>

                      <td width="20%" style="border-bottom: 1px solid #DCDADA;"><span style="color: #248;"><strong><?php ?></strong></span></td>

                    </tr>

                    <tr>

                      <td width="80%" style="border-bottom: 1px solid #DCDADA;padding: 0 0 0 10px;color:#666;"> Yesterdays Regular Deals Orders </td>

                      <td width="20%" style="border-bottom: 1px solid #DCDADA;"><span style="color: #900;"><strong><?php ?></strong></span></td>

                    </tr>

                    <tr>

                      <td width="80%" style="border-bottom: 1px solid #DCDADA;padding: 0 0 0 10px;color:#666;"> Yesterdays Insta Deals Orders </td>

                      <td width="20%" style="border-bottom: 1px solid #DCDADA;"><span style="color: #900;"><strong><?php ?></strong></span></td>

                    </tr>

                    <tr>

                      <td width="80%" style="border-bottom: 1px solid #DCDADA;padding: 0 0 0 10px;color:#666;"> Month to Date Total [Regular] </td>

                      <td width="20%" style="border-bottom: 1px solid #DCDADA;"><span style="color: #690;"><strong><?php ?></strong></span></td>

                    </tr>

                    <tr>

                      <td width="80%" style="border-bottom: 1px solid #DCDADA;padding: 0 0 0 10px;color:#666;"> Month to Date Total [Insta] </td>

                      <td width="20%" style="border-bottom: 1px solid #DCDADA;"><span style="color: #690;"><strong><?php ?></strong></span></td>

                    </tr>

                    <tr>

                      <td width="80%" style=" border-bottom: 1px solid #DCDADA;padding: 0 0 0 10px;color:#666;"> Year to Date Total [Regular] </td>

                      <td width="20%" style="border-bottom: 1px solid #DCDADA;"><span style="color: #C60;"><strong><?php ?></strong></span></td>

                    </tr>

                    <tr>

                      <td width="80%" style="border-bottom: 1px solid #DCDADA;padding: 0 0 0 10px;color:#666;"> Year to Date Total [Insta] </td>

                      <td width="20%" style="border-bottom: 1px solid #DCDADA;"><span style="color: #C60;"><strong><?php ?></strong></span></td>

                    </tr>

                  </tbody>

                </table>

              </div>

            </div>
            <div style="    background: none repeat scroll 0 0 #FFFFFF; border: 1px solid #CCCCCC; box-shadow: 0 0 17px #CCCCCC inset; float: left; font-family: 'Lucida Grande','Lucida Sans Unicode',Verdana,Arial,sans-serif;  font-size: 12px; margin: 18px 0 0; padding: 10px; width: 468px;"> <span class="period" style="padding-left:10px;">Daily Summary:</span> <span id="showorders" style="cursor:pointer;text-decoration:underline;">Orders</span> | <span id="showdeals" style="cursor:pointer;text-decoration:none;">Deals</span> | <span id="showusers" style="cursor:pointer;text-decoration:none;">Users</span> <span class="month" style="cursor:pointer;margin-left:50px">Daily</span> | <span class="year" style="cursor:pointer"> Monthly</span>

              <div id="orderchartloading" style="position:absolute;width:430px; height:130px; text-align:center; padding-top:70px; background:#fff; opacity:0.8;z-index:99; display:none"><img src="/themes/css/default/loading.gif" alt="loading" /></div>

              <div id="chartorders" style="width:400px;height:200px;background:#fff;"></div>

              <div id="chartdeals" style="width:400px;height:200px;background:#fff;display:none"></div>

              <div id="chartusers" style="width:400px;height:200px;background:#fff;display:none"></div>

    </div>

          </div>
           
 <?php
}
  
 
?>            
</form>
<?php
// Method extracts all the live deals from database and display it
function livedeal($dealstate)
{
 //pagination
 $select = mysql_query("select * from deals where stage = '$dealstate'");
 $num  = mysql_num_rows($select);
 $Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
 echo '<br/><br/><br/>'; 
 echo $Pagination->display();
 echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
 //end 
 $selectquery = mysql_query("select * from deals where stage = '$dealstate' LIMIT $start,$end") or die ("select * from deals where stage = '$dealstate' LIMIT $start,$end".mysql_error());
 
?>
<br /><br /><br />
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px"">

                <div class="head">

				<h2>
                <?php
				if($dealstate == 'review')
				 echo "Review Deals";
				elseif($dealstate == 'live')
				 echo "Current Deals";
				elseif($dealstate == 'approved')
				 echo "Approved Deals";
				elseif($dealstate == 'cancelled')
				 echo "Cancelled Deals";
				elseif($dealstate == 'draft')
				 echo "Draft Deals";
				elseif($dealstate == 'failed')
				 echo "Failed Deals";
				elseif($dealstate == 'pending')
				 echo "Pending Deals";
				elseif($dealstate == 'returned')
				 echo "Returned Deals";
				elseif($dealstate == 'tipped')
				 echo "Tipped Deals";
				elseif($dealstate == 'show-all')
				 echo "Show All Deals";
				?>
                </h2>				

				</div>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr>
                    <th width="50">Status</th><th width="150">Name</th><th width="150" nowrap>City</th><th width="80" nowrap>Category</th><th width="100">Start Date</th><th width="100">End Date</th><th width="50">Sold</th><th width="60" nowrap>Selling Price</th><th width="70" nowrap>Market Price</th><th width="40">Edit</th><th width="50">Details</th><th width="60">Delete</th>
                    	<th width="60">fB</th>
                        <th width="60">Twitter</th>
                        <th width="60">linkedLn</th>
                        <th width="60">pinterest</th>
                    </tr>
                    <?php
					while ($result = mysql_fetch_array($selectquery))
					{
					?>
                    <tr>
                       
                       <td style="text-align:center">
                       <?php
					    if($dealstate=='review')
						 echo '<img src=../images/icons/_s_black.png></img>';
						elseif($dealstate == 'live')
						 echo '<img src=../images/icons/_s_blue.png></img>';
				        elseif($dealstate == 'approved')
				          echo '<img src="../images/icons/_s_orange.png"></img>';
						elseif($dealstate == 'failed')
				          echo '<img src="../images/icons/_s_red.png.png"></img>';
						?>
                       
                       </td>                    
                      <td style="text-align:center"><?php echo $result["name"]; ?>
                       </td>    
                                    
                       <td style="text-align:center">
					   <?php
					    $cityid = $result["city_id"];
						$cityname = selectcity($cityid);
					    echo $cityname;
					   ?>
                       </td>
                       <td style="text-align:center"><?php echo $result["product"] ?></td>
                       <td style="text-align:center"><?php echo $result["begin_time"] ?></td>
                       <td style="text-align:center"><?php echo $result["end_time"] ?></td>
                    
                       
                       <td style="text-align:center"><?php echo "0" ?></td>
                       <td style="text-align:center"><?php echo $result["deals_price"] ?></td>
                       <td style="text-align:center"><?php echo $result["market_price"]?>
                       </td>          
                       
                       <td style="text-align:center">
                        <a href="EditDeal.php?dealid=<?php echo $result["id"]?>"><img src="../images/icons/_d_edit.png" title="edit"/></a>
                      </td>&nbsp;
                      <td style="text-align:center">
                      <a href="Dealdetails.php?dealid=<?php echo $result["id"]?>"
                       class="lightview"
                       data-lightview-type="ajax"
                       data-lightview-options="
                       ajax: { 
                              type: 'post',
                               
                             }
                             "><img src="../images/icons/_d_details.png" title="Details"/></a>
                      </td> &nbsp; 
                        <td style="text-align:center"><a href="index.php?actions=delete&dealid=<?php echo $result["id"] ?>&page=<?php echo $dealstate ?>"><img src="../images/icons/_deleteimg.png" title="Delete" /></a>
                        </td> &nbsp;
                        <td style="text-align:center">
                        <span class='st_facebook_large' displayText='Facebook'></span>
                        </td>
                        <td style="text-align:center">
                        <span class='st_twitter_large' displayText='Tweet'></span>
                        </td>
                        <td style="text-align:center">
                        <span class='st_linkedin_large' displayText='LinkedIn'></span>
                        </td>
                        <td style="text-align:center">
                        <span class='st_pinterest_large' displayText='Pinterest'></span>
                        </td>
                    </tr>
					<?php
					 }
					 ?>
                     <tr><td colspan="9" nowrap>

					<img valign="middle" src="../images/icons/_s_black.png" title="Deal under review" alt="Under review Deal" /> Deal under review (not yet approved)            
                    <img valign="middle" src="../images/icons/_s_orange.png" title="Deal has been approved and scheduled" alt="Scheduled Deal" /> Approved Deal (yet to start)
					

					<img valign="middle" src="../images/icons/_s_blue.png" title="Deal is live" alt="Live Deal" />Live Deal
                    <img valign="middle" src="../images/icons/_s_red.png" title="Deal failed" alt="Failed Deal" />Failed Deal
					

					</tr>
                     <?php
					 }
					 function showdeal($dealstate)
					 {
					  //pagination
					   $select = mysql_query("select * from deals");
					   $num  = mysql_num_rows($select);
					   $Pagination = new Pagination($num, 10, array(5, 10, 25, "All"));
					   echo '<br/><br/><br/>'; 
					   echo $Pagination->display();
					   echo $Pagination->displaySelectInterface();
					   $start = $Pagination->getEntryStart();
					   $end = $Pagination->getEntryEnd();
					    //end 
					  $selectquery = mysql_query("select * from deals LIMIT $start,$end") or die ("select * from deals LIMIT $start,$end".mysql_error());
					 ?>
<br /><br /><br />
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px"">

                <div class="head">

				<h2>Show All Deals </h2>				

				</div>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr>
                    	<th width="50">Status</th><th width="150">Name</th><th width="150" nowrap>City</th><th width="80" nowrap>Category</th><th width="100">Start Date</th><th width="100">End Date</th><th width="50">Sold</th><th width="60" nowrap>Selling Price</th><th width="70" nowrap>Market Price</th><th width="40">Edit</th><th width="50">Details</th><th width="60">Delete</th>
                    	<th width="5">fB</th>
                        <th width="5">Twitter</th>
                        <th width="5">linkedLn</th>
                        <th width="5">pinterest</th>
                    </tr>
                    <?php
					while ($result = mysql_fetch_array($selectquery))
					{
					?>
                    <tr>
                       <td style="text-align:center"><?php echo $result["id"]; ?>
                       </td>
                                         
                      <td style="text-align:center"><?php echo $result["name"]; ?>
                       </td>    
                                    
                       <td style="text-align:center">
					   <?php
					    $cityid = $result["city_id"];
						$cityname = selectcity($cityid);
					    echo $cityname;
					   ?>
                       </td>
                       <td style="text-align:center"><?php echo $result["product"] ?></td>
                       <td style="text-align:center"><?php echo $result["begin_time"] ?></td>
                       <td style="text-align:center"><?php echo $result["end_time"] ?></td>
                    
                       
                       <td style="text-align:center"><?php echo "0" ?></td>
                       <td style="text-align:center"><?php echo $result["deals_price"] ?></td>
                       <td style="text-align:center"><?php echo $result["market_price"]?>
                       </td>          
                       
                       <td style="text-align:center">
                        <a href="EditDeal.php?dealid=<?php echo $result["id"]?>"><img src="../images/icons/_d_edit.png" title="edit"/></a>
                      </td>&nbsp;
                      <td style="text-align:center"><a href="Dealdetails.php?dealid=<?php echo $result["id"]?>"
                       class="lightview"
                       data-lightview-type="ajax"
                       data-lightview-options="
                       ajax: { 
                              type: 'post',
                               
                             }
                             "><img src="../images/icons/_d_details.png" title="Details"/></a>
                      </td> &nbsp; 
                        <td style="text-align:center"><a href="index.php?actions=delete&dealid=<?php echo $result["id"] ?>&page=<?php echo $dealstate ?>"><img src="../images/icons/_deleteimg.png" title="Delete" /></a>
                        </td> &nbsp;
                         <td style="text-align:center">
                        <span class='st_facebook_large' displayText='Facebook'></span>
                        </td>
                        <td style="text-align:center">
                        <span class='st_twitter_large' displayText='Tweet'></span>
                        </td>
                        <td style="text-align:center">
                        <span class='st_linkedin_large' displayText='LinkedIn'></span>
                        </td>
                        <td style="text-align:center">
                        <span class='st_pinterest_large' displayText='Pinterest'></span>
                        </td>
                    </tr>
					<?php } ?>
					  
					
                    
					<tr><td colspan="9" nowrap>

					<img valign="middle" src="../images/icons/_s_black.png" title="Deal under review" alt="Under review Deal" /> Deal under review (not yet approved)            
                    <img valign="middle" src="../images/icons/_s_orange.png" title="Deal has been approved and scheduled" alt="Scheduled Deal" /> Approved Deal (yet to start)
					

					<img valign="middle" src="../images/icons/_s_blue.png" title="Deal is live" alt="Live Deal" />Live Deal
                    <img valign="middle" src="../images/icons/_s_red.png" title="Deal failed" alt="Failed Deal" />Failed Deal
					

					</tr>

                    </table>

				</div>

</div>
<?php
}


if(isset($_GET["actions"]))
{
 $dealid   = $_GET["dealid"];
 $page     = $_GET["page"];
 $deletequery = mysql_query("Delete from deals where id='$dealid'") or die("Delete from deals where id='$dealid'".mysql_error());
 if($deletequery)
 {
    if($page=='review')
	   header("location:index.php?page=review");
	elseif($page=='live')
	   header("location:index.php?page=live");
    elseif($page=='approved')
       header("location:index.php?page=approved");
	elseif($page=='cancelled')
       header("location:index.php?page=cancelled");
	elseif($page=='draft')
       header("location:index.php?page=draft");
	elseif($page=='failed')
       header("location:index.php?page=failed");
	elseif($page=='pending')
       header("location:index.php?page=pending");
	elseif($page=='returned')
       header("location:index.php?page=returned");
	elseif($page='tipped')
       header("location:index.php?page=tipped");
	elseif($page=='show-all')
       header("location:index.php?page=show-all");
}
}
?>
</body>
</html>
