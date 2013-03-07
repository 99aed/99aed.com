<?php 
error_reporting(E_ERROR | E_PARSE);
include("includes/db.php");
include("includes/function.php");

// function to validate form elements
function validate()
{
    global $err;
    $err="";
	if(trim($_POST["title"])=='')
	{
			global $errtitle;
		    $errtitle=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Please select title</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["firstname"])=='')
	{
			global $errfname;
		    $errfname=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter First Name</font></td>
          </tr>';
		  $err=1;
 	}
	if(trim($_POST["lastname"])=='')
	{
			global $errlname;
		    $errlname=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter Last Name</font></td>
          </tr>';
		  $err=1;
 	}
	
	if(trim($_POST["email"])=='')
	{
		global $errMail;
		$errMail=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter the Email</font></td>
          </tr>';
		  $err=1;
	}
	if(trim($_POST["email"])<>'')
	{
		if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$",trim($_POST["email"])))
		{ 
			global $errmailFormat;
			$errmailFormat=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter a vaild Email</font></td>
          </tr>';
		  $err=1;
		}
	}
	
  if (trim($_POST["email"]) <> '')
  {
	  global $message;
	  //select email from user table to check whether email id already exist or not
	  $selectEmail  = mysql_query("select email from user") or die("select email from user".mysql_error());
	  while($result = mysql_fetch_array($selectEmail))
	  {
		$email = $result["email"];
		if($email == $_POST["email"])
		{
		$message=' <tr>
			 <td class="normaltext">&nbsp;</td>
			 <td colspan="2" class="errorText"><font color="#FF0000">Email id already exist. Please use a different email for signing</font></td>
		</tr>';
		$err=1;
		}
	   }
   }
		
	if(trim($_POST["password"])=='')
	{
		global $errpwd;
		$errpwd=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter the Password</font></td>
          </tr>';
		  $err=1;
	}
	if(trim($_POST["repassword"])=='')
	{
		global $errrepwd;
		$errrepwd=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Re-enter the Password here</font></td>
          </tr>';
		  $err=1;
	}
	if($_POST["password"]!=$_POST["repassword"])
	{
	   global $errpwds;
		$errpwds=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Passwords donot match</font></td>
          </tr>';
		  $err=1;
	}
	
	if(trim($_POST["street"])=='')
	{
		global $errStreet;
		$errStreet=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Enter the Street</font></td>
          </tr>';
		  $err=1;
	}
	if(trim($_POST["city"])=='')
	{
		global $errcity;
		$errcity=' <tr>
		       <td class="normaltext">&nbsp;</td>
		       <td colspan="2" class="errorText"><font color="#FF0000">Select a City</font></td>
          </tr>';
		  $err=1;
	}
}

// code to register a user
if(isset($_POST["registerSubmit"]))
{
  global $message;
  validate();
  if($err<>1)
  {
   $Title           =  $_POST["title"];
   $firstName       =  $_POST["firstname"];
   $lastName        =  $_POST["lastname"];
   $day             =  $_POST["days"];
   $month           =  $_POST["month"];
   $year            =  $_POST["year"];
   $dateOfBirth     =  $day.$month.$year;
   $Email           =  $_POST["email"];
   $Password        =  base64_encode($_POST["password"]);
   $Street          =  $_POST["street"];
   $City            =  $_POST["city"];
   $contactNum      =  $_POST["contactnum"];
   $ipAddress       =  $_SERVER['REMOTE_ADDR'];
   $createTime      =  time();
   $activationCode  =  md5("mynewemail").base64_encode(trim($_POST["email"]));
   
   $insertquery = mysql_query("insert into user (title,email,password,dateofbirth,mobile,street,city_name,ip,create_time,fname,lname) values ('$Title','$Email','$Password','$dateOfBirth','$contactNum','$Street','$City','$ipAddress','$createTime','$firstName','$lastName')") or die("insert into user (title,email,password,dateofbirth,mobile,street,city_name,ip,create_time,fname,lname) values ('$Title','$Email','$Password','$dateOfBirth','$contactNum','$Street','$City','$ipAddress','$createTime','$firstName','$lastName')".mysql_error());
   if($insertquery)
   {
    $sendmessage = sendmail($Email,$firstName,$lastName,$activationCode);
	//echo $sendmessage;
   }
  }
}  

