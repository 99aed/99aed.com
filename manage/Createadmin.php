<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
$adminid = $_GET["adminid"];
$action  = $_GET["action"];
if($action=="edit")
{
  $selectquery = mysql_query("select * from administrator where admin_id='$adminid'") or die("select * from administrator where admin_id='$adminid'");
  $result = mysql_fetch_array($selectquery);
}

if(isset($_POST["Submit"]))
{

 $username  = $_POST["username"];
 $password  = base64_encode($_POST["password"]);
 $useremail = $_POST["useremail"];

 if($action=="")
 {
  $insert = mysql_query("insert into administrator (username, Email, password) values ('$username','$useremail','$password')");
  if($insert)
    echo '<br /><br /><div> Successfully added Admin User </div>';
 }
 elseif($action=="edit")
 {
  $updatequery = mysql_query("update administrator set username='$username',Email='$useremail',password='$password' where admin_id='$adminid'") or die ("update administrator set username='$username',Email='$useremail',password='$password' where admin_id='$adminid'".mysql_error());
  if($updatequery)
   echo '<br /><br /><div> Successfully updated Admin User </div>';
 }
 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Admin User</title>

<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script type="application/javascript">
function validateForm()
{
 var x= document.forms["createadmin"]["useremail"].value;
 var pattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
 if(x==null || x=="" || pattern.test(x)==false ) 
 {
   alert("Please enter valid email address");
   return false;
 }
}
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
<br /><br />
<form action="" method="post" name="createadmin">

<br /><br />
<b style="margin-bottom: 2px; display: block;">Create Administrator</b>

      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
      <div class="block" style="margin-bottom:20px;">
        <label> <font style="color:#FF0000"><b>*</b></font>User Name</label>
        <span id="sprytextfield1">
        <input class="input" type="text" name="username" value="<?php echo $result["username"]?>"/>
        <span class="textfieldRequiredMsg">Please Enter Username!</span></span></div>
     <div class="block" style="margin-bottom:20px;">
       <label> <font style="color:#FF0000"><b>*</b></font>Password</label>
       <span id="sprytextfield2">
       <input class="input" type="password" name="password" value="<?php echo base64_decode($result["password"])?>"/>
       <span class="textfieldRequiredMsg">Please Enter a password</span></span></div>
      
      <div class="block" style="margin-bottom:20px;">
       <label> <font style="color:#FF0000"><b>*</b></font>Email</label>
       <span id="sprytextfield3">
       <input class="input" type="text" name="useremail" value="<?php echo $result["Email"] ?>"/>
       <span class="textfieldRequiredMsg">Please fill in the Email Address</span></span></div>
          
      </div>
  <p align="center"> <input type="submit" name="Submit" value="Submit" onclick="return validateForm()" /></p>

</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
//-->
</script>
</body>
</html>
