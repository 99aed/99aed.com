<?php
error_reporting(E_ERROR | E_PARSE);
include("db.php");

// function to upload images
function uploadimage($dealpicturename,$dealpicturetype,$dealpictureerror,$dealpicturesize,$dealpicturetmpname)
{
$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $dealpicturename));

if ((($dealpicturetype == "image/gif")|| ($dealpicturetype == "image/jpeg")|| ($dealpicturetype == "image/png")|| ($dealpicturetype == "image/pjpeg"))
&& ($dealpicturesize < 2097152)&& in_array($extension, $allowedExts))
  {
  if ($dealpictureerror > 0)
    {
    echo "Return Code: " . $dealpictureerror . "<br>";
    }
  else
    {
      $dealpicturename;
      $dealpicturetype;
      ($dealpicturesize / 1024);
      $dealpicturetmpname;

    if (file_exists("../upload/" . $dealpicturename))
      {
      echo $dealpicture. " already exists. ";
      }
    else
      {
      move_uploaded_file($dealpicturetmpname,
      "../upload/" . $dealpicturename);
      $imagepath =  "upload/" . $dealpicturename;	   
      }
    }
  }
else
  {
  echo '<br/><div> Invalid file </div>';
  }
  return $imagepath;
 }
 
 // function to select the city name
 function selectcity($city_id)
 {
  $selectcity = mysql_query("select city_name from city where city_id= '$city_id'") or die ("select city_name from city where city_id= '$cityid'". mysql_error());
  $resultcity = mysql_fetch_array($selectcity);
  $cityname   = $resultcity["city_name"];
  return $cityname;
 }
 
 function selectcategory($cat_id)
 {
   $selectcategory = mysql_query("select name from category where id='$cat_id'") or die ("select name from category where id='$cat_id'".mysql_error());
   $resultcat = mysql_fetch_array($selectcategory);
   $name = $resultcat["name"];
   return $name;
 }
 
 function selectpartner()
 {
   $selectpartner = mysql_query("select id,username from partner") or die ("select id,username from partner".mysql_error());
   $resultpart = mysql_fetch_array($selectpartner);
   $id   = $resultpart["id"];
   $name = $resultpart["username"];
   return array($id,$name);
 }
 
 function sendmail($Email,$firstName,$lastName,$activationCode)
 {
    $to        = $Email;
	$subject   = 'Activate your account to start shopping';
    $message   = '<html><body>';
    $message  .='<table border="0" style="border-spacing:5px;"><tr><td>Hi &nbsp;'.$firstName.'&nbsp;'.$lastName.'</td><td>';
	$message  .= '<tr><td> Congratulations!Youve just created an account to shop with 99AED.<br/>But you are not finished yet.
                  <br/>To activate your account and confirm ownership of this email address, click the link below</td></tr>';
	$message  .= '<tr><td><a href="http://localhost/99aeddeals/activation.php?activation='.$activationCode.'">http://localhost/99aeddeals/activation.php?activation='.$activationCode.'</a></td></tr>';
    $message  .= "</body></html>";
    $headers   = 'From: uma@99aed.com' . "\r\n" .
                'MIME-Version: 1.0' . "\r\n" .
				'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
     if(mail($to, $subject, $message, $headers))
	 {
	     $sendmessage = "Thankyou for registering with us. <br/> An activation Email has been sent to your account. Please check your mail and activate your account";
	 }
	 return $sendmessage;
 }
?>