// code for login
if(isset($_POST["directLoginSubmit"]))
{
 session_start();
 global $count;
 $Loginemail = stripslashes($_POST["directLoginemail"]);
 $Loginpwd   = stripslashes(base64_encode($_POST["directLoginpassword"]));
 
 $selectQuery = mysql_query("select * from user where email='$Loginemail' and password='$Loginpwd'") or die("select * from user where email='$Loginemail' and password='$Loginpwd'".mysql_error());
 $numrows = mysql_num_rows($selectQuery);
   if($numrows == 1)
   {
    //session_register($Loginemail);
	//session_register($Loginpwd);
	//$_SESSION["authorized"] = true;
    echo "Login Sucess";
   }
   else
     echo "Login Failed";
 }

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="public/css/main.css" />
<link href='http://fonts.googleapis.com/css?family=Tangerine|Great+Vibes|Satisfy' rel='stylesheet' type='text/css' >
<link href='http://fonts.googleapis.com/css?family=Strait|Geo|Quantico|Iceland' rel='stylesheet' type='text/css' >
<link href="public/css/als.css" rel="stylesheet" type='text/css' />
<link href="public/css/jquery.bxslider.css" rel="stylesheet" type='text/css' />
<title>99AED</title>
</head>
<body>
<div id="outerWrapper">
    <section id="headerContent">
        <header>
            <h1>Everything is under 99AED</h1>
        </header>
        <a href=""><div id="headerLogo"><!-- --></div></a>
        <header>
            <h2>We would love to here from you.</h2>
        </header>
        <div id="headerContact">
            <a href="skype:skype99aed.com?call"><h6>skype99aed.com</h6></a>
            <a href="mailto:info@99aed.com"><h6>info@99aed.com</h6></a>
        </div>
        <div id="subcribeWrapper">
            <span>Your wish is our command.</span>
            <form name="subscriptionForm" id="subscriptionForm" action="" method="post"> 
                <input type="text" id="subscriptionEmail" name="subscriptionForm[email]" value="" />
                <label id="subscriptionEmailLabel" for="subscriptionEmail">Email Address</label>
                <input type="button" value="Subscribe" name="subscribeSubmit" /> 
            </form><!-- Subscrption form -->
        </div>
        <div id="authenticateWrapper">
            <a id="registrationLink" href="#">Register</a>
            <div id="register_boxes">
                <div id="register_dialog" class="register_window">
                    <span class="titleInAuth2">New User Registration</span>
                    <div id="register_box">
                        <form id="directRegisterForm" name="directRegisterForm" action="" method="post">            
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr><td colspan="3"><div class="divHeight"><!-- --></div></td></tr>
                                <tr>
                                    <td><label>Title</label></td>
                                    <td><select name="title">
                                            <option value="Miss">Miss.</option>
                                        	<option value="Mrs">Mrs.</option>
                                            <option value="Mr">Mr.</option>
                                        </select><?php echo $errtitle ?>

                                    </td>
                                    <td><label><input type="checkbox" id="subscriptionAgreement" />I would like to receive emails containing information on all other latest offers.</label></td>                                    
                                </tr>
                                <tr>
                                    <td><label>First Name</label></td>
                                    <td colspan="2"><input id="firstName" type="text" name="firstname" /><?php echo $errfname ?></td>
                                </tr>
                                <tr><td colspan="3"><div class="divHeight"><!-- --></div></td></tr>
                                <tr>
                                    <td><label>Last Name</label></td>
                                    <td><input id="lastName" type="text" name="lastname" /><?php echo $errlname ?></td>
                                    <td><label>Unsubscribe at any time by clicking the link at the bottom of our newsletter.</label></td>                                    
                                </tr>
                                <tr>
                                    <td><label>Date of Birth</label></td>
                                    <td colspan="2">
                                    	<select name="days">
                                           <?php 
										     for($i=1; $i<=31 ; $i++)
											 {
											   echo '<option value="'.$i.'">'.$i.'</option>';
											 }
											 ?>
                                        </select>
                                    	<select name="month">
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                        	<option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    	<select name="year">
                                            <?php
											for($i=1920 ; $i<=2013 ;$i++)
											{
											 echo '<option value="'.$i.'">'.$i.'</option>';
											}
											?>
                                        	
                                        </select>
                                    </td>                                    
                                </tr>
                                <tr><td colspan="3"><div class="divHeight"><!-- --></div></td></tr>
                                <tr>
                                    <td><label>Email</label></td>
                                    <td><input id="email" type="text" name="email" /><?php echo $errMail."&nbsp;".$errmailFormat ."&nbsp;".$message ?></td>
                                    <td><label><input type="checkbox" id="licenceAgreement" />I have read, understand and agree to the terms &amp; conditions.</label></td>                                    
                                </tr>
                                <tr>
                                    <td><label>Password</label></td>
                                    <td colspan="2"><input class="registrationInputs" id="password" type="password" name="password" /><?php echo $errpwd ?></td>
                                </tr>
                                <tr><td colspan="3"><div class="divHeight"><!-- --></div></td></tr>
                                <tr>
                                    <td><label>Confirm Password</label></td>
                                    <td colspan="2"><input class="registrationInputs" id="confirmPassword" name="repassword" type="password" /><?php echo $errpwds ."&nbsp;". $errrepwd ?></td>
                                </tr>
                                <tr><td colspan="3"><div class="divHeight"><!-- --></div></td></tr>
                                <tr>
                                    <td><label>Street</label></td>
                                    <td><input class="registrationInputs" id="street" type="text" name="street" /><?php echo $errStreet ?></td>
                                    <td><label>I am at least 18 years old.</label></td>                                    
                                </tr>
                                <tr><td colspan="3"><div class="divHeight"><!-- --></div></td></tr>
                                <tr>
                                    <td><font color="#FF0000"><span>*</span></font><label>City</label></td>
                                    <td colspan="2">
                                        <select class="registrationInputs" name="city">
                                            <option value="Abu Dhabi">Abu Dhabi</option>
                                            <option value="Ajman">Ajman</option>
                                            <option value="Dubai" selected="selected">Dubai</option>
                                            <option value="Fujairah">Fujairah</option>
                                            <option value="Ras Al Khaimah">Ras Al Khaimah</option>
                                            <option value="Sharjah">Sharjah</option>
                                            <option value="Umm Al Qaiwain">Umm Al Qaiwain</option>
                                       </select><?php echo $errcity ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Contact no</label></td>
                                    <td><input class="registrationInputs" id="contactNo" type="text" name="contactnum" /></td>
                                	<td><input id="registerSubmit" type="submit" name="registerSubmit" value="Proceed" /></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><div id="directLoginError"><!-- --></div></td>                        
                                </tr>
                                <tr>
                                    <td colspan="3"><span>*</span>&nbsp;<span>Required</span></td>                    
                                </tr>
                            </table>  
                        </form>
                    </div>
                </div>
                <div id="register_mask"></div>
            </div>
            <a id="loginLink" href="#">Login</a> 
            <div id="login_boxes">
                <div id="login_dialog" class="login_window">
                    <span class="titleInAuth">Login</span>
                    <div id="login_box">
                        <form id="directLoginForm" name="directLoginForm" action="" method="post">            
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td><label>Email Address</label></td>
                                    <td><input id="directLoginEmail" type="text" name="directLoginemail" /></td>
                                </tr>
                                <tr><td colspan="2"><div class="divHeight"><!-- --></div></td></tr>
                                <tr>
                                    <td><label>Password</label></td>
                                    <td><input id="directLoginPassword" type="text" name="directLoginpassword" /></td>                        
                                </tr>
                                <tr>
                                    <td colspan="2"><div id="directLoginError"><!-- --></div></td>                        
                                </tr>
                                <tr>
                                    <td colspan="2"><input id="directLoginSubmit" type="submit" name="directLoginSubmit" value="Proceed" /></td>                    </tr>
                                <tr>
                                    <td colspan="2"><a id="ForgotPassword" href="javascript:void(0);">Forgot your password?</a></td>                    
                                </tr>
                            </table>  
                        </form>
                    </div>
                </div>
                <div id="login_mask"></div>
            </div>
        </div><!-- Login links -->
    </section>
    <aside>
    	<div id="langPrefWrapper">
        	<header>
            	<span>For Arabic version&nbsp;&nbsp;</span>
            </header>
            <a href="javascript:void(0);">AR</a>
            <a href="javascript:void(0);">EN</a> 
        </div>
        <div id="citySelectorWrapper">
        	<header><span>I want to buy deals in</span></header>
        	<select name="cityList">
            	<option value="Abu Dhabi">Abu Dhabi</option>
            	<option value="Ajman">Ajman</option>
            	<option value="Dubai" selected="selected">Dubai</option>
            	<option value="Fujairah">Fujairah</option>
            	<option value="Ras Al Khaimah">Ras Al Khaimah</option>
            	<option value="Sharjah">Sharjah</option>
            	<option value="Umm Al Qaiwain">Umm Al Qaiwain</option>
           </select>
        </div>
        <div id="supplierWrapper">
        	<header><a href="">Become a Supplier/Partner</a></header>
        </div>
        <div id="featuredDealsWrapper">
        	<header><h6>More Great Deals</h6></header>
        	<span id="underlineGreatDeals">______________</span>
            <div id="featuredDealSliderWrapper" class="als-wrapper">
            	<img id="featureDealsLoadingIndicator" src="" />
            </div>    
        </div><!-- fetaured deals information here -->
    </aside><!-- Aside ends here -->
    <setion id="middleContent">
    	<div id="middleContentWrapper">
        	<nav>
                <ul>
                	<li><a href="javascript:void(0);">Deals</a></li>
                    <li><a href="javascript:void(0);">Products</a></li>
                    <li><a href="javascript:void(0);">Looking Good</a></li>
                    <li><a href="javascript:void(0);">General</a></li>
                </ul>
        	</nav>
            <a href="javascript:void(0);">
            	<div id="premiumLinkWrapper">
                	<h6>99aed Premium</h6>
                    <h6>Luxury at affordable price</h6>
                </div>
            </a>
            <div id="randomDealSlider"><!-- --></div><!-- Slider ends here -->
            <div id="priceExtraDetails">	
                <!--
                <div class="priceDetailNodes">
                    <div>
                        <span>99aed.com</span>
                        <span>Everything is under 99AED</span>
                    </div>
                    <div>
                        <span>PREORDER NOW</span>
                        <span>only </span>
                        <span>99</span>
                        <div>
                            <span>.00 </span>
                            <span>AED</span>
                        </div>
                    </div>
                    <div>
                        <span>You save</span>
                        <span>50</span>
                        <div>
                            <span>.00</span>
                            <span>AED</span>
                        </div>
                    </div>
                    <div>
                        <span>Original Price</span>
                        <span>149</span>
                        <div>
                            <span>.00</span>
                            <span>AED</span>
                        </div>
                    </div>
                    <div>
                        <span>DISCOUNT</span>
                        <span>-34%</span>
                        <div><span>Thank you for buying</span></div>
                    </div>
                </div>-->
            </div>
        </div>
        <div id="countDownDetailsWrapper">
        	<div><!-- --></div>
        	<div>
            	<span id="smallDetail">GRAB IT BEFORE</span><br />
                <span id="timer"><!-- --></span>
            </div>
            <div>
            	<span><!-- Numbers bought this deal goes here -->10 BOUGHT</span><br />
                <span>DEAL IS AVAILABLE</span>
            </div>
        </div>
        <div id="countDownDetailsWrapperNext">
           	<span><a href="javascript:void(0);">TREAT YOUR LOVE ONES</a></span><br />
            <span><a href="javascript:void(0);">SHARE TO YOUR FRIENDS</a></span>
        </div><!-- Count down details and other details will ends here -->
        <div id="companyInfoPanel">
        	<span>About the company</span><br />
            <span>99AED.com</span><br />
            <span>Suite 3202 32<sup>nd</sup></span><br />
            <span>ETA Star's Al Manara Tower</span><br />
            <span>Burj Kalifa, Business Bay</span><br />
            <span>Dubai</span>            
        </div>
        <div id="companyMap">
                <iframe width="225" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;q=25.184124,55.259981&amp;aq=0&amp;oq=Business+bay&amp;sll=25.184124,55.259981&amp;sspn=0.001318,0.002642&amp;ie=UTF8&amp;hnear=Business+Bay+-+Dubai+-+United+Arab+Emirates&amp;t=h&amp;rq=1&amp;split=0&amp;ll=25.183661,55.266638&amp;spn=0.019418,0.019226&amp;z=14&amp;output=embed"></iframe><br /><small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;q=25.184124,55.259981&amp;aq=0&amp;oq=Business+bay&amp;sll=25.184124,55.259981&amp;sspn=0.001318,0.002642&amp;ie=UTF8&amp;hnear=Business+Bay+-+Dubai+-+United+Arab+Emirates&amp;t=h&amp;rq=1&amp;split=0&amp;ll=25.183661,55.266638&amp;spn=0.019418,0.019226&amp;z=14" style="color:#0000FF;text-align:left"><!-- View Larger Map --></a></small>
        	<span>99AED GT LLC</span>
        </div><!-- Company location map in the google map -->
		<div id="benefitsAndFinePrintDetailsWrapper">
        	<div class="benefitsAndFinePrintDetailsWrapper">
            	<header>
                	<h6>What You Get ?</h6>
                </header>
                <article><!-- --></article>
            </div>
            <div class="benefitsAndFinePrintDetailsWrapper">
            	<header>
                	<h6>The Fine Prints</h6>
                </header>
                <article><!-- --></article>
            </div>
        </div>
    </section>
