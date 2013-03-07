<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
$deal_id=$_GET["dealid"];

// select deal name from deals table
$selectquery = mysql_query("select name from deals where id='$deal_id'") or die("select name from deals where id='$deal_id'".mysql_error());
$result = mysql_fetch_array($selectquery);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deal Option</title>
</head>
<body>
<br /><br />

<form action="" method="post" name="option">

<br /><br />
<b style="margin-bottom: 2px; display: block;">Deal Name :<?php echo $result["name"]?></b>
<!--<input type="text" name="dealid" value="<?php echo $deal_id ?>" />-->
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr><td><b> Deal Options</b></td></tr>
        <tr>
            <td width="150">Option Title 1</td>
            <td><input name="title1" type="text" /></td>
            <td width="150">Price</td>
            <td><input name="price1" type="text" /></td>
          </tr>
          <tr>
            <td width="150">Option Title 2</td>
            <td><input name="title2" type="text" /></td>
            <td width="150">Price</td>
            <td><input name="price2" type="text" /></td>
          </tr>
         <tr>
            <td width="150">Option Title 3</td>
            <td><input name="title3" type="text" /></td>
            <td width="150">Price</td>
            <td><input name="price3" type="text" /></td>
          </tr>
          <tr>
            <td width="150">Option Title 4</td>
            <td><input name="title4" type="text" /></td>
            <td width="150">Price</td>
            <td><input name="price4" type="text" /></td>
          </tr> 
          <tr>
            <td width="150">Option Title 5</td>
            <td><input name="title5" type="text" /></td>
            <td width="150">Price</td>
            <td><input name="price5" type="text" /></td>
          </tr>                  
        </table>
      </div>  
            <p align="left"><input name="submit" type="submit" value="Submit" /> &nbsp; <input name="clear" type="reset"  value="Clear" />
 &nbsp; <a href="index.php?page=live"><input name="back" type="button" value="Back" />  </a>    

</form>
</body>
</html>
<br /><br />
<?php

if(isset($_POST["submit"]))
{
 // Getting details from form
 $title1   = $_POST["title1"];
 $title2   = $_POST["title2"];
 $title3   = $_POST["title3"];
 $title4   = $_POST["title4"];
 $title5   = $_POST["title5"];
 $price1   = $_POST["price1"];
 $price2   = $_POST["price2"];
 $price3   = $_POST["price3"];
 $price4   = $_POST["price4"];
 $price5   = $_POST["price5"];

// query to insert into options database
$insertquery = mysql_query("insert into options (deals_id,title,options_price) values ($deal_id,'$title1','$price1'),($deal_id,'$title2','$price2'),($deal_id,'$title3','$price3'),($deal_id,'$title4','$price4'),($deal_id,'$title5','$price5')") or die ("insert into options (deals_id,title) values ($deal_id,'$title1','$price1'),($deal_id,'$title2','$price2'),($deal_id,'$title3','$price3'),($deal_id,'$title4','$price4'),($deal_id,'$title5','$price5')".mysql_error());
echo "success";
}
?>