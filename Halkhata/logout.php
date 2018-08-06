<html>
<head>
<title>
Hello bakari
</title>
<link rel="stylesheet" href ="VIEW.CSS">
  <link rel="shortcut icon" href="http://static02.hongkiat.com/logo/hkdc/favicon.ico">
  <link rel="icon" href="http://static02.hongkiat.com/logo/hkdc/favicon.ico">
  <link rel="stylesheet" type="text/css" media="all" href="style.css">
  <link rel="stylesheet" type="text/css" media="all" href="responsive.css">
<style>
#header
{
	background-color:#66CC99;
	color:white;
	text-align:center;
	padding :35px;
}
#space 
{
	height:2px;
}
#nav
{
text-align:center-left;
background-color:#5798B4;
color:black;
padding :35px;
}
#buttonsize
{
	background-color:#eeeeee;
	text-color:black;
	width:15em;
	height:3em;
	font-weight:bold;
	
}
#btnsize
{
	background-color:#eeeeee;
	color:black;
	width:10em;
	height:3em;	
}
</style
</head>
<body bgcolor ="#eeeeee">
<div id="header">
<h1>FARID BEKARI HOUSE</h1>
</div>
 </div>
 <ul id="menu">
	<li><a href="RECENTSELL.PHP" title="recent sell" class="selected"><h3>TODAYS SELL</h3></a></li>
	<li><a href="frontpage.PHP" title="show record"><h3>SHOW RECORD</h3></a>
	<ul>
	    <li> <a href="indivisual.PHP" title="Indivisual record"><h3>INDIV.. RECORD</h3></a></li>
	    <li> <a href="statistical.PHP" title="statistical record"><h3>STATISTICAL RECORD</h3></a></li>
	 </ul>
	
	 </li>
	<li><a href="frontpage.PHP" title="admin"><h3>ADMIN PANEL</h3></a>
		<ul>
			<li><a href="frontpage.PHP" title="create"><h3>CREATE</h3></a>
				<ul>
					<li><a href="CUSER.PHP" title="create user"><h3>USER</h3></a></li>
					<li><a href="CACCOUNT.PHP" title="create account"><h3>ACCUONT</h3></a></li>
					<li><a href="CADMIN.PHP" title="create admin"><h3>CREATE ADMIN</h3></a></li>
				</ul>
			</li>
			<li><a href="frontpage.php" title="delete"><h3>DELETE</h3></a>
				<ul>
					<li><a href="DUSER.PHP" title="delete user"><h3>USER</h3></a></li>
					<li><a href="DACCOUNT.PHP" title="delete account"><h3>ACCOUNT</h3></a></li>
					<li><a href="DUpdate.PHP" title="update"><h3>UPDATE ADMIN</h3></a></li>
				</ul>
			</li> 
			<li><a href ="logOUT.php" title ="logout"><h3>LOG OUT</h3></a>
			</li>
			<li><a href ="login.php" title ="logIN"><h3>LOG IN</h3></a>
			</li>
		</ul>
	</li>
	<li><a href="frontpage.PHP" title="add record"><h3>ADD RECORD</h3></a>
	<ul>
	    <li> <a href="record.PHP" title="customer record"><h3>CUS.. RECORD</h3></a></li>
	    <li> <a href="sellrecord.PHP" title="sales record"><h3>SALES RECORD</h3></a></li>
	 </ul>
	</li>
	</ul>
<br><br><br><br><br>
<div id="space">
</div>
<?php
$con =oci_connect('hr','hr','orcl');
 $update="UPDATE LOGIN SET BOOL=0 WHERE bool=1";
	
$dbcon=oci_parse($con,$update);
$exe=oci_execute($dbcon,OCI_DEFAULT);
if($exe)
{
	oci_commit($con);
}
 header("location:login.php");	
?>
<div id="space">
</div>
<div id="nav">
<h1>YOU HAVE SUCCESFULLY LOGGED OUT !</h1>
<script>
alert("Thanks for log out");
</script>
</div>
</body>
</html> 