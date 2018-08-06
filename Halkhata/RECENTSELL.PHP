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
	clear:both;
	text-align:center;
   height:4px;
}
#nav
{
text-align:center-left;
background-color:#66CC99;
color:black;
padding:15px;
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
#fPART
{
  background-color:#E0F574;
	color:black;
	width:35%;
	float:left;
	height:auto;
	text-align:center;
	
}
#mPART
{
  background-color:#eee;
	color:black;
	width:5%;
	float:left;
	height:25.5em;
	  background-color:#5798B4;
}
#sPART
{
  background-color:#E0F574;
	color:black;
	float:left;
	width:57%;
	text-align:center;
	height:auto;
}
table {
    width:100%;
}
table, th, td {
    border: 1px solid #5798B4;
    border-collapse: collapse;
}
th, td {
    padding: 1px;
    text-align: left;
}
table#t01 tr:nth-child(even) {
    background-color: #eee;
}
table#t01 tr:nth-child(odd) {
   background-color:#eee;
}
table#t01 th	{
    background-color:#5798B4;
    color: white;
}
</style
</head>
<body bgcolor ="#eeeeee">
<?php
$con=oci_connect('hr','hr','orcl');

?>
<div id="header">
<h1>FARID BEKARI HOUSE</h1>
</div>
 </div>
 <ul id="menu">
	<li><a href="RECENTSELL.PHP" title="recent sell" class="selected"><h3>TODAYS SELL</h3></a></li>
	<li><a href="frontpage.PHP" title="show record"><h3>SHOW RECORD</h3></a>
	<ul>
	    <li> <a href="indivisual.PHP" title="Indivisual record"><h3>INDIVIDUAL RECORD</h3></a></li>
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
	    <li> <a href="record.PHP" title="customer record"><h3>CUSTOMER RECORD</h3></a></li>
	    <li> <a href="sellrecord.PHP" title="sales record"><h3>SALES RECORD</h3></a></li>
	 </ul>
	</li>
	<li><a href="frontpage.PHP" title="halkhata"><h3>HALKHATA</h3></a>
	</li>
	</ul>
<br><br><br><br><br>
<div id="space">
</div>
<?php
$strSQL = "SELECT  bool from login  WHERE bool=1";
$dbcon=oci_parse($con,$strSQL);
if($dbcon)
{
	$exe=oci_execute($dbcon);
	$row=oci_fetch_array($dbcon,OCI_BOTH);
	//echo $row[0];
}
else
	$row[0]=0; //if zero then login
?>

<?php
if($row[0]==0)
{
?>
<div id="nav">
<h1> YOU HAVE TO LOGIN FIRST !</h1>
<em><a><href ="login.php">
</div>
<?php
}
else
{
?>

<?php

$sell="select distinct(phone) from sellinfo where  selldate>sysdate-1 and selldate<sysdate+1";
$sellparse=oci_parse($con,$sell);
oci_execute($sellparse);
  
?>
<div id="space">
</div>
<?php
while(($phoneitem=oci_fetch_array($sellparse,OCI_BOTH))!=false)
{
	//echo $phoneitem[0];
	?>
<?php
  $matchphone="select c.id ,p.phone,c.name,c.father,c.home,c.postcode,c.email from sellinfo s,phoneinfo p,customerinfo c where $phoneitem[0]=p.phone and p.id=c.id and selldate>sysdate-1 and selldate<sysdate+1";
  $matchphoneparse=oci_parse($con,$matchphone);
  oci_execute($matchphoneparse);
  $sellitem=oci_fetch_array($matchphoneparse,OCI_BOTH);

  ?>
	
<div id="fPART">
	<table id="t01">
	<tr><th><h1>Customer details</h1></th>
	<th> </th></tr>
  <tr>
    <th>phone</th>
    <td><?php echo $phoneitem[0]?></td>		
  </tr>
  <?php
	if(!isset($sellitem[2]))
	  $sellitem[2]="null";
   ?>
  <tr>
    <td>Name</td>
    <td><?php echo $sellitem[2]?></td>		
	</tr>
	<?php
	if(!isset($sellitem[3]))
	  $sellitem[3]="null";
   ?>
	<tr>
    <th>Father/husband</th>
    <td><?php echo $sellitem[3]?></td>		
  </tr>
  <?php
	if(!isset($sellitem[4]))
	  $sellitem[4]="null";
   ?>
  <tr>
    <td>Home</td>
    <td><?php echo $sellitem[4]?></td>		
   </tr>
   <?php
	if(!isset($sellitem[5]))
	  $sellitem[5]="null";
   ?>
   <tr>
    <th>Postcode</th>
    <td><?php echo $sellitem[5]?></td>		
   </tr>
   <?php
	if(!isset($sellitem[6]))
	  $sellitem[6]="null";
   ?>
   <tr>
    <td>Email</td>
    <td><?php echo $sellitem[6]?></td>		
   </tr>
  </table>
  </div> 
  <div id="mPART">
 
  </div>
  <?php
  $sellgoods="select *from sellinfo where sellinfo.phone=$phoneitem[0] and selldate>sysdate-1 and selldate<sysdate+1";
  $sellgoodsparse=oci_parse($con,$sellgoods);
  oci_execute($sellgoodsparse);
  ?>
  <div id="sPART">
	<table id="t01">
	<tr>
	<th><h1>Customer sells details</h1></th>
	<th></th>
		<th></th>
			<th></th>
				<th></th>
				<th></th>
	</tr>
	<tr>
	<td>Serial no</td>
	<td>goods name</td>
	<th>quantity</td>
	 <td>price per quantity</td>
	<th>price</th>
	<td>selling date</td>

	</tr>  
  <?php
  $it=1;
  $sum=0;
  while(($item=oci_fetch_array($sellgoodsparse,OCI_BOTH))!=false)
  {
	  $sum+=$item[4];
  ?>
     <?php
	  for($i=1;$i<6;$i++)
	  if(!isset($item[$i]))
		  $item[$i]="$";
		  
	 ?>
	<tr>
	<td><?php echo $it++?></td> 
	<th><?php echo $item[1] ?></th>
	<td><?php echo $item[2] ?></td>
	<th><?php echo $item[3] ?></th>
	<td><?php echo $item[4] ?></td>
     <th><?php echo $item[5] ?></th>
	</tr>  
<?php	
  }
  ?>
  </tr>
	<tr>
	<th>Total selling price </th>
	<th></th>
	<th></th>
	<th>=</th>
	<td><?php echo $sum?></td>
	<th>Taka</th>
	</tr>  
  </table>
  </div>
<div id="space">
</div>
	<?php
}
}
?>
</body>
</html> 