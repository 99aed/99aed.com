<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/function.php");

$selectuserid   = mysql_query("select admin_id from administrator where admin_id='1'") or die ("select admin_id from administrator where admin_id='1'".mysql_error());
$result         = mysql_fetch_array($selectuserid);
$userid         = $result["admin_id"];

	// function to validate the form elements
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
			if(trim($_POST["country"])=='')
			{
					global $errcountry;
					$errcountry=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Please select the Country</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["city"])=='')
			{
					global $errcity;
					$errcity=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Please select a city</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["addressofdeal"])=='')
			{
					global $erraddr;
					$erraddr=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the Address</font></td>
				  </tr>';
				  $err=1;
			}
			
			if(trim($_POST["dealvalue"])=='' || !is_numeric($_POST["dealvalue"]))
			{
					global $errdealvalue;
					$errdealvalue=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Please enter numbers only</font></td>
				  </tr>';
				  $err=1;
			}
			
			if(trim($_POST["dealprice"])=='' || !is_numeric($_POST["dealprice"]))
			{
					global $errdealprice;
					$errdealprice=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Please enter numbers only</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["costprice"])=='' || !is_numeric($_POST["costprice"]))
			{
					global $errcostprice;
					$errcostprice=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Please enter valid Cost Price</font></td>
				  </tr>';
				  $err=1;
			}
		
			if(trim($_POST["discount"])=='' || !is_numeric($_POST["discount"]))
			{
					global $errdiscount;
					$errdiscount=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the discount</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["minimum"])=='' || !is_numeric($_POST["minimum"]))
			{
					global $errminimum;
					$errminimum=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Please enter valid minimum quantity</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["maximum"])=='' || !is_numeric($_POST["maximum"]))
			{
					global $errmaximum;
					$errmaximum=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter valid maximum quantity</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["maxperperson"])=='' || !is_numeric($_POST["maxperperson"]))
			{
					global $errmaxperperson;
					$errmaxperperson=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the maximum per person can buy</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["dealstartdate"])=='')
			{
					global $errstrtdate;
					$errstrtdate=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the Deal start</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["dealenddate"])=='')
			{
					global $errenddate;
					$errenddate=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the Deal end date</font></td>
				  </tr>';
				  $err=1;
			}
			$validfrom = $_POST["dealstartdate"];
			$validend  = $_POST["dealenddate"];
			if($validend < $validfrom)
			{
				  global $errdates;			
				  $errdates=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Selected date is before start date</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["dealvalidtill"])=='')
			{
					global $errvalid;
					$errvalid=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the Valid till date</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["dealintroduction"])=='')
			{
					global $errintro;
					$errintro=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the Deal Introduction</font></td>
				  </tr>';
				  $err=1;
			}
			if(strlen(trim($_POST["dealintroduction"])) > 50)
			{
					global $errlenintro;
					$errlenintro=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Number of characters should be less than 50</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["dealfineprint"])=='')
			{
					global $errfineprint;
					$errfineprint=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the Fine Print</font></td>
				  </tr>';
				  $err=1;
			}
			if(strlen(trim($_POST["dealfineprint"])) > 250)
			{
					global $errlenfineprint;
					$errlenfineprint=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Number of characters should be less than 250</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["dealdetails"])=='')
			{
					global $errdetails;
					$errdetails=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the Deal details</font></td>
				  </tr>';
				  $err=1;
			}
			if(strlen(trim($_POST["dealdetails"])) > 250)
			{
					global $errlendetails;
					$errlendetails=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Number of characters should be less than 250</font></td>
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
					   <td colspan="2" class="errorText"><font color="#FF0000">Please upload atleast one picture</font></td>
				  </tr>';
				  $err=1;
			}
			
			if(trim($_POST["seokeyword"])=='')
			{
					global $errseokeyword;
					$errseokeyword=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the SEO Keyword</font></td>
				  </tr>';
				  $err=1;
			}
			if(trim($_POST["seodescription"])=='')
			{
					global $errseodescription;
					$errseodescription=' <tr>
					   <td class="normaltext">&nbsp;</td>
					   <td colspan="2" class="errorText"><font color="#FF0000">Enter the SEO Description</font></td>
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
 $country         		= $_POST["country"];
 $city           		= $_POST["city"];
 $dealname        		= $_POST["dealname"];
 $defaultloc            = $_POST["defaultloc"];
 $dealvalue       		= $_POST["dealvalue"];
 $dealprice       		= $_POST["dealprice"];
 $costprice             = $_POST["costprice"];
 $facebookcheck     	= $_POST["facebookcheck"];
 $minimum         		= $_POST["minimum"];
 $maximum         		= $_POST["maximum"];
 $maxperperson    		= $_POST["maxperperson"];
 $dealstartdate   		= $_POST["dealstartdate"];
 $dealenddate     		= $_POST["dealenddate"];
 $dealvalidtill   		= $_POST["dealvalidtill"];
 $dealintroduction 		= $_POST["dealintroduction"];
 $dealfineprint 		= $_POST["dealfineprint"];
 $addressofdeal 		= $_POST["addressofdeal"];
 $address1 				= $_POST["address1"];
 $Partner 				= $_POST["Partner"];
 $category 				= $_POST["category"];
 $dealpicturename 		= $_FILES["dealpicture"]["name"];
 $dealpicturetype   	= $_FILES["dealpicture"]["type"];
 $dealpictureerror 		= $_FILES["dealpicture"]["error"];
 $dealpicturesize   	= $_FILES["dealpicture"]["size"];
 $dealpicturetmpname    = $_FILES["dealpicture"]["tmp_name"];
 $dealimage1name		= $_FILES["dealimage1"]["name"];
 $dealimage1type		= $_FILES["dealimage1"]["type"];
 $dealimage1error		= $_FILES["dealimage1"]["error"];
 $dealimage1size		= $_FILES["dealimage1"]["size"];
 $dealimage1tmpname		= $_FILES["dealimage1"]["tmp_name"];
 $dealimage2name		= $_POST["dealimage2"]["name"];
 $dealimage2type		= $_POST["dealimage2"]["type"];
 $dealimage2error		= $_POST["dealimage2"]["error"];
 $dealimage2size		= $_POST["dealimage2"]["size"];
 $dealimage2tmpname		= $_POST["dealimage2"]["tmp_name"];
 $flv 	 		    	= $_POST["flv"];  
 $dealdetails 			= $_POST["dealdetails"]; 
 $delivery  			= $_POST["delivery"];
 $discount 		    	= $_POST["discount"];
 $seokeyword 			= $_POST["seokeyword"];
 $seodescription		= $_POST["seodescription"];
 $profit 			    = $_POST["profit"];
 $feature               = $_POST["feature"];

//vide upload
if($flv=="")
{
$allowedExts = array("mpeg", "avi", "flv", "mov");
$extension = end(explode(".", $_FILES["flvvideo"]["name"]));
if ((($_FILES["flvvideo"]["type"] == "video/mpeg")
|| ($_FILES["flvvideo"]["type"] == "video/avi")
|| ($_FILES["flvvideo"]["type"] == "video/flv")
|| ($_FILES["flvvideo"]["type"] == "video/mov"))
&& ($_FILES["flvvideo"]["size"] < 200000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["flvvideo"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["flvvideo"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["flvvideo"]["name"] . "<br>";
    echo "Type: " . $_FILES["flvvideo"]["type"] . "<br>";
    echo "Size: " . ($_FILES["flvvideo"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["filflvvideoe"]["tmp_name"] . "<br>";

    if (file_exists("../upload/" . $_FILES["flvvideo"]["name"]))
      {
      echo $_FILES["flvvideo"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["flvvideo"]["tmp_name"],
      "../upload/" . $_FILES["flvvideo"]["name"]);
      $flv = "upload/" . $_FILES["flvvideo"]["name"];
      }
    }
  }
else
  {
  echo "Please upload correct file";
  }
 }
//end upload 
 
 
if($dealpicturename!='')
  $image1path = uploadimage($dealpicturename,$dealpicturetype,$dealpictureerror,$dealpicturesize,$dealpicturetmpname);
  if($dealimage1name!='')
  $image2path = uploadimage($dealimage1name,$dealimage1type,$dealimage1error,$dealimage1size,$dealimage1tmpname);
 if($dealimage2name!='')
  $image3path = uploadimage($dealimage2name,$dealimage2type,$dealimage2error,$dealimage2size,$dealimage2tmpname);
  
 // insert query statement to insert deals
 if(($image1path!="" ) ||($image2path!="") ||($image3path!="") || ($flv!=""))
 {
 $insertquery  = mysql_query("insert into deals (user_id,featuredeal,defaultlocation,summary,city_id,partner_id,fbcheck,deals_price,market_price,costprice,product,per_number,min_number,max_number,image,image1,image2,flv,profit,discount,address,address1,detail,notice,delivery,expire_time,begin_time,end_time,stage,seokey,seodesc,name) values ('$userid','$feature','$defaultloc','$dealintroduction','$city','$Partner','$facebookcheck','$dealprice','$dealvalue','$costprice','$category','$maxperperson','$minimum','$maximum','$image1path','$image2path','$image3path','$flv','$profit','$discount','$addressofdeal','$address1','$dealdetails','$dealfineprint','$delivery','$dealvalidtill','$dealstartdate','$dealenddate','review','$seokeyword','$seodescription','$dealname')") or die("insert into deals (user_id,featuredeal,defaultlocation,summary,city_id,partner_id,fbcheck,deals_price,market_price,costprice,product,per_number,min_number,max_number,image,image1,image2,flv,profit,discount,address,address1,detail,notice,delivery,expire_time,begin_time,end_time,stage,seokey,seodesc,name) values ('$userid','$feature','$defaultloc','$dealintroduction','$city','$Partner','$facebookcheck','$dealprice','$dealvalue','$costprice','$category','$maxperperson','$minimum','$maximum','$image1path','$image2path','$image3path','$flv','$profit','$discount','$addressofdeal','$address1','$dealdetails','$dealfineprint','$delivery','$dealvalidtill','$dealstartdate','$dealenddate','review','$seokeyword','$seodescription','$dealname')".mysql_error());
 }
 if($insertquery)
   header("location:index.php?page=review");
 
} 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../ckeditor/ckeditor.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Deals</title>
<link rel="stylesheet" type="text/css" media="all" href="../includes/jsdatepick-calendar/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../includes/jsdatepick-calendar/jsDatePick.min.1.3.js"></script>
<script src="../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
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
function filladdress()
{
  var address  = document.forms["create"]["addressofdeal"].value;
  var address1 = document.forms["create"]["address1"].value;
  if(address == "" || address1 =="")
  {
  document.forms["create"]["addressofdeal"].value = "99 AED";
  document.forms["create"]["address1"].value = "AL Manara Tower";
  }
  else
  {
  document.forms["create"]["addressofdeal"].value = "";
  document.forms["create"]["address1"].value = "";
  }
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
<link href="../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />

<!-- code to link to facebook,twitter -->
<script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "72061590-94d3-4587-a6b8-276169315952", doNotHash: false, doNotCopy: false, hashAddressBar: false});
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
<form action="" method="post" name="create" id="form1" enctype="multipart/form-data" >
<div id="Accordion1" class="Accordion" tabindex="0">
  <div class="AccordionPanel">
          <div class="AccordionPanelTab">New Deal</div>
          <div class="AccordionPanelContent">
  

      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 50px;">
      <div class="block" style="margin-bottom:20px;">
        <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Deal Name:</label>
       
        <input type="text" name="dealname" value="<?php echo htmlspecialchars($_POST['dealname']) ?>" /><?php echo $errdealName ?>
       
        <input type="checkbox" name="feature" value="1" />Featured</div>   
        <div class="block" style="margin-bottom:20px;">
        <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Select Country</label>
           
             <select name="country">
                <option value="1">United Arab Emirates</option>             
             </select><?php echo $errcountry ?> 
        </div>
<div class="block" style="margin-bottom:20px;">
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Select City</label>

            <label>
            <select name="city">
              <option value="1">Abu Dhabi</option>
              <option value="2">Ajman</option>
              <option value="3" selected="selected">Dubai</option>
              <option value="4">Fujairah</option>
              <option value="5">Ras Al Khaimah</option>
              <option value="6">Sharjah</option>
              <option value="7">Umm Al Quwain</option>
            </select><?php echo $errcity ?>
            </label>
     </div>
          <div class="block" style="margin-bottom:20px;">
          <label><input name="defaultloc" type="checkbox" value="Y" onclick="filladdress()" />Default Location</label>
          </div>
          
          <div class="block" style="margin-bottom:20px;">
              <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Address</label>
            
              <label>
              <input type="text" name="addressofdeal" id="addressofdeal" /><?php echo $erraddr ?>
              </label>
            </div>   
        <div class="block" style="margin-bottom:20px;">
            <label>&nbsp; Address1</label>
            <input type="text" name="address1" id="address1" />
       </div>       
          
          <div class="block" style="margin-bottom:20px;">
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Recommended Retail:</label>
            <label><input type="text" name="dealvalue" value="<?php echo htmlspecialchars($_POST['dealvalue']) ?>"   /><?php echo $errdealvalue ?><?php echo $errdealvalue1 ?>
            </label>
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>99 AED Selling Price:</label>
            <label><input type="text" name="dealprice" value="<?php echo htmlspecialchars($_POST['dealprice']) ?>" /><?php echo $errdealprice ?></label>
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Cost Price:</label>
            <label><input type="text" name="costprice" value="<?php echo htmlspecialchars($_POST['costprice']) ?>" /><?php echo $errcostprice ?></label>
          </div>
          <div class="block" style="margin-bottom:20px;">
          <label> Margin</label>
          <input type="text" name="profit" value="<?php echo htmlspecialchars($_POST['profit']) ?>"/>
          </div>
          <div class="block" style="margin-bottom:20px;">
          <label> <span class="required"><font style="color:#FF0000"><b>*</b></font></span>Discount &nbsp;&nbsp;</label>
            <input type="text" name="discount" value="<?php echo htmlspecialchars($_POST['discount']) ?>" /><?php echo $errdiscount ?>
        </div>
           <div class="block" style="margin-bottom:20px;">        
           <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Min sale qty:</label>
            <label><input name="minimum" type="text" value="<?php echo htmlspecialchars($_POST['minimum']) ?>" /><?php echo $errminimum ?></label>
           <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Max sale qty:</label>
            <label><input name="maximum" type="text" value="<?php echo htmlspecialchars($_POST['maximum']) ?>" /><?php echo $errmaximum?> </label>
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Max qty per person:</label>
            <label><input name="maxperperson" type="text" value="<?php echo htmlspecialchars($_POST['maxperperson']) ?>"/><?php echo $errmaxperperson ?> </label>
          </div>
          <div class="bottomWall" style="margin-bottom:80px;">    
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Start Date:</label>
            <label><input type="text" name="dealstartdate" id="startdate" /><?php echo $errstrtdate ?></label>
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span> End Date:</label>
            <label><input type="text" name="dealenddate" id="enddate" /><?php echo $errenddate. '&nbsp;' . $errdates ?></label>
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Valid Till:</label>
            <label><input type="text" name="dealvalidtill" id="validtill" /><?php echo $errvalid ?></label>
          </div>
           <div class="block" style="margin-bottom:20px;">  
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Brief Introduction:</label>
           
            <textarea name="dealintroduction"><?php echo htmlspecialchars($_POST['dealintroduction']) ?></textarea>
             <script type="text/javascript">
                CKEDITOR.replace( 'dealintroduction');
                </script><?php echo $errintro ."&nbsp;".$errlenintro ?>
        </div>
          
          <div class="block" style="margin-bottom:20px;">  
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Fine Print:</label>
            
          <textarea name="dealfineprint"><?php echo htmlspecialchars($_POST['dealfineprint']) ?></textarea>
            <script type="text/javascript">
                CKEDITOR.replace( 'dealfineprint' );
                </script><?php echo $errfineprint ."&nbsp;". $errlenfineprint ?>
           <label>Please use bullet format</label>
        </div>
     
       <p></p>
      
      
      <b style="margin-bottom: 2px; display: block;">Information About This Deal</b>
      <div class="block" style="margin-bottom:20px;"> 
        <label><input type="checkbox" onclick="displaypartner('partner')" /><b>Display Partner</b></label></td>
            
            <select name="Partner" id="partner" style="display:none">
             <?php
			 $selectpartner = mysql_query("select id,username from partner") or die ("select id,username from partner".mysql_error());
			 while($resultpart = mysql_fetch_array($selectpartner))
			 {
			  			 
			 ?>
             
             <option value="<?php echo $resultpart["id"] ?>"><?php echo $resultpart["username"] ?></option>
             <?php
			 }
			 ?>
        </select>
        </div>
          <div class="block" style="margin-bottom:20px;"> 
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Category:</label>            
            <select name="category">
            <option value="0">--choose category--</option>
            <?php
             $selectcategory = mysql_query("select id,name from category") or die ("select id,name from category".mysql_error());
			 while($resultcat = mysql_fetch_array($selectcategory))
			 {		
			 
			?>
            
            <option value="<?php echo $resultcat["id"] ?>"><?php echo $resultcat["name"]?></option>            
            
            <?php
			}
			?>
          </select><?php echo $errcat ?>
        </div>          
           <div class="block" style="margin-bottom:20px;">
         
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Product Picture:</label>
            <input type="file" name="dealpicture" value="Choose File" />  <?php echo $errpic ?>       
          </div>
          <div class="block" style="margin-bottom:20px;"> 
            <label>Image 1:</label>
            <input type="file" name="dealimage1" value="Choose File" />           
          </div>
          <div class="block" style="margin-bottom:20px;"> 
            <label>Image 2:</label>
            <input type="file" name="dealimage2" value="Choose File" />          
          </div>
          <div class="block" style="margin-bottom:30px;"> 
            <label>Embed FLV Video</label>
            <textarea style="height:48px;" name="flv" id="deal-create-flv" class="f-input" /></textarea>
        </div>
        <div>    <span class="hint">Please add your iframe here and set the width="253" and height="174".</span></div>
           <div class="block" style="margin-bottom:20px;">
           
            <label>Upload FLV Video:&nbsp;</label>
              <input type="file" name="flvvideo" value="Choose File" />	
        </div>
          
      
       <div class="block" style="margin-bottom:20px;">       </div>
        <div class="block" style="margin-bottom:20px;">
        <label><font color="#FF0000">Description</font></label>
           <textarea name="dealdetails" cols="" rows=""><?php echo htmlspecialchars($_POST['dealdetails']) ?></textarea>
          <script type="text/javascript">
                CKEDITOR.replace( 'dealdetails' );
                </script>
                <label>Please use bullet format</label><?php echo $errdetails."&nbsp;". $errlendetails ?>
        </div>
       </div>
       </div>
  </div>
   
<div class="AccordionPanel">
<div class="AccordionPanelTab">Delivery Information</div>  
<div class="AccordionPanelContent">    
<div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 30px;">
     
        <div class="block" style="margin-bottom:20px;">
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Delivery</label>
              
                <label>
                  <input type="radio" name="delivery" value="Voucher" id="delivery_0" />
                  Voucher</label>
                
                <label>
                  <input type="radio" name="delivery" value="Express Delivery" id="delivery_1" />
                  Express Delivery</label>
                
                <label>
                  <input type="radio" name="delivery" value="Self withdraw" id="delivery_2" />
                  Manually Collect from 99aed Office</label>   
        </div> 
      </div>
    </div>       
  </div>
  <div class="AccordionPanel">
<div class="AccordionPanelTab">SEO Optimization</div>  
<div class="AccordionPanelContent"> 
     
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <div class="block" style="margin-bottom:20px;">
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>SEO Keywords</label>
        
            <label>
            <input name="seokeyword" type="text" value="<?php echo htmlspecialchars($_POST['seokeyword']) ?>" /> <?php echo $errseokeyword ?> 
            </label>
          </div>  
         <div class="block" style="margin-bottom:20px;">
            <label><span class="required"><font style="color:#FF0000"><b>*</b></font></span>SEO Description</label>
            
            <label>
            <textarea style="height:48px;" name="seodescription" id="seodescription" value="<?php echo htmlspecialchars($_POST['seodescription']) ?>"></textarea><?php echo $errseodescription ?> 
            </label>
           </div>       
        
      </div>
      </div>
  </div>

      <p align="center"><input name="Submit" type="submit" value="Submit" /></p>
</form>
<script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
//-->
</script>
</body>
</html>
