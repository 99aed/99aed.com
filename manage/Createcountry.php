<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
$page_id=$_GET["page"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Country</title>
</head>
<body>
<br /><br />
<form action="" method="post" name="create">
<?php 
if($page_id == "createcountry")
{
?>
<br /><br />
<b style="margin-bottom: 2px; display: block;">Country Details :</b>

      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td width="150"><span class="required">*</span>Country Name</td>
            <td><input name="countryname" type="text" /></td>
          </tr>
          <tr>
            <td width="150"><span class="required">*</span> Country Ename:</td>
            <td><input type="text" name="countryename" value="" /></td>
          </tr> 
          <tr>
            <td width="150"><span class="required">*</span>Country Letter:</td>
            <td><input type="text" name="countryletter" value="" /></td>
          </tr>                   
        </table>
      </div>      

      <p align="center"><input name="submitcountry" type="submit" value="Submit" /></p>
<?php
}
elseif($page_id == "createcity")
{
 
?>
<br /><br />
<b style="margin-bottom: 2px; display: block;">City Details :</b>

      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td width="150"><span class="required">*</span>Select Country</td>
            <td>
            <select name="country">
            <?php 
			 $selectquery = mysql_query("select * from country") or die(mysql_error());
			 while($result = mysql_fetch_array($selectquery))
			 {
			?><option value="<?php echo $result["country_id"] ?>"><?php echo $result["country_name"] ?></option>
            <?php } ?>
             </select>
            </td>
          </tr>
        <tr>
            <td width="150"><span class="required">*</span>City Name</td>
            <td><input name="cityname" type="text" /></td>
          </tr>
          <tr>
            <td width="150"><span class="required">*</span> City Ename:</td>
            <td><input type="text" name="cityename" value="" /></td>
          </tr> 
          <tr>
            <td width="150"><span class="required">*</span>City Letter:</td>
            <td><input type="text" name="cityletter" value="" /></td>
          </tr>                   
        </table>
      </div>  
      <p align="center"><input name="submitcity" type="submit" value="Submit" /></p>
<?php
}
?>

</form>
</body>
</html>
<?php
include("includes/db.php");
// Getting data from form to insert into database

if(isset($_POST["submitcountry"]))
{
 $countryname  = $_POST["countryname"];
 $countryename = $_POST["countryename"];
 $countryletter = $_POST["countryletter"];
 
 // inserting data into country and city table

$insertcountry = mysql_query("insert into country (country_name, country_ename, letter) values ('$countryname','$countryename','$countryletter')") or die ("insert into country (country_name, country_ename, letter) values ('$countryname','$countryename','$countryletter')".mysql_error());
if($insertcountry)
{
  header("location:Cities.php?page=country");
}
}

elseif(isset($_POST["submitcity"]))
{
 $country    = $_POST["country"];
 $cityname   = $_POST["cityname"];
 $cityename  = $_POST["cityename"];
 $cityletter = $_POST["cityletter"];
 
 $insertcity = mysql_query("insert into city (countryid, city_name,city_ename,city_letter) values ('$country','$cityname','$cityename','$cityletter')") or die ("insert into city (countryid, city_name, city_ename,city_letter) values ('$country','$cityname','$cityename','$cityletter')".mysql_error());
if($insertcity)
{
  header("location:Cities.php?page=cities");
}
}

?>