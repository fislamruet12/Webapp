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
function get_input($name= "" ,$father= "" ,$postcode= "" ,$email= "" ,$telephone= "" ,$message= "") 
{
  echo <<<END

	<section id="container">
		<span class ="chyron"><em><h1>Add Customer Information Correctly</h1></em> </span>
		<form name="hongkiat" id="hongkiat-form" method="post" action="#">
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			<input type="tel" name="telephone" value ="$telephone"id="telephone" placeholder="Phone number?(compulsory)*" tabindex="4" class="txtinput">
		
			<input type="text" name="name" value ="$name" id="name" placeholder="Your name?(compulsory)*" autocomplete="off" tabindex="1" class="txtinput">

		    <input type="text" name="father" value ="$father"id="name" placeholder="Your father name?(optional)" autocomplete="off" tabindex="1" class="txtinput">
			 
			 <input type="text" name="postcode" value ="$postcode"id="email" placeholder="Your post code?(compulsory)*" autocomplete="off" tabindex="1" class="txtinput">
		
			<input type="email" name="email"value ="$email" id="email" placeholder="Your e-mail address" autocomplete="off" tabindex="2" class="txtinput">
		
      		<textarea name="message" id="message" placeholder="Enter cus location ...*" tabindex="5" class="txtblock"></textarea>
		
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
if($logarr[0]==1)
{
if(!isset($_REQUEST['name']))
	get_input();
else
{
	
	$check="select id from phoneinfo where phone ='".$_REQUEST['telephone']."'";
	$ckparse =oci_parse($con,$check);
	oci_execute($ckparse);
	$p=oci_fetch_array($ckparse,OCI_BOTH);
	echo $p[0];
	if($p[0]!=null)
	{
    ?> 
   <span class ="chyron"><em><h1>This phone no is already Exist</h1></em> </span>
   <?php
    get_input($_REQUEST['name'], $_REQUEST['father'],$_REQUEST['postcode'], $_REQUEST['email'],$_REQUEST['telephone'], $_REQUEST['message']);
	}
  else if (empty($_REQUEST['name']) or empty($_REQUEST['postcode'])or empty($_REQUEST['telephone']) or empty($_REQUEST['message'])) 
  {
   ?> 
   <span class ="chyron"><em><h1>You Must fill up all the asteric field</h1></em> </span>
   <?php
    get_input($_REQUEST['name'], $_REQUEST['father'],$_REQUEST['postcode'], $_REQUEST['email'],$_REQUEST['telephone'], $_REQUEST['message']);
  }
else
{
	?> 
   <span class ="chyron"><em><h1>You succesfully submitted all Record </h1></em> </span>
   <?php
   
	//get_input();
	
    $str="select bool From login where bool=1";
	$parse=oci_parse($con,$str);
	oci_execute($parse);
	$row=oci_fetch_array($parse,OCI_BOTH);
	if($row[0]==1)
	{
		
		
$strSQL = "INSERT INTO customerinfo ";  
$strSQL .="(id,NAME,father,postcode,email,home) ";  
$strSQL .="VALUES ";  
$countid=oci_parse($con,'select *from customerinfo where insdate=(select max(insdate) from customerinfo)');
//$countid=oci_parse($objConnect,'select count(customerid) from client');
oci_execute($countid);
$row1=oci_fetch_array($countid,OCI_BOTH);
$_POST["ID"]=$row1[0]+1;
$strSQL .="('".$_POST["ID"]."','".$_POST["name"]."','".$_POST["father"]."' ";  
$strSQL .=",'".$_POST["postcode"]."','".$_POST["email"]."','".$_POST["message"]."') ";  
$objParse = oci_parse($con, $strSQL);  
$objExecute = oci_execute($objParse);  
if($objExecute)  
{  
oci_commit($con); //*** Commit Transaction ***//  
echo "Succesfully submitted ID number is ".$_POST["ID"]."<br>"; 
}  
else  
{  
oci_rollback($con); //*** RollBack Transaction ***//  
$e = oci_error($objParse);  
echo "Error Save [".$e['message']."]";  
} 
 
 
$strSQLp = "INSERT INTO phoneinfo";  
$strSQLp .="(phone,id) ";  
$strSQLp .="VALUES ";  
$strSQLp .="('".$_POST["telephone"]."','".$_POST["ID"]."')";  
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
 header("location:sellrecord.php");	
}
}	
}
}
else
{
	?>
	<section id="container">
		<span class ="chyron"><em><h1>You have to login first !</h1></em> </span>
		<div id="wrapping" class="clearfix">
		
			<section id="aside" class="clearfix">
				<section id="recipientcase">
				<span class="chyron"><em><a href="login.php">&laquo; Back to login House </a></em></span><br>
				</section>
		</div>
	</section>
	
<?php
}


?>
</body>
</html>