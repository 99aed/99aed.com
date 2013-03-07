<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/function.php");
$selectcity     = mysql_query("select * from city") or die ("select * from city".mysql_error());
$selectcategory = mysql_query("select id,name from category") or die ("select id,name from category".mysql_error());
$selectuserid   = mysql_query("select admin_id from administrator where admin_id='1'") or die ("select admin_id from administrator where admin_id='1'".mysql_error());
$result         = mysql_fetch_array($selectuserid);
$userid         = $result["ID"];

function validate()
{
  global $err;
  $err="";
	if(trim($_POST["dealname"])=='')
	{
			global $errdealName;
		    $errdealName=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter the Deal Name</font></td>
          </tr>';
		  $err=1;
 	}
	
	if(trim($_POST["city"])=='')
	{
			global $errcity;
		    $errcity=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please select the City</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["addressofdeal"])=='')
	{
			global $erraddr;
		    $erraddr=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please select the Address</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["dealvalue"])=='')
	{
			global $errvalue;
		    $errvalue=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the market price</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["dealprice"])=='')
	{
			global $errprice;
		    $errprice=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the 99AED price</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["maximum"])=='')
	{
			global $errmax;
		    $errmax=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the  maximum quantity</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["maxeachperson"])=='')
	{
			global $errperperson;
		    $errperperson=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the per person</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["startdate"])=='')
	{
			global $errstartdate;
		    $errstartdate=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the start date</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["enddate"])=='')
	{
			global $errenddate;
		    $errenddate=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the end date</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["fineprint"])=='')
	{
			global $errfineprint;
		    $errfineprint=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the Fine Print</font></td>
          </tr>';
		  $err=1;
 	}
	if($_FILES["dealpicture"]["name"]=='')
	{
			global $errpic;
		    $errpic=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please upload a image</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["category"])=='')
	{
			global $errcat;
		    $errcat=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Select the category</font></td>
          </tr>';
		  $err=1;
 	}
	return $err;
}
if(isset($_POST["Submit"]))
{
  validate();
  if($err<>1)
  {
  
  $dealname      	 = $_POST["dealname"];
  $city          	 = $_POST["city"];
  $addressofdeal 	 = $_POST["addressofdeal"];
  $zipcode      	 = $_POST["zipcode"];
  $address1      	 = $_POST["address1"];
  $dealvalue    	 = $_POST["dealvalue"];
  $dealprice     	 = $_POST["dealprice"];
  $maximum       	 = $_POST["maximum"];
  $maxeachperson 	 = $_POST["maxeachperson"];
  $startdate     	 = $_POST["startdate"];
  $enddate       	 = $_POST["enddate"];
  $fineprint     	 = $_POST["fineprint"];
  $partner        	 = $_POST["partner"];
  $category      	 = $_POST["category"];
  $dealpicturename 	 = $_FILES["dealpicture"]["name"];
  $dealpicturetype   = $_FILES["dealpicture"]["type"];
  $dealpictureerror  = $_FILES["dealpicture"]["error"];
  $dealpicturesize   = $_FILES["dealpicture"]["size"];
  $dealpicturetmpname= $_FILES["dealpicture"]["tmp_name"];
  $margin            = $_POST["margin"];
  if($dealpicturename!='')
   $imagepath = uploadimage($dealpicturename,$dealpicturetype,$dealpictureerror,$dealpicturesize,$dealpicturetmpname);
   
  if($imagepath!="")
  {
  $insertquery = mysql_query("insert into insta (name,user_id,city_id,partner_id,deals_price,market_price,per_number,max_number,image,notice,begin_time,end_time,commission,lat,address,zipcode,stage,category) values ('$dealname','$userid ','$city','$partner','$dealprice','$dealvalue','$maxeachperson','$maximum','$imagepath','$fineprint','$startdate','$enddate','$margin','$address1','$addressofdeal','$zipcode','review','$category')") or die("insert into insta (name,user_id,city_id,partner_id,deals_price,market_price,per_number,max_number,image,notice,begin_time,end_time,commission,lat,address,zipcode,stage,category) values ('$dealname','$userid ','$city','$partner','$dealprice','$dealvalue','$maxeachperson','$maximum','$imagepath','$fineprint','$startdate','$enddate','$margin','$address1','$addressofdeal','$zipcode','review','$category')".mysql_error());
 }
  if($insertquery)
    header("location:indexinsta.php?page=review");
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Instant Deals</title>
<script src="../ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="../includes/jsdatepick-calendar/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../includes/jsdatepick-calendar/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"startdate",
			dateFormat:"%d-%M-%Y"	
			
		});
		
		g_globalObject2 = new JsDatePick({
			useMode:2,
			isStripped:false,
			target:"enddate",
			dateFormat:"%d-%M-%Y"		
			
		});
		
}
function displaypartner(partner)
		{
		  var x =  document.getElementById(partner);
		    if(x.style.display=='none')
			  {
			     x.style.display='block';
				   }else{
				     	x.style.display='none';
						  }
						  }
