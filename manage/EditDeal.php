<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/function.php");
$deal_id = $_GET["dealid"];
$selectcountry = mysql_query("select * from country") or die ("select * from country".mysql_error());
$selectcity = mysql_query("select * from city") or die ("select * from city".mysql_error());

$selectdeal = mysql_query("select * from deals where id='$deal_id'") or die ("select * from deals where id='$deal_id'");
$result     = mysql_fetch_array($selectdeal);

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
	if(trim($_POST["dealfineprint"])=='')
	{
			global $errfineprint;
		    $errfineprint=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter the Fine Print</font></td>
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

// updating the deals status
if(isset($_POST["btnstatus"]))
{
 $status  = $_POST["status"];
 $updatestatus = mysql_query("update deals set stage='$status'") or die ("update deals set stage='$status'".mysql_error());
}
// getting details from form to update the deal tables
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
 $dealpicturename 		= $_FILES["imagename"]["name"];
 $dealpicturetype   	= $_FILES["imagename"]["type"];
 $dealpictureerror 		= $_FILES["imagename"]["error"];
 $dealpicturesize   	= $_FILES["imagename"]["size"];
 $dealpicturetmpname    = $_FILES["imagename"]["tmp_name"];
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
 $dealreview 			= $_POST["dealreview"];
 $abbreviation 			= $_POST["abbreviation"];
 $delivery  			= $_POST["delivery"];
 $discount 		    	= $_POST["discount"];
 $seokeyword 			= $_POST["seokeyword"];
 $seodescription		= $_POST["seodescription"];
 $profit    			= $_POST["profit"];
 $feature               = $_POST["feature"];
 
 //video upload
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
      $flv = "../upload/" . $_FILES["flvvideo"]["name"];
      }
    }
  }
else
  {
  echo "Invalid Video file";
  }
 }
//end upload 
 
 
 if($dealpicturename!='')
  $image1path = uploadimage($dealpicturename,$dealpicturetype,$dealpictureerror,$dealpicturesize,$dealpicturetmpname);
 if($dealimage1name!='')
  $image2path = uploadimage($dealimage1name,$dealimage1type,$dealimage1error,$dealimage1size,$dealimage1tmpname);
 if($dealimage2name!='')
  $image3path = uploadimage($dealimage2name,$dealimage2type,$dealimage2error,$dealimage2size,$dealimage2tmpname);
  
  // update other deal details
  
   /*die("update deals set featuredeal='$feature',defaultlocation='$defaultloc',summary='$dealintroduction',city_id='$city',partner_id='$Partner',fbcheck='$facebookcheck',deals_price='$dealprice',market_price='$dealvalue',costprice='$costprice',product='$category',per_number='$maxperperson',min_number='$minimum',max_number='$maximum',image='$image1path',image1='$image2path',image2='$image3path',flv='$flv',profit='$profit',discount='$discount',address='$addressofdeal',address1='$address1',detail='$dealdetails',notice='$dealfineprint',delivery='$delivery',expire_time='$dealvalidtill',begin_time='$dealstartdate',end_time='$dealenddate',seokey='$seokeyword',seodesc='$seodescription',name='$dealname' where id='$deal_id'");*/
  $updatedeal  = mysql_query("update deals set featuredeal='$feature',defaultlocation='$defaultloc',summary='$dealintroduction',city_id='$city',partner_id='$Partner',fbcheck='$facebookcheck',deals_price='$dealprice',market_price='$dealvalue',costprice='$costprice',product='$category',per_number='$maxperperson',min_number='$minimum',max_number='$maximum',image='$image1path',image1='$image2path',image2='$image3path',flv='$flv',profit='$profit',discount='$discount',address='$addressofdeal',address1='$address1',detail='$dealdetails',notice='$dealfineprint',delivery='$delivery',expire_time='$dealvalidtill',begin_time='$dealstartdate',end_time='$dealenddate',seokey='$seokeyword',seodesc='$seodescription',name='$dealname' where id='$deal_id'") or die ("update deals set featuredeal='$feature',defaultlocation='$defaultloc',summary='$dealintroduction',city_id='$city',partner_id='$Partner',fbcheck='$facebookcheck',deals_price='$dealprice',market_price='$dealvalue',costprice='$costprice',product='$category',per_number='$maxperperson',min_number='$minimum',max_number='$maximum',image='$image1path',image1='$image2path',image2='$image3path',flv='$flv',profit='$profit',discount='$discount',address='$addressofdeal',address1='$address1',detail='$dealdetails',notice='$dealfineprint',delivery='$delivery',expire_time='$dealvalidtill',begin_time='$dealstartdate',end_time='$dealenddate',seokey='$seokeyword',seodesc='$seodescription',name='$dealname' where id='$deal_id'".mysql_error());
 
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../ckeditor/ckeditor.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Deals</title>
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
function filladdress()
{
  document.forms["create"]["addressofdeal"].value = "99 AED";
  document.forms["create"]["address1"].value = "AL Minara Tower";
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
<script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "72061590-94d3-4587-a6b8-276169315952", doNotHash: false, doNotCopy: false, hashAddressBar: false});
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
               <option value="approved" selected="selected">Approved</option>
               <option value="cancelled">Cancelled</option>
               <option value="failed">Failed</option>
               <option value="live">Live</option>
               
               <!-- <option value="draft">Draft</option>-->
               <!-- <option value="pending">Pending</option>-->
                <option value="returned">Returned</option>
                
                
                
               </select>
           </td>
           <td><input type="submit" name="btnstatus" value="Submit" />
          </tr>
           </table>
      </div>
      <b style="margin-bottom: 2px; display: block;">Basic</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Deal Name:</td>
            <td><input type="text" name="dealname" value="<?php echo $result["name"] ?>" />
            <?php echo $errdealName ?>
            </td>
            <td><input type="checkbox" name="feature" value="1" />Featured </td>
          </tr>
        <tr>
           <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Select Country</td>
           <td>
              <select name="country">
                <option value="1">United Arab Emirates</option>             
             </select><?php echo $errcountry ?>
           </td>
        </tr>  
          <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Select City</td>
            <td><select name="city">
                  <option value="1">Abu Dhabi</option>
                  <option value="2">Ajman</option>
                  <option value="3" selected="selected">Dubai</option>
                  <option value="4">Fujairah</option>
                  <option value="5">Ras Al Khaimah</option>
                  <option value="6">Sharjah</option>
                  <option value="7">Umm Al Quwain</option>                  
              </select><?php echo $errcity ?>
            </td>
          </tr>
          <tr><td><input name="defaultloc" type="checkbox" value="Y" onclick="filladdress()" />
             Default Location</td>
        </tr>
          <tr>
        <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Address</td>
        <td><input type="text" name="addressofdeal" id="addressofdeal" value="<?php echo $result["address"]?>" />
        <?php echo $erraddr ?></td>
        
        </tr>    
        <tr>
        <td> Address1</td>
        <td><input type="text" name="address1" id="address1" value="<?php echo $result["address1"]?>" /></td>
        </tr>  
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Recommended Retail:</td>
            <td><input type="text" name="dealvalue" value="<?php echo $result["market_price"]?>" />
            <?php echo $errdealvalue ?></td>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>99 AED Selling Price:</td>
            <td><input type="text" name="dealprice" value="<?php echo $result["deals_price"]?>" />
            <?php echo $errdealprice ?></td>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Cost Price:</td>
            <td><input type="text" name="costprice" value="<?php echo $result["costprice"]?>" /><?php echo $errcostprice ?></td>
          </tr>
          <tr>
          <td> Margin(Profit %)</td>
          <td><input type="text" name="profit" value="<?php echo $result["profit"]?>" />
          <td> <span class="required"><font style="color:#FF0000"><b>*</b></font></span>Discount &nbsp;&nbsp;</td>
            <td>  <input type="text" name="discount" value="<?php echo $result["discount"] ?>"/><?php echo $errdiscount ?></td>
            
            </tr> 
        </table>
     

      
        <table>
        <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Min sale qty:</td>
            <td><input name="minimum" type="text" value="<?php echo $result["min_number"]?>" /> 
            <?php echo $errminimum ?></td>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Max sale qty:</td>
            <td><input name="maximum" type="text" value="<?php echo $result["max_number"]?>" /> 
            <?php echo $errmaximum ?></td>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Max qty per Person:</td>
            <td><input name="maxperperson" type="text" value="<?php echo $result["per_number"]?>" />
            <?php echo $errmaxperperson ?> </td>
          </tr>
          <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Start Date:</td>
            <td><input type="text" name="dealstartdate" id="startdate" value="<?php echo $result["begin_time"]?>" />
            <?php echo $errstrtdate ?>
            </td>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span> End Date:</td>
            <td><input type="text" name="dealenddate" id="enddate" value="<?php echo $result["end_time"]?>" />
            <?php echo $errenddate ?>
            </td>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Valid Till:</td>
            <td><input type="text" name="dealvalidtill" id="validtill" value="<?php echo $result["expire_time"]?>" />
            <?php echo $errvalid ?>
            </td>
          </tr>
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Brief Introduction:</td>
           </tr>
           <tr>
            <td><textarea name="dealintroduction"><?php echo $result["summary"]?></textarea><?php echo $errintro ?>
                <script type="text/javascript">
                CKEDITOR.replace( 'dealintroduction' ,{
        
        height: 300,
        width: 500
    });
                </script>
                
            </td>
          </tr>
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Fine Print:</td>
           </tr>
           <tr>
            <td><textarea name="dealfineprint"><?php echo $result["notice"]?></textarea><?php echo $errfineprint ?>
            <script type="text/javascript">
                CKEDITOR.replace( 'dealfineprint' );
                </script>
            </td>            
          </tr>          
        </table>
      
      <p></p>
      <b style="margin-bottom: 2px; display: block;">Information About This Deal</b>
      <p></p>
        <table>
        <tr>
        <td><label><input type="checkbox" onclick="displaypartner('partner')" /><b>Display Partner</b></label></td>
            <td>
           
			
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
            
            
              </td>            
             </tr>
             
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Category:</td>
            <td><select name="category">
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
</select>
            <?php echo $errcat ?>
            </td>            
          </tr> 
          <tr>
            <td>Product Picture:</td>
            <td><input type="file" name="imagename" value="Choose File" />
			<img src="<?php echo $result["image"]?>"  /></td>            
          </tr>
          <tr>
            <td>Image 1:</td>
            <td><input type="file" name="dealimage1" value="Choose File" />
			<img src="<?php echo $result["image1"]?>"  /></td>            
          </tr>
          <tr>
            <td>Image 2:</td>
            <td><input type="file" name="dealimage2" value="Choose File" />
			<img src="<?php echo $result["image2"]?>"  /></td>            
          </tr>
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Embed FLV Video</td>
            <td><textarea style="height:48px;" name="flv" id="deal-create-flv" class="f-input" /><?php echo $result["flv"]?></textarea><td> or Upload FLV Video: &nbsp;<input type="file" name="flvvideo" value="Choose File" />	</td>			          
          </tr>
          <tr><td></td><td><span class="hint">Please add your iframe here and set the width="253" and height="174".</span></td></tr>
           
           </table>
      
<b style="margin-bottom: 2px; display: block;">Highlights</b>
      
        <table>
        <tr>
            <td><textarea name="dealdetails" cols="" rows=""><?php echo $result["detail"]?></textarea>
            <script type="text/javascript">
                CKEDITOR.replace( 'dealdetails' );
                </script>
            
          </td>
        </tr>         
        </table>
      </div>

     <b style="margin-bottom: 2px; display: block;">Delivery Information</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Delivery
            <?php
               $selected = $result["delivery"];
			   if($selected=="Voucher")
			   {
			 ?>
             
                <label>
                  <input type="radio" name="delivery" value="Voucher" id="delivery_0" checked="checked" />
                  Voucher</label>
                
                <label>
                  <input type="radio" name="delivery" value="Express Delivery" id="delivery_1" />
                  Express Delivery</label>
                
                <label>
                  <input type="radio" name="delivery" value="Self withdraw" id="delivery_2" />
                  Manually Collect from 99aed Office</label>
                  <?php
				  }
				  elseif($selected=="Express Delivery")
				  {
				  ?>
                  <label>
                  <input type="radio" name="delivery" value="Voucher" id="delivery_0" />
                  Voucher</label>
                
                <label>
                  <input type="radio" name="delivery" value="Express Delivery" id="delivery_1" checked="checked" />
                  Express Delivery</label>
                
                <label>
                  <input type="radio" name="delivery" value="Self withdraw" id="delivery_2" />
                  Manually Collect from 99aed Office</label>
                  <?php
				  }
				  elseif($selected=="Self withdraw")
				  {
				  ?>
                  <label>
                  <input type="radio" name="delivery" value="Voucher" id="delivery_0" />
                  Voucher</label>
                
                <label>
                  <input type="radio" name="delivery" value="Express Delivery" id="delivery_1"/>
                  Express Delivery</label>
                
                <label>
                  <input type="radio" name="delivery" value="Self withdraw" id="delivery_2" checked="checked" />
                 Manually Collect from 99aed Office</label>
                  <?php
				  }
				  			  
				  ?>
				                  
            </td>
            </tr>
                   
        </table>
      </div>
      <b style="margin-bottom: 2px; display: block;">SEO Optimization</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>SEO Keywords</td>
            <td><input name="seokeyword" type="text" value="<?php echo $result["seokey"]?>" />
            <?php echo $errseokeyword ?>
            </td>
        </tr>  
        <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>SEO Description</td>
            <td><textarea style="height:48px;" name="seodescription" id="seodescription"><?php echo $result["seodesc"]?></textarea>
            <?php echo $errseodescription ?>
            </td>
        </tr>   
             
        </table>
      </div>
      
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
  
  <span class='st_sharethis_large' displayText='ShareThis'></span>
  <span class='st_facebook_large' displayText='Facebook'></span>
  <span class='st_twitter_large' displayText='Tweet'></span>
  <span class='st_linkedin_large' displayText='LinkedIn'></span>
  <span class='st_pinterest_large' displayText='Pinterest'></span>
  
      </div>
      <p align="center"><input name="Submit" type="submit" value="Submit" /></p>
</form>
</body>
</html>
