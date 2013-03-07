<?php
error_reporting(E_ERROR | E_PARSE);
include("header.html");
function layout($page_id) {
    switch($page_id) {
        default: //Default, ie when the page_id does not match with predefined cases
            defaultfinancial($page_id);
			break;
        case '': //When it is null
		    echo "Page is not found";
		    break;
		case 'receivable': 
			defaultfinancial($page_id);
		    break;
		case 'rebate': 
			defaultfinancial($page_id);
		    break;
		case 'offline': 
			defaultfinancial($page_id);
		    break;
		case 'online': 
			defaultfinancial($page_id);
		    break;
		case 'withdraw': 
			defaultfinancial($page_id);
		    break;
		case 'cash': 
			defaultfinancial($page_id);
		    break;
		case 'refund': 
			defaultfinancial($page_id);
		    break;
		
	}
}
$page_id = $_GET["page"];
layout($page_id);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insta Index</title>
</head>

<body>
<?php
function defaultfinancial($page_id)
{
?>
<br /><br /><br />
<div class="panel box" style="background:center;position:relative;margin:10px 0px 0px 0px; padding-bottom:20px"">

                <div class="head">
                <?php
                if($page_id=='receivable')
				{
				?>
                <h2>Recievables (Total Amount: AED<?php echo 0?>)</h2>
                <?php
				defaultinvitationpage();
				}	
                elseif($page_id=='rebate')
				{			
                ?>
                <h2>Amount Received (Total Amount: AED<?php echo 0?>)</h2>
                <?php
				defaultinvitationpage();
				}
				elseif($page_id=='offline')
				{			
                ?>
                <h2>Offline Topup (Total: AED<?php echo 0?>)</h2>
                <?php
				topuppage();
				}
				elseif($page_id=='online')
				{			
                ?>
                <h2>Online Topup (Total: AED<?php echo 0?>)</h2>
                <?php
				topuppage();
				}
				elseif($page_id=='withdraw')
				{			
                ?>
                <h2>User Withdraw (Total: AED<?php echo 0?>)</h2>
                <?php
				withdraw();
				}
				elseif($page_id=='cash')
				{			
                ?>
                <h2>Pay By Cash (Total: AED<?php echo 0?>)</h2>
                <?php
				cashpayments();
				}
				elseif($page_id=='refund')
				{			
                ?>
                <h2>Refund Record (Total: AED<?php echo 0?>)</h2>
                <?php
				cashpayments();
				}
				?>
				</div>
<?php

}

function defaultinvitationpage()
{
?>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="30">Item</th><th width="380">Initiative user</th><th width="20"></th><th width="80" nowrap>Get invited</th><th width="100">Invite time <br/>Operate</th></tr>

					
					<tr><td colspan="9"><ul class="paginator"><li class="current">1</li></ul></tr>

					

                    </table>

				</div>

</div>
<?php 
}

function topuppage()
{
?>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="30">Email/Username</th><th width="380">Operation</th><th width="20"></th><th width="80" nowrap>Amount</th><th width="100">Operator</th><th width="100">Offline TopupTime</th></tr>

					
					<tr><td colspan="9"><ul class="paginator"><li class="current">1</li></ul></tr>

					

                    </table>

				</div>

</div>
<?php 
}

function withdraw()
{
?>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="30">Email/Username</th><th width="380">Operation</th><th width="20"></th><th width="80" nowrap>Amount</th><th width="100">Operator</th><th width="100">User WithdrawTime</th></tr>

					
					<tr><td colspan="9"><ul class="paginator"><li class="current">1</li></ul></tr>

					

                    </table>

				</div>

</div>
<?php 
}

function cashpayments()
{
?>

                <div class="sect">

					<table id="orders-list" cellspacing="0" cellpadding="0" border="0" class="coupons-table" style="font-size:12px; width:880px">

					<tr><th width="80">Deal Item</th><th width="380">Email/Username</th><th width="20"></th><th width="80" nowrap>Operation</th><th width="80" nowrap>Amount</th><th width="100">Operator</th><th width="100">Order Time</th></tr>

					
					<tr><td colspan="9"><ul class="paginator"><li class="current">1</li></ul></tr>

					

                    </table>

				</div>

</div>
<?php 
}
?>

</body>
</html>
