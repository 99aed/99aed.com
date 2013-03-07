<?php
error_reporting(E_ERROR | E_PARSE);
include("includes/db.php");
$encryptedEmail = base64_decode(str_replace(md5("mynewemail"), "", $_GET["activation"]));

//query to select email from user table
global $count;
$selectEmail  = mysql_query("select email from user") or die("select email from user".mysql_error());
while($result = mysql_fetch_array($selectEmail))
{
  $email = $result["email"];
  if($email == 	$encryptedEmail)
  {
   // update user table field 'enable' to yes
   $updatequery = mysql_query("update user set enable='Y' where email = '$email'");
   echo "Your account is activated successfully, you will be redirected to home page in 5 seconds<br/> Please Login to continue shopping"; 
   header('refresh:5; url=index.php');
  }
  else
  {
   $count++;
  } 
}
if($count==mysql_num_rows($selectEmail))
{
   echo "You are not a registered user, please register to continue with shopping";
   header('refresh:5;url=index.php');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Activation Page</title>
</head>

<body>
</body>
</html>
