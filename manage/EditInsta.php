<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/function.php");
$deal_id = $_GET["dealid"];
$selectcountry = mysql_query("select * from country") or die ("select * from country".mysql_error());
$selectcity = mysql_query("select * from city") or die ("select * from city".mysql_error());
$selectcategory = mysql_query("select id,name from category") or die ("select id,name from category".mysql_error());
$selectdeal = mysql_query("select * from insta where id='$deal_id'") or die ("select * from insta where id='$deal_id'");
$result     = mysql_fetch_array($selectdeal);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../ckeditor/ckeditor.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Insta Deals</title>
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
		
		g_globalObject3 = new JsDatePick({
			useMode:2,
			isStripped:false,
			target:"validtill",
			dateFormat:"%d-%M-%Y"	
			});
	};
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
<form action="" method="post" name="create" id="form1" enctype="multipart/form-data">
<b style="margin-bottom: 2px; display: block;">Edit the Deal &nbsp;<?php echo $result["name"] ?></b>
<b style="margin-bottom: 2px; display: block;">Quick Update</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
        <td> Set Status </td>
           <td>
               <select name="status">
                <option value="approved">Approved</option>
                <option value="cancelled">Canceled</option>
                <option value="failed">Failed</option>
                <option value="live">Live</option>
                <option value="returned">Returned</option>              
               
                
               </select>
           </td>
           <td><input type="submit" name="btnstatus" value="Submit" />
           <?php echo $errstatus ?>
           </td>
          </tr>
           </table>
      </div>
      <b style="margin-bottom: 2px; display: block;">Basic</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Deal Name:</td>
            <td><input type="text" name="dealname" value="<?php echo $result["name"] ?>" />
            <?php echo $errdealName ?></td>
          </tr>
        
          <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Select City</td>
            <td><select name="city">
                <?php
				while($resultcity = mysql_fetch_array($selectcity))
				{ ?>
                <option value="<?php echo $resultcity["city_id"] ?>"><?php echo $resultcity["city_name"] ?></option>
               <?php } ?>
              </select><?php echo $errcity?>
            </td>
          </tr>
          
         
           <tr>
        <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Address</td>
        <td><textarea name="addressofdeal" ><?php echo $result["address"] ?></textarea><?php echo $erraddr ?></td>  
        </tr>  
        <tr>
        <td>Address1</td>
        <td><textarea name="address1"><?php echo $result["lat"] ?></textarea></td>  
        </tr>    
        <tr>
         <td> Zip Code</td>
        <td><input type="text" name="zipcode" value="<?php echo $result["zipcode"] ?>" /></td>
        </tr> 
        </table>
      </div>
      
