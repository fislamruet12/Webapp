<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title>Farid bekari</title>
  <meta name="author" content="Jake Rocheleau">
  <link rel="shortcut icon" href="http://static02.hongkiat.com/logo/hkdc/favicon.ico">
  <link rel="icon" href="http://static02.hongkiat.com/logo/hkdc/favicon.ico">
  <link rel="stylesheet" type="text/css" media="all" href="style.css">
  <link rel="stylesheet" type="text/css" media="all" href="responsive.css">
</head>

<body>

<?php
$con=oci_connect('hr','hr','orcl');
?>
<?php
function get_input($email= "",$password= "" ,$fullname= "" ,$passcode= "") 
{
  echo <<<END

	<section id="container">
		<span class ="chyron"><em><h1>Add Customer Information Correctly</h1></em> </span>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="email" name="email"value ="$email" id="email" placeholder="email as username (compulsory)* " autocomplete="off" tabindex="2" class="txtinput">
		
			<input type="password" name="password" value ="$password" id="name" placeholder="Password?(compulsory)*" autocomplete="off" tabindex="1" class="txtinput">

		    <input type="text" name="fullname" value ="$fullname"id="name" placeholder="Your Fullname (compulsory)*" autocomplete="off" tabindex="1" class="txtinput">
			 
			 <input type="text" name="passcode" value ="$passcode"id="email" placeholder="Admin passcode (compulsory)*" autocomplete="off" tabindex="1" class="txtinput">
		
			
				</section>
			<span class="chyron"><em><a href="frontpage.php">&laquo; back to the site</a></em></span>

		</div>


		<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
			<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Submit this!">
			<br style="clear:both;">
		</section>
		</form>
	</section>
END;
} 
$log="select bool from login where bool=1";
$logpar=oci_parse($con,$log);
oci_execute($logpar);
$logarr=oci_fetch_array($logpar,OCI_BOTH);
if($logarr[0]==0)
{
if(!isset($_REQUEST['email']))
	get_input();
else
{
	
	$check="select email from ownaccount where email ='".$_REQUEST['email']."'";
	$ckparse =oci_parse($con,$check);
	oci_execute($ckparse);
	$p=oci_fetch_array($ckparse,OCI_BOTH);
	//
	if($p[0]!=null)
	{
    ?> 
   <span class ="chyron"><em><h1><?php echo $p[0];?> is already Exist</h1></em> </span>
   <?php
    get_input($email="",$_REQUEST['password'],$_REQUEST['fullname'], $_REQUEST['passcode']);
	}
  else if (empty($_REQUEST['email']) or empty($_REQUEST['password'])or empty($_REQUEST['fullname']) or empty($_REQUEST['passcode'])) 
  {
   ?> 
   <span class ="chyron"><em><h1>You Must fill up all the asteric field</h1></em> </span>
   <?php
    get_input($email="",$_REQUEST['password'],$_REQUEST['fullname'], $_REQUEST['passcode']);
   }
else
{
	//get_input();
	
    $str="select passcode From admin where passcode='".$_POST['passcode']."'";
	$parse=oci_parse($con,$str);
	oci_execute($parse);
	$row=oci_fetch_array($parse,OCI_BOTH);
	if($row[0]==null)
	{
		?> 
   <span class ="chyron"><em><h1>Admin passcode not matched </h1></em> </span>
   
   <?php
    get_input($email="",$_REQUEST['password'],$_REQUEST['fullname'], $_REQUEST['passcode']);
  
	}else{
		
		?> 
   <span class ="chyron"><em><h1>You succesfully create a user </h1></em> </span>
   <span class="chyron"><em><a href="frontpage.php">&laquo; back to the site</a></em></span>

   <?php
   
		
$strSQL = "INSERT INTO ownaccount ";  
$strSQL .="(email,password,fullname) ";  
$strSQL .="VALUES ";
$strSQL .="('".$_POST["email"]."','".$_POST["password"]."','".$_POST["fullname"]."' )";   
$objParse = oci_parse($con, $strSQL);  
$objExecute = oci_execute($objParse);  
if($objExecute)  
{  
oci_commit($con); //*** Commit Transaction ***//  
//echo "Succesfully submitted ID number is ".$_POST[""]."<br>"; 
}  
else  
{  
oci_rollback($con); //*** RollBack Transaction ***//  
$e = oci_error($objParse);  
echo "Error Save [".$e['message']."]";  
} 
 
 
$strSQLp = "INSERT INTO login";  
$strSQLp .="(username,password,bool) ";  
$strSQLp .="VALUES ";  
$strSQLp .="('".$_POST["email"]."','".$_POST["password"]."',1)";  
$objParsep = oci_parse($con, $strSQLp);  
$objExecutep = oci_execute($objParsep);  
if($objExecutep)  
{  
oci_commit($con); //*** Commit Transaction ***//   
}  
else  
{  
oci_rollback($con); //*** RollBack Transaction ***//  
$e = oci_error($objParsep);  
echo "Error Save [".$e['message']."]";  
}
oci_close($con);
}
}	
}
}
else
{
	?>
	<section id="container">
		<span class ="chyron"><em><h1>You already logged in !</h1></em> </span>
		<div id="wrapping" class="clearfix">
		
			<section id="aside" class="clearfix">
				<section id="recipientcase">
				<span class="chyron"><em><a href="login.php">&laquo; Back to bekari House </a></em></span><br>
				</section>
		</div>
	</section>
	
<?php
}


?>
</body>
</html>