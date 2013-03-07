<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
$page_id = $_GET["page"];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>City Page</title>
</head>

<body>

<br /><br /><br />
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px"">

                <div class="head">
                <?php
                if($page_id=='cities')
				{
				?>
                <h2>Cities</h2>
                 <?php
				 }
				 elseif($page_id=='country')
				 {
				 ?>
                 <h2>Country</h2>
                 <?php } ?>
				</div>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="30">ID</th><th width="80">Full Name</th><th width="80">Short Name</th><th width="80" nowrap>Character</th><th width="80" nowrap>Country</th><th width="80" nowrap>Operation</th></tr>

					
					<tr><td colspan="9"><ul class="paginator"><li class="current">1</li></ul></tr>

					

                    </table>

				</div>

</div>

</body>
</html>
