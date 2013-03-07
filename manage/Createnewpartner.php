<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("includes/db.php");

// query to retreive the city information
$selectcity = mysql_query("select * from city") or die("select * from city".mysql_error());

// Getting value from form to insert into partner table
if(isset($_POST["Submit"]))
{
 $username		 = $_POST["username"];
 $password		 = $_POST["password"];
 $name     		 = $_POST["name"];
 $website 		 = $_POST["website"];
 $contactperson  = $_POST["contactperson"];
 $phone 		 = $_POST["phone"];
 $companyaddr	 = $_POST["companyaddr"];
 $city 			 = $_POST["city"];
 $companyph      = $_POST["companyph"];
 $googleaddr     = $_POST["googleaddr"];
 $otherinfo      = $_POST["otherinfo"];
 $bankname       = $_POST["bankname"];
 $nameonaccount  = $_POST["nameonaccount"];
 $accountnum     = $_POST["accountnum"];
 $commission     = $_POST["commission"];
 $createtime     = time();
 
 $insertpartner  = mysql_query("insert into partner (username,password,title,homepage,city_id,bank_name,bank_no,bank_user,location,contact,phone,address,other,mobile,user_id,commission,create_time) values ('$username','$password','$name','$website','$city','$bankname','$accountnum','$nameonaccount','$googleaddr','$contactperson','$phone','$companyaddr','$otherinfo','$companyph','1','$commission','$createtime')") or die ("insert into partner (username,password,title,homepage,city_id,bank_name,bank_no,bank_user,location,contact,phone,address,other,mobile,user_id,commission,create_time) values ('$username','$password','$name','$website','$city','$bankname','$accountnum','$nameonaccount','$googleaddr','$contactperson','$phone','$companyaddr','$otherinfo','$companyph','1','$commission','$createtime')".mysql_error());
 
 if($insertpartner)
 {
   header("location:indexuser.php?page=userlist");
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create New partner</title>
</head>
<body>
<br /><br />
<form action="" method="post" name="create">
<b style="margin-bottom: 2px; display: block;">Create New partner</b>
<b style="margin-bottom: 2px; display: block;">Login Info</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        
        <tr>
            <td width="150"><span class="required">*</span>Username</td>
            <td><input name="username" type="text" /></td>
          </tr>
          <tr>
            <td width="150"><span class="required">*</span> Password:</td>
            <td><input type="text" name="password" value="" /></td>
          </tr>                   
        </table>
      </div>
      
      <b style="margin-bottom: 2px; display: block;">Basic Info</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td width="150"><span class="required">*</span>Name</td>
            <td><input name="name" type="text" /></td>
          </tr>
          <tr>
            <td width="150"><span class="required">*</span> Website:</td>
            <td><input type="text" name="website" value="" /></td>
          </tr> 
          <tr>
            <td width="150"><span class="required">*</span> Contact Person:</td>
            <td><input type="text" name="contactperson" value="" /></td>
          </tr> 
          <tr>
            <td width="150"><span class="required">*</span> Phone:</td>
            <td><input type="text" name="phone" value="" /></td>
          </tr> 
          <tr>
            <td width="150"><span class="required">*</span> Company Address:</td>
            <td><input type="text" name="companyaddr" value="" /></td>
          </tr> 
          <tr>
            <td width="150"><span class="required">*</span> City:</td>
            <td><select name="city">
            <?php
			    while($result = mysql_fetch_array($selectcity))
				{ 
		    ?>
                <option value="<?php echo $result["city_id"] ?>"><?php echo $result["city_name"] ?></option>
               <?php
			    } ?>
            
            </select></td>
          </tr> 
          <tr>
            <td width="150"><span class="required">*</span> Company Phone:</td>
            <td><input type="text" name="companyph" value="" /></td>
          </tr> 
          <tr>
            <td width="150"><span class="required">*</span> Google Address:</td>
            <td><input type="text" name="googleaddr" value="" /></td>
          </tr> 
          <tr>
            <td width="150"><span class="required">*</span> Other Info:</td>
            <td><textarea name="otherinfo" cols="" rows=""></textarea></td>
          </tr>                   
        </table>
      </div>
      
      <b style="margin-bottom: 2px; display: block;">Bank Account Info</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td width="150"><span class="required">*</span>Bank Name</td>
            <td><input name="bankname" type="text" /></td>
          </tr>
          <tr>
            <td width="150"><span class="required">*</span> Name on Account:</td>
            <td><input type="text" name="nameonaccount" value="" /></td>
          </tr> 
          <tr>
            <td width="150"><span class="required">*</span> Account No:</td>
            <td><input type="text" name="accountnum" value="" /></td>
          </tr>                   
        </table>
      </div>
      
       <b style="margin-bottom: 2px; display: block;">Commission Info</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td width="150"><span class="required">*</span>Commission</td>
            <td><input name="commission" type="text" /></td>
          </tr>
          </table>
          </div>

      <p align="center"><input name="Submit" type="submit" value="Submit" /></p>
</form>
</body>
</html>