<b style="margin-bottom: 2px; display: block;">Deal Details</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Recommended Retail:</td>
            <td><input type="text" name="dealvalue" value="<?php echo $result["market_price"]?>" /><?php echo $errvalue ?></td>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>99 AED selling Price:</td>
            <td><input type="text" name="dealprice" value="<?php echo $result["deals_price"]?>" /><?php echo $errprice ?></td>
            <td>Margin</td>
             <td><input type="text" name="margin" value="<?php echo $result["commission"]?>" /></td>    
          </tr>
        <tr>
            
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Max sale qty:</td>
            <td><input name="maximum" type="text" value="<?php echo $result["max_number"]?>" /> <?php echo $errmax ?></td>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Max qty Per Person:</td>
            <td><input name="maxperperson" type="text" value="<?php echo $result["per_number"]?>" /><?php echo $errperperson ?> </td>
          </tr>
          <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Start Date:</td>
            <td><input type="text" name="dealstartdate" id="startdate" value="<?php echo $result["begin_time"]?>" /><?php echo $errstartdate ?></td>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span> End Date:</td>
            <td><input type="text" name="dealenddate" id="enddate" value="<?php echo $result["end_time"]?>" /><?php echo $errenddate ?></td>
           
          </tr>
          
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Fine Print:</td>
           </tr>
           <tr>
            <td><textarea name="dealfineprint"><?php echo $result["notice"]?><?php echo $errfineprint ?></textarea>
            <script type="text/javascript">
                CKEDITOR.replace( 'dealfineprint',{height: 200,
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
        
            <td><select name="Partner"  id="partner" style="display:none">
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
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Category:</td>
            <td><select name="category">
            <option value="0">choose category</option>
            <?php
			 while($resultcat = mysql_fetch_array($selectcategory))
			 {
			 ?>
			  <option value="<?php echo $resultcat["id"] ?>"><?php echo $resultcat["name"]?></option>  
              <?php
			 }
			 ?>
            </select><?php echo $errcat ?></td>            
          </tr> 
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Product Picture:</td>
            <td><input type="file" name="imagename" value="Choose File" />
			<img src="<?php echo $result["image"]?>"  /><?php echo $errpic ?></td>            
          </tr>     
          
          
           </table>
      </div>

     
      <p align="center"><input name="Submit" type="submit" value="Submit" /></p>
</form>
</body>
</html>
<?php

// function to validate form elements
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
	if(trim($_POST["dealstatus"])=='')
	{
			global $errstatus;
		    $errstatus=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please select the Status</font></td>
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
	if(trim($_POST["dealvalue"])=='' || !is_numeric($_POST["dealvalue"]))
	{
			global $errvalue;
		    $errvalue=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the market price</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["dealprice"])=='' || !is_numeric($_POST["dealprice"]))
	{
			global $errprice;
		    $errprice=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the 99AED price</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["maximum"])=='' || !is_numeric($_POST["maximum"]))
	{
			global $errmax;
		    $errmax=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the  maximum quantity</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["maxperperson"])=='' || !is_numeric($_POST["maxperperson"]))
	{
			global $errperperson;
		    $errperperson=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the per person</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["dealstartdate"])=='')
	{
			global $errstartdate;
		    $errstartdate=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the start date</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["dealenddate"])=='')
	{
			global $errenddate;
		    $errenddate=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the end date</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["dealfineprint"])=='')
	{
			global $errfineprint;
		    $errfineprint=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please enter the Fine Print</font></td>
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
	if($_FILES["dealpicture"]["name"]=='')
	{
			global $errpic;
		    $errpic=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please upload a image</font></td>
          </tr>';
		  $err=1;
 	}
	
	return $err;
}


// updating the deals status
if(isset($_POST["btnstatus"]))
{
 $status  = $_POST["status"];
 $updatestatus = mysql_query("update insta set stage='$status'") or die ("update insta set stage='$status'".mysql_error());
}
// getting details from form to update the deal tables
if(isset($_POST["Submit"]))
{
 validate();
 if($err<>1)
 {
 $city           		= $_POST["city"];
 $dealname        		= $_POST["dealname"];
 $dealvalue       		= $_POST["dealvalue"];
 $dealprice       		= $_POST["dealprice"];
 $maximum         		= $_POST["maximum"];
 $maxperperson    		= $_POST["maxperperson"];
 $dealstartdate   		= $_POST["dealstartdate"];
 $dealenddate     		= $_POST["dealenddate"];
 $dealfineprint 		= $_POST["dealfineprint"];
 $addressofdeal 		= $_POST["addressofdeal"];
 $zipcode               = $_POST["zipcode"];
 $latitude              = $_POST["latitude"];
 $Partner 				= $_POST["Partner"];
 $category 				= $_POST["category"];
 $dealpicturename 		= $_FILES["imagename"]["name"];
 $dealpicturetype   	= $_FILES["imagename"]["type"];
 $dealpictureerror 		= $_FILES["imagename"]["error"];
 $dealpicturesize   	= $_FILES["imagename"]["size"];
 $dealpicturetmpname    = $_FILES["imagename"]["tmp_name"];
 $margin    			= $_POST["margin"];
 
 if($dealpicturename!='')
  $image1path = uploadimage($dealpicturename,$dealpicturetype,$dealpictureerror,$dealpicturesize,$dealpicturetmpname);
 
  // update other deal details
  $updateinsta  = mysql_query("update insta set name='$dealname',city_id='$city',partner_id='$Partner',deals_price='$dealprice',market_price='$dealvalue',product='$category',per_number='$maxperperson',max_number='$maximum',image='$image1path',address='$addressofdeal',lat='$latitude',notice='$dealfineprint',begin_time='$dealstartdate',end_time='$dealenddate',commission='$margin' where id='$deal_id'") or die ("update insta set name='$dealname',city_id='$city',partner_id='$Partner',deals_price='$dealprice',market_price='$dealvalue',product='$category',per_number='$maxperperson',max_number='$maximum',image='$image1path',address='$addressofdeal',lat='$latitude',notice='$dealfineprint',begin_time='$dealstartdate',end_time='$dealenddate',commission='$margin' where id='$deal_id'".mysql_error());
}
}
?>