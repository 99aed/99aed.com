<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
include("../includes/function.php");
include("../includes/phpqrcode/qrlib.php");

// function to validate
function validate()
{
    global $err;
    $err="";
	if(trim($_POST["dealid"])=='')
	{
			global $errdealName;
		    $errdealName=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">please select a deal</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["vouchervalue"])=='' || !is_numeric($_POST["vouchervalue"]))
	{
			global $errvalue;
		    $errvalue=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter a valid voucher value(numbers only)</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["amount"])=='' || !is_numeric($_POST["amount"]))
	{
			global $erramount;
		    $erramount=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter number of vouchers needed(numbers only)</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["validfrom"])=='')
	{
			global $errvalidfrom;
		    $errvalidfrom=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">please select a date</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["validtill"])=='')
	{
			global $errvalidtill;			
		    $errvalidtill=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">please select a date</font></td>
          </tr>';
		  $err=1;
 	}
	$validfrom = $_POST["validfrom"];
	$validtill = $_POST["validtill"];
	if($validtill < $validfrom)
	{
	      global $errdates;			
		  $errdates=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Selected date is before start date</font></td>
          </tr>';
		  $err=1;
	}
	if(trim($_POST["code"])=='')
	{
			global $errcode;			
		    $errcode=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter a valide code</font></td>
          </tr>';
		  $err=1;
 	}
	
}

// Getting values from form to insert to card table
if(isset($_POST["Submit"]))
{
  validate();
  if($err<>1)
  {
  $dealvalue          = explode(",",$_POST["dealid"]);
  $dealid             = $dealvalue[0];
  $dealname           = $dealvalue[1];  
  $partnerid          = $_POST["idofpartner"];
  $vouchervalue       = $_POST["vouchervalue"];
  $amount             = $_POST["amount"];
  $validfrom          = $_POST["validfrom"];
  $validtill          = $_POST["validtill"];
  $code               = $_POST["code"];  
  $createtime         = $_SERVER['REQUEST_TIME'];
  $codeimgfoldername  = $createtime.$dealid.$partnerid;
  $codeimgname        = $codeimgfoldername."code.png";
  $codename           = $vouchervalue.$validfrom.$validtill.$code;
  $couponpath         = mkdir($codeimgfoldername);
  
   
  for($i=1; $i<=$amount ; $i++)
  {  
    QRcode::png($codename.$i,$i.$codeimgname,"L",4,4);
	$imgname = $i.$codeimgname;
	$destinationpath = $codeimgfoldername."/".$imgname;
	rename($imgname,$destinationpath);
	$insertquery = mysql_query("insert into card (couponpath,deals_id,dealname,credit,partner_id,begin_time,end_time) values ('$destinationpath','$dealid','$dealname','$vouchervalue','$partnerid','$validfrom','$validtill')") or die("insert into card (couponpath,deals_id,dealname,credit,partner_id,begin_time,end_time) values ('$destinationpath','$dealid','$dealname','$vouchervalue','$partnerid','$validfrom','$validtill')".mysql_error());
	
  }
  if($insertquery)
	     echo '<br><br>  Coupon added Successfully';
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Voucher</title>
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
		};
function finddeals(){
var partnerid = document.forms["createcoupon"]["partnerid"].value;
self.location='createcoupon.php?vars=' + partnerid ;
//var url="?vars="+partnerid;
// Opens the url in the same window
 // window.open(url, "_self");
}
</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
 // on default, show selectbox 
 $(document).ready(function(){
$('#hidepartner').click(function(){ 
var checked_status = this.checked; 
if(checked_status == true) { 
$('#partnerid').hide(); 
} 
else
{
$('#partnerid').show(); 
}
});}); 
</script>
</head>
<body>
<br /><br />
<form action="" method="post" name="createcoupon">
<?php
$partnerid = $_GET["vars"];
$selectpartner = mysql_query("select * from partner") or die("select * from partner".mysql_error());
?>
<b style="margin-bottom: 2px; display: block;">New Voucher</b>
      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td width="150">Select Partner</td><input type="checkbox" name="hidepartner" id="hidepartner" />Hide Partner
            <td>
            <select name="partnerid" id="partnerid" onchange="finddeals()">
            <option value="0">--Choose Partner--</option>
            <?php
			while($result = mysql_fetch_array($selectpartner))
			{
			if($result["id"]==$partnerid)
			{
			?>
             <option selected value="<?php echo $result["id"]?>"><?php echo $result["username"]?></option>
             <?php 
			 }
             else
			 {
			 ?>
            <option value="<?php echo $result["id"]?>"><?php echo $result["username"]?></option>
            <?php
			}
			}
			?>
            </select>
            </td>
          </tr>
          <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Deal Name:</td>
            <td><select name="dealid" id="deal_id">
             
			<?php 
			if($partnerid!="")
			{
			$selectdeal = mysql_query("select id,name from deals where partner_id='$partnerid'");
			while($deals = mysql_fetch_array($selectdeal))
			{
			?>
            <option VALUE="<?php echo $deals["id"] ?>,<?php echo $deals["name"]?>"><?php echo $deals["name"]?></option>
            <?php
			}
			
            }
            else
            {
			$selectdeals = mysql_query("select id,name from deals where user_id='1'") or die("select id,name from deals where user_id='1'".mysql_error());
			while($fetchdeals = mysql_fetch_array($selectdeals))
			{
			?>
            <option value="<?php echo $fetchdeals["id"] ?>"><?php echo $fetchdeals["name"]?></option>
            <?php
            }
			}
			?>
            </select><?php echo $errdealName ?>
            <input type="hidden" name="idofpartner" value="<?php echo $partnerid?>" />
              </td>
          </tr>
          <tr>
            <td width="150"><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Voucher Value:</td>
            <td><input type="text" name="vouchervalue" value="" /><?php echo $errvalue ?>
              </td>
          </tr>
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span>Number of Vouchers:</td>
            <td><input type="text" name="amount" value="" /><?php echo $erramount ?>
              </td>
          </tr>
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Valid from:</td>
            <td><input type="text" name="validfrom" id="startdate" value="" /><?php echo $errvalidfrom ?></td>            
          </tr> 
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> End Date:</td>
            <td><input type="text" name="validtill" id="enddate" value="" /><?php echo $errvalidtill. "<br/>". $errdates ?></td>            
          </tr>  
          <tr>
            <td><span class="required"><font style="color:#FF0000"><b>*</b></font></span> Voucher Code:</td>
            <td><input type="text" name="code" value="" /><?php echo $errcode ?></td>            
          </tr>           
        </table>
      </div>

      <p align="center"><input name="Submit" type="submit" value="Submit" /></p>
</form>
</body>
</html>
