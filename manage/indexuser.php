<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/function.php");
include("../includes/pagination_class_1.0/Pagination.php");
$page_id = $_GET["page"];
userpage($page_id);

// call from delete action
$actions = $_GET["actions"];
$adminid = $_GET["adminid"];
$action  = $_GET["action"];
if($actions == "delete")
{ 
 $deletequery = mysql_query("Delete from administrator where admin_id='$adminid'") or die ("Delete from administrator where admin_id='$adminid'".mysql_error());
 if($deletequery)
   header("location:indexuser.php?page=adminlist");
 }
if($actions=="banuser")
{
 $userid  = $_GET["id"];
 $updatequery = mysql_query("update user set banneduser='0' where id='$userid'") or die("update user set banneduser='0' where id='$userid'".mysql_error());
 if($updatequery)
  header("location:indexuser.php?page=userlist");
}
if($action=="delete")
{ 
 $partnerid  = $_GET["partnerid"];
 $deletequery = mysql_query("Delete from partner where id='$partnerid'") or die("Delete from partner where id='$partnerid'".mysql_error());
 if($deletequery)
  header("location:indexuser.php?page=partners");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Index</title>
</head>

<body>
<?php
function userpage($page_id)
{
?>
<br /><br /><br />
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px"">

                <div class="head">
                <?php
                if($page_id=='userlist')
				{			
                ?>
                <h2>User List</h2>
                <?php
				userlist();
				}
				elseif($page_id=='adminlist')
				{			
                ?>
                <h2>Admin List</h2>
                <?php
				adminlist();
				}
				elseif($page_id=='partners')
				{			
                ?>
                <h2>Partner</h2>
                <?php
				partners();
				}
				
				?>
				</div>
<?php

}

function userlist()
{
//pagination
 $select = mysql_query("select * from user");
 $num  = mysql_num_rows($select);
 $Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
 echo '<br/><br/>'; 
 echo $Pagination->display();
 echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
 //end of pagination
 
// select user from user table
$selectquery = mysql_query("select * from user LIMIT $start,$end") or die("select * from user LIMIT $start,$end".mysql_error());
echo '<br/><br/>'; 
?>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="30">ID</th><th width="100">Email</th><th width="150">UserName</th><th width="20">City</th><th width="80" nowrap>Balance</th><th width="80" nowrap>Postcode</th><th width="80" nowrap>RegisterIP</th><th width="80">Registertime</th><th width="80" nowrap>Tel.</th><th width="80" nowrap>Ban User</th></tr>
              <?php
			  while($result = mysql_fetch_array($selectquery))
			  {
			  ?>
              <tr>
                <td style="text-align:center"><?php echo $result["ID"] ?></td>
                <td style="text-align:center"><?php echo $result["email"] ?></td>
                <td style="text-align:center"><?php echo $result["username"] ?></td>
                <td style="text-align:center">
				<?php 
				 $cityname = selectcity($result["city_id"]);
				 echo $cityname;
				 ?>
                 </td>                
                <td style="text-align:center"><?php echo $result["money"] ?></td>
                <td style="text-align:center"><?php echo $result["zipcode"] ?></td>
                <td style="text-align:center"><?php echo $result["ip"] ?></td>
                <td style="text-align:center"><?php echo $result["create_time"] ?></td>
                <td style="text-align:center"><?php echo $result["mobilr"] ?></td>
                <td style="text-align:center"><a href="indexuser.php?actions=banuser&id=<?php echo $result["ID"] ?>">BanUser</a></td>
                <td style="text-align:center">
				<?php 
				$bannedstate = $result["banneduser"];
				if($bannedstate=='0')
				  echo "Banned User"
				?> 
                </td>
			  <?php
			  }
			  ?>
                </table>

				</div>


<?php 
}

function adminlist()
{
//pagination
 $select = mysql_query("select * from administrator");
 $num  = mysql_num_rows($select);
 $Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
 echo '<br/><br/>'; 
 echo $Pagination->display();
 echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
 //end of pagination

 $selectquery = mysql_query("select * from administrator LIMIT $start,$end") or die("select * from administrator LIMIT $start,$end".mysql_error());
 echo '<br/><br/>';
?>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="30">ID</th><th width="380">Email</th><th width="20">Name</th><th width="100">Edit</th><th width="100">Delete</th></tr>

					<?php
					while($result = mysql_fetch_array($selectquery))
					{
					?>
					<tr>
                     <td style="text-align:center"><?php echo $result["admin_id"] ?></td>
                     <td style="text-align:center"><?php echo $result["username"] ?></td>
                     <td style="text-align:center"><?php echo $result["Email"] ?></td>
                     <td style="text-align:center"><a href="Createadmin.php?action=edit&adminid=<?php echo $result["admin_id"]?>"><img src="../images/icons/_d_edit.png" title="edit"/></a></td>
                     <td style="text-align:center"><a href="indexuser.php?actions=delete&adminid=<?php echo $result["admin_id"] ?>"><img src="../images/icons/_deleteimg.png" title="Delete" /></a></td>
                    </tr>
                    <?php
					}
					?>
					

					

                    </table>

				</div>


<?php 
}

function partners()
{
 $select = mysql_query("select * from partner");
 $num  = mysql_num_rows($select);
 $Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
 echo '<br/><br/>'; 
 echo $Pagination->display();
 echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
 //end of pagination
 $selectpartner = mysql_query("select * from partner LIMIT $start,$end") or die("select * from partner LIMIT $start,$end".mysql_error());
?>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="30">ID</th><th width="380">Name</th><th width="80" nowrap>Tel.</th><th width="100">Date</th><th width="100">Delete</th></tr>
                    <?php
					while($result = mysql_fetch_array($selectpartner))
					{
					?>
                    
					<tr style="height:20px;">
                    <td style="text-align:center"><?php echo $result["id"] ?></td>
					<td style="text-align:center"><?php echo $result["username"] ?></td>
                    <td style="text-align:center"><?php echo $result["phone"] ?></td>
                    <td style="text-align:center"><?php echo $result["create_time"] ?></td>
                    <td style="text-align:center"><a href="indexuser.php?action=delete&partnerid=<?php echo $result["id"]?>"><img src="../images/icons/_deleteimg.png" title="delete"/></a></td>
                    

					<?php
					}
					?>

                    </table>

				</div>


<?php 
}

function cashpayments()
{
?>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="80">Deal Item</th><th width="380">Email/Username</th><th width="20"></th><th width="80" nowrap>Operation</th><th width="80" nowrap>Amount</th><th width="100">Operator</th><th width="100">Order Time</th></tr>

					
					<tr><td colspan="9"><ul class="paginator"><li class="current">1</li></ul></tr>

					

                    </table>

				</div>

</div>
<?php 
}
?>

</body>
</html>