<footer>
	<div id="footerWrapper">
        <div>
            <ul>
                <li class="footerMainLi">
                    <span><a href="javascript:void(0);">Know Us</a></span>
                    <ul>
                        <li><a href="javascript:void(0);">About Us</a></li>
                        <li><a href="javascript:void(0);">Privacy Policy</a></li>
                        <li><a href="javascript:void(0);">Terms &amp; Condition</a></li>
                        <li><a href="javascript:void(0);">Affliate Program</a></li>
                        <li><a href="javascript:void(0);">Testimonials</a></li>                
                    </ul>
                </li>
                <li class="footerMainLi">
                    <span><a href="javascript:void(0);">Meet Us On</a></span>
                    <ul>
                        <li><a href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Facebook</a></li>
                        <li><a href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Linkedln</a></li>
                        <li><a href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Twitter</a></li>
                        <li><a href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MSN</a></li>
                        <li><a href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;My Space</a></li>
                        <li><a href="skype:skype99aed.com?call">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Skype</a></li>
                        <li><a href="javascript:void(0);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You Tube</a></li>
                    </ul>
                </li>
                <li class="footerMainLi">
                    <span><a href="javascript:void(0);">Payment Methods</a></span>
                </li>
                <li class="footerMainLi">
                    <span><a href="javascript:void(0);">Customer Services</a></span>
                    <ul>
                        <li><a href="javascript:void(0);">Contact Us</a></li>
                        <li><a href="javascript:void(0);">Site Guide</a></li>
                        <li><a href="javascript:void(0);">FAQ</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div><!-- Image for the consumer protection --></div>
        <div>
            <span id="copyRightMsg">Copyright and All Right Reserved Here</span>
        </div>
    </div>
</footer>
</div>
<script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" language="javascript" src="public/scripts/jquery.infieldlabel.min.js"></script>
<script type="text/javascript" language="javascript" src="public/scripts/jquery.countdown.js"></script>
<script type="text/javascript" language="javascript" src="public/scripts/lightbox.js"></script>
<script type="text/javascript" language="javascript" src="public/scripts/main.js"></script>
</body>
</html>