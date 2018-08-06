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
function get_input($email= "" ,$password= "") 
{
  echo <<<END

	<section id="container">
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
				<span class ="chyron"><em> USERNAME</em> </span>
			<input type="email" name="email"value ="$email" id="email" placeholder="Your e-mail address" autocomplete="off" tabindex="2" class="txtinput">
			<span class ="chyron"><em> PASSWORD</em> </span>
			<input type="password" name="password" value ="$password"id="telephone" placeholder="Your password" tabindex="4" class="txtinput">
				<span class="chyron"><em>New user? <a href="CACCOUNT.php">Register </a>here.</em></span><br>
			</section>
			 
			<span class="chyron"><em> <a href="frontpage.php">&laquo; Back to Bekari House </a></em></span><br>
				</div>
			
		<section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
			<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Submit form">
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
	echo $_POST["email"];
   if (empty($_REQUEST['email']) or empty($_REQUEST['password'])) 
  {
   ?> 
   <span class ="chyron"><em><h1>You Must fill up all the asteric field</h1></em> </span>
   <?php
    get_input($_REQUEST['email'],$_REQUEST['password']);
  }
else
{
	?> 
   <?php
	 get_input($_REQUEST['email'],$_REQUEST['password']);
		
		
//$strSQL = "INSERT INTO customerinfo ";  
//$strSQL .="(id,NAME,father,postcode,email,home) ";  
$strSQL ="UPDATE LOGIN SET BOOL=1,INS_DATE=SYSDATE WHERE (USERNAME = '".$_POST["email"]."' and PASSWORD = '".$_POST["password"]."' and bool=0)";  
//$strSQL .="('".$_POST["ID"]."','".$_POST["name"]."','".$_POST["father"]."' ";  
//$strSQL .=",'".$_POST["postcode"]."','".$_POST["email"]."','".$_POST["message"]."') ";  
$objParse = oci_parse($con, $strSQL);  
$objExecute = oci_execute($objParse);  
if($objExecute)  
{  
oci_commit($con); //*** Commit Transaction ***//  
}  
else  
{  
oci_rollback($con); //*** RollBack Transaction ***//  
$e = oci_error($objParse);  
echo "Error Save [".$e['message']."]";  
}
	 header("location:frontpage.php"); 
}	
}
}
else
{
	
	?>
     
	<section id="container">
		<span class ="chyron"><em><h1>You already  loggin!</h1></em> </span>
		<div id="wrapping" class="clearfix">
		
			<section id="aside" class="clearfix">
				<section id="recipientcase">
				<span class="chyron"><em><a href="frontpage.php">&laquo; Back to Bekari House </a></em></span><br>
				</section>
		</div>
	</section>
	
<?php
}
?>

</body>
</html>