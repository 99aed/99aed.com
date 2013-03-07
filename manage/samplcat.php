<?php
include("../includes/db.php");
include("../includes/function.php");
if(isset($_POST["submit"]))
{
$category = $_POST["category"];
echo $category;

$insert = mysql_query("insert into deals (product) values('$category')") or die ("insert into deals (product) values('$category')".mysql_error());
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post">
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
</select>
<input type="submit" name="submit" />
</form>
</body>
</html>
