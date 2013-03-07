<?php
error_reporting(E_ERROR | E_PARSE);

include("../includes/db.php");
include("../includes/function.php");
$action =$_GET["action"];
$cat_id =$_GET["catid"];

// selecting category from category table if option is edit
$selectcat = mysql_query("select * from category where id='$cat_id'") or die ("select * from category where id='$cat_id'".mysql_error());
$result    = mysql_fetch_array($selectcat);

// Getting details from form
$name  = $_POST["catname"];
$ename = $_POST["shortname"];
$desc  = $_POST["descriptor"];
$catid = $_POST["categoryid"];

if(isset($_POST["submit"]))
{
  // inserting category details into category table
  $insertquery = mysql_query("insert into category (name,ename,description) values ('$name','$ename','$desc')") or die ("insert into category (name,ename,desc) values ('$name','$ename','$desc')".mysql_error());
  if($insertquery)
   header("location:Category.php");
}
elseif(isset($_POST["edit"]))
{

  $updatequery = mysql_query("update category set name='$name',ename='$ename',description='$desc' where id='$catid'") or die("update category set name='$name',ename='$ename',description = '$desc' where id='$catid'");
  if($updatequery)
   header("location:Category.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Category</title>
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
<br /><br />
<form action="createcat.php" method="post" name="create">
<?php 

if($action == "create")
{
?>
<br /><br />
<div class="block" style="margin-bottom:20px;">
<label><font size="+2"> New Category</font></label>
</div>
        <div class="block" style="margin-bottom:20px;">
        <label>Name:</label>
           <input name="catname" type="text" value="<?php echo $result["name"] ?>"  />
           </div>
           <div class="block" style="margin-bottom:20px;">
         <label>Short:</label>
            <input type="text" name="shortname" value="<?php echo $result["ename"] ?>" />
            </div>
            <div class="block" style="margin-bottom:20px;">
          <label>Descriptor:</label>
            <input type="text" name="descriptor" value="<?php echo $result["description"] ?>" />
      </div> 
      </div>     

      <p align="center"><input name="submit" type="submit" value="Submit" /></p>
<?php
}
elseif($action == "edit")
{
 
?>
<br /><br />
<div class="block" style="margin-bottom:20px;">
<label><font size="+2">Edit Category</font></label>
</div>
   <div class="block" style="margin-bottom:20px;">
      <label>Name:</label>
        <input name="catname" type="text" value="<?php echo $result["name"] ?>" />
        <input name="categoryid" type="hidden" value="<?php echo $result["id"]?>" />
        </div>
         <div class="block" style="margin-bottom:20px;">
            <label>Short:</label>
            <input type="text" name="shortname" value="<?php echo $result["ename"] ?>" />
         </div>
         <div class="block" style="margin-bottom:20px;">
           <label>Descriptor:</label>
           <input type="text" name="descriptor" value="<?php echo $result["description"] ?>" />
          </div>
     
      <p align="center"><input name="edit" type="submit" value="Submit" /></p>
<?php
}
?>

</form>
</body>
</html>