</script>
</head>
<body>
<br /><br />
<form action="" method="post" name="createinsta" enctype="multipart/form-data">
<b style="margin-bottom: 2px; display: block;">New Instant Deal (Insta)</b>
<br /><br />

      
<b style="margin-bottom: 2px; display: block;">Basic</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Deal Name:</td>
            <td><input name="dealname" type="text" /><?php echo $errdealName ?></td>
        </tr>
        <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Select City:</td>
            <td>
            <select name="city">
            <option value="0">All Cities</option>
            <?php
            while($result = mysql_fetch_array($selectcity))
				{ ?>
                <option value="<?php echo $result["city_id"] ?>"><?php echo $result["city_name"] ?></option>
               <?php } ?>
            
            </select><?php echo $errcity ?> </td>
         </tr> 
         <tr>
        <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Address</td>
        <td><textarea name="addressofdeal" value="" ></textarea><?php echo $erraddr ?></td>  
        </tr>  
        <tr>
        <td>Address1</td>
        <td><textarea name="address1" value="" ></textarea></td>  
        </tr>    
        <tr>
         <td>Zip Code</td>
        <td><input type="text" name="zipcode" /></td>
        </tr> 
        </table>
      </div>      
       
      
      <b style="margin-bottom: 2px; display: block;">Deal Details</b>
<div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
             <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Recommended Retail</td>
             <td><input type="text" name="dealvalue" /><?php echo $errvalue ?></td>
             <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>99 AED selling Price</td>
             <td><input type="text" name="dealprice" /><?php echo $errprice ?></td>  
             <td>Margin</td>
             <td><input type="text" name="margin" /></td>            
         </tr>
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Max sale qty:</td>
            <td><input type="text" name="maximum" value="" /><?php echo $errmax ?></td>            
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Max qty Per Person:</td>
            <td><input type="text" name="maxeachperson" value="" /><?php echo $errperperson ?></td>            
          </tr> 
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Start Date:</td>
            <td><input type="text" name="startdate" id="startdate"  /><?php echo $errstartdate ?></td> 
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> End Date:</td>
            <td><input type="text" name="enddate" id="enddate" /><?php echo $errenddate ?></td>              
          </tr>       
         
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Fine Print</td>
            <td><textarea style="height:48px;" name="fineprint"></textarea><?php echo $errfineprint ?>
            <script type="text/javascript">
                CKEDITOR.replace( 'fineprint',{height: 200,
				        width: 500 });
                </script>
            </td>
          </tr>
        </table>
  </div>
<b style="margin-bottom: 2px; display: block;">Information About This Deal</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td>Display Partner
            <input type="checkbox" onclick="displaypartner('partner')" /></td>
             <td> <select name="Partner"  id="partner" style="display:none">
              <option value="0">---Chooose Partner---</option>
              <?php
			   $selectpartner = mysql_query("select id,username from partner") or die("select id,username from partner".mysql_error());
			   while($resultpart = mysql_fetch_array($selectpartner))
			   {
			    			 
			 ?>
             
             <option value="<?php echo $resultpart["id"] ?>"><?php echo $resultpart["username"] ?></option>
             <?php
			 }
			 ?>
			 
              </select>
            </td>
        </tr> 
        <tr>
            <td><font style="color:#FF0000"><b>*</b></font>Category</td>
            <td>
            <select name="category">
              <option value="0">---Chooose Category---</option>
             <?php
			 while($resultcat = mysql_fetch_array($selectcategory))
			 {
			 ?>
			  <option value="<?php echo $resultcat["id"] ?>"><?php echo $resultcat["name"]?></option>  
              <?php
			 }
			 ?>
              
              </select><?php echo $errcat ?>
            </td>
        </tr> 
        <tr>
            <td><font style="color:#FF0000"><b>*</b></font>Product Picture</td>
            <td><input type="file" name="dealpicture" value="Choose File" /><?php echo $errpic ?></td>
        </tr>         
        </table>
      </div>

      
      <p align="center"><input name="Submit" type="submit" value="Submit" /></p>
</form>
</body>
</html>
