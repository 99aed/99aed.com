<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
$page_id  = $_GET["page"];

// code to add website details
if(isset($_POST["Submit"]))
{
 $webname    =  $_POST["webname"];
 $webtitle   =  $_POST["webtitle"];
 $compemail  =  $_POST["compemail"];
 $compphone  =  $_POST["compphone"];
 $deflang    =  $_POST["deflang"];
 $maintain   =  $_POST["maintain"];
 echo $webname .  $webtitle.  $compemail . $compphone . $deflang . $maintain ;
 $insertquery = mysql_query("insert into websitedetails(websitename,websitetitle,compemail,compphone,deflanguage,mode) values('$webname','$webtitle','$compemail','$compphone','$deflang','$maintain')") or die("insert into websitedetails(websitename,websitetitle,compemail,compphone,deflanguage,mode) values('$webname','$webtitle','$compemail','$compphone','$deflang','$maintain')".mysql_error());
 if($insertquery)
  echo '<div> Successfully Added</div>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>General Settings</title>
<!--<script>
function countrows(){
var count = document.getElementById("languageTerms").rows.length;
var url="?action=phpFunction&vars="+count;
	
	// Opens the url in the same window
	   window.open(url, "_self");

}
</script>-->
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
<form action="" method="post" name="settings">
<?php
if($page_id == "settings")
{
?>
<br /><br />
<b style="margin-bottom: 2px; display: block;">General Settings</b>

      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
      <div class="block" style="margin-bottom:20px;">
        <label>Website Name</label>
          <input class="input" type="text" name="webname"/>
      </div>
     <div class="block" style="margin-bottom:20px;">
       <label>Web Site Title</label>
         <input class="input" type="text" name="webtitle"/>
     </div>
      
      <div class="block" style="margin-bottom:20px;">
       <label>Buisness Email / Company Email</label>
         <input class="input" type="text" name="compemail"/>
     </div>
      <div class="block" style="margin-bottom:20px;">
       <label>Buisness Phone / Company Phone</label>
         <input class="input" type="text" name="compphone"/>
     </div>
     <div class="block" style="margin-bottom:20px;">
       <label>Default Language</label>
         <select name="deflang">         
         <option value="1">Arabic</option>
         <option value="2" selected="selected">English</option>
         </select>
     </div>
     <div class="block" style="margin-bottom:20px;">
       <label><input type="checkbox" name="maintain"/>Maintenance Mode</label>
         
     </div>
     
      </div>
      <p align="center"> <input type="submit" name="Submit" value="Submit" /></p>
<?php
}
elseif($page_id == "translation");
{
 
?>
  <b style="margin-bottom: 2px; display: block;">Already Existing Terms</b>

      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
      <table id="existterms" width="50%" border="0" cellspacing="0" cellpadding="0">
      <th width="30">English Text</th><th width="40">Arabic Translation</th>
      <?php
	  if(!isset($page)) 
	  { 
 $page = 1; 
 } 
 else 
 { 
 $page = $page; 
 } 
 $max_results = 5; 
 $from = (($page * $max_results) - $max_results);
 
 // select query to fetch terms from database and display
 $selectquery = mysql_query("select * from translation LIMIT $from, $max_results") or die(mysql_error());
 $num_rows =  mysql_num_rows($selectquery); 
 $select=mysql_query("SELECT * FROM translation"); 
 $total_results = mysql_num_rows($select);
 $max_results = 5; 
 $prev = ($page - 1); 
 $next = ($page + 1); 
 $total_pages = ceil($total_results / $max_results); 
 echo "<div align=center>";
 if($page > 1) 
 { 
 echo "&lt;&lt;<a href=clients.php?page=$prev>&nbsp;Previous</a> - "; 
 } 
 for($i = 1; $i <= $total_pages; $i++) 
 { 
 if(($page) == $i) 
 { 
 echo "$i($total_pages)"; 
 } 
 else 
 { 
 echo "<a href=Settings.php?page_id=translation&page=$i> $i </a>"; 
 } 
} 
if($page < $total_pages) 
{ 
echo " - <a href=Settings.php?page_id=translation&page=$next>Next</a>&nbsp;&gt;&gt;"; 

} 
elseif ($page = $total_pages) 
{ 
} 

echo "</div>";
       while($result = mysql_fetch_array($select))
	   {
	  ?>
      
      <tr>
      <td style="text-align:center">
        <input type="hidden" name="termid"  value="<?php echo $result["term_id"] ?>"/>
        <input type="text" name="enutermtext" value="<?php echo $result["English"] ?>"  />
      </td>
      <td style="text-align:center">
        <input type="text" name="aratermtext" value="<?php echo $result["Arabic"] ?>"  />
      </td>
      </tr>
         
     
     <?php
     }
	 
     ?>
      </table>  
 </div>
 
<b style="margin-bottom: 2px; display: block;">Add More Transaltions</b>

      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
      <table width="50%" border="0" cellspacing="0" cellpadding="0" id="languageTerms">
      <th width="30">English Text</th><th width="40">Arabic Translation</th>
           
      <tr>
          <td style="text-align:center"><input type="text" name="enutext"  /></td>
          <td style="text-align:center"><input type="text" name="aratext"  /></td>
      </tr>
      <tr>
          <td style="text-align:center"><input type="text" name="enutext1"  /></td>
          <td style="text-align:center"><input type="text" name="aratext1"  /></td>
      </tr>
      <tr>
          <td style="text-align:center"><input type="text" name="enutext2"  /></td>
          <td style="text-align:center"><input type="text" name="aratext2"  /></td>
      </tr>
      <tr>
          <td style="text-align:center"><input type="text" name="enutext3"  /></td>
          <td style="text-align:center"><input type="text" name="aratext3"  /></td>
      </tr>
      <tr>
          <td style="text-align:center"><input type="text" name="enutext4"  /></td>
          <td style="text-align:center"><input type="text" name="aratext4"  /></td>
      </tr>
      
      <!--<tr id="languageBtnTr"><td><input type="button" name="addmore" id="languageAddMore" value="Add more text" /></td></tr>-->
      </table>
      <p align="center"><input type="submit" name="addtrans" value="submit" /></p>
<?php
}
?>
</form>
</body>
</html>
<?php
if(isset($_POST["addtrans"]))
{
 $enutext    = $_POST["enutext"];
 $enutext1   = $_POST["enutext1"];
 $enutext2   = $_POST["enutext2"];
 $enutext3   = $_POST["enutext3"];
 $enutext4   = $_POST["enutext4"];
 
 $aratext    = $_POST["aratext"];
 $aratext1   = $_POST["aratext1"];
 $aratext2   = $_POST["aratext2"];
 $aratext3   = $_POST["aratext3"];
 $aratext4   = $_POST["aratext4"];
 $aratext5   = $_POST["aratext5"];
 
 $insertquery = mysql_query("insert into translation (English,Arabic) values ('$enutext','$aratext'),('$enutext1','$aratext1'),('$enutext2','$aratext2'),('$enutext3','$aratext3'),('$enutext4','$aratext4')") or die("insert into translation (English,Arabic) values ('$enutext','$aratext'),('$enutext1','$aratext1'),('$enutext2','$aratext2'),('$enutext3','$aratext3'),('$enutext4','$aratext4')");
 if($insertquery)
  header("location:Settings.php?page_id=translation");
}
?>