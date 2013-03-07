<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Marketing</title>
</head>
<body>
<br /><br />
<form action="" method="post" name="create">
<b style="margin-bottom: 2px; display: block;">Email Marketing</b>

      <div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
        <table>
        <tr>
            <td width="150"><span class="required">*</span>Title</td>
            <td><input name="title" type="text" /></td>
          </tr>
          <tr>
            <td width="150"><span class="required">*</span> Recipient:</td>
            <td><input type="text" name="recipient" value="" /></td>
          </tr> 
           <tr>
            <td width="150"><span class="required">*</span> Content:</td>
            <td><input type="text" name="content" value="" /></td>
          </tr>                   
        </table>
      </div>
      
     

      <p align="center"><input name="Submit" type="submit" value="Submit" /></p>
</form>
</body>
</html>
