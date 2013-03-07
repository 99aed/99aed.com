<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/pagination_class_1.0/Pagination.php");

//pagination
 $select = mysql_query("select * from category");
 $num  = mysql_num_rows($select);
 $Pagination = new Pagination($num, 10, array(5, 10, 25, "All"), "comments", "pageOff", "pageOn", "pageSelect", "pageErrors");
 echo '<br/><br/><br/>'; 
 echo $Pagination->display();
 echo $Pagination->displaySelectInterface();
 $start = $Pagination->getEntryStart();
 $end = $Pagination->getEntryEnd();
 //end 
$selectquery = mysql_query("select * from category LIMIT $start,$end") or die ("select * from category LIMIT $start,$end".mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Category Page</title>
</head>

<body>
<form action="#" name="category" method="post">
<br /><br /><br />
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px">

                <div class="head">
               
                <h2>Categories <span style="float:right"> </span></h2>
                
  </div>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" style="font-size:12px; width:880px">

					<tr><th>ID</th><th>Full Name</th><th>Short Name</th><th>Descriptor</th><th width="30">Edit</th><th width="30">Delete</th></tr>
                    <?php
					while($result = mysql_fetch_array($selectquery))
					{
					
					?>
					<tr>
                       <td style="text-align:center"><?php echo $result["id"]?></td>
                       <td style="text-align:center"><?php echo $result["name"] ?></td>
                       <td style="text-align:center"><?php echo $result["ename"] ?></td>
                       <td style="text-align:center"><?php echo $result["description"] ?></td>
                       <td style="text-align:center">
                       <a href="createcat.php?action=edit&catid=<?php echo $result["id"] ?>"
                       class="lightview"
                       data-lightview-type="ajax"
                       data-lightview-options="
                       ajax: { 
                              type: 'post',
                               
                             }
                             ">Edit</a>
                       
                       </td><td><a href="Category.php?actions=delete&catid=<?php echo $result["id"] ?>">Delete</a></td>
                    </tr>
					<?php
					}
					?>				

                    </table>

				</div>

</div>
</form>
</body>
</html>
<?php
if(isset($_GET["actions"]))
{
 
 $catid = $_GET["catid"];
 deletecategory($catid);
}

function deletecategory($catid)
{
 echo "deleting".$catid ; 
 $deletequery = mysql_query("Delete from category where id='$catid'") or die("Delete from category where id='$catid'".mysql_error());
 if($deletequery)
    header('Location: '.$_SERVER['PHP_SELF']); 
}

?>