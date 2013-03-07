<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
include("../includes/db.php");
if(isset($_POST["submitfaq"]))
{

 $question = $_POST["questions"];
 $answer   = $_POST["answers"];
 
 $insertquery = mysql_query("insert into faq (questions,answers) values('$question','$answer')") or die("insert into faq (questions,answers) values('$question','$answer')".mysql_error());
 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create FAQ</title>
</head>
<body>
<br /><br />
<form action="" method="post" name="createfaq">


      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 50px;">
      <h2>Frequently Asked Questions</h2>	
      <div class="block" style="margin-bottom:20px;">

							
                   <label> Questions </label>
                    <textarea name="questions" cols="50" rows="10" ></textarea>
                    </div>
                    <div class="block" style="margin-bottom:20px;">
                    <label> Answers </label>
                    <textarea name="answers" cols="50" rows="10"></textarea>
					
                    </div>
                    <p align="center"><input type="submit" name="submitfaq" value="submit" /></p>


</form>
</body>
</html>


