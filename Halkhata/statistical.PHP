<!doctype html>	
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title>Farid bekari</title>
  <meta name="author" content="Jake Rocheleau">
  <link rel="shortcut icon" href="http://static02.hongkiat.com/logo/hkdc/favicon.ico">
  <link rel="icon" href="http://static02.hongkiat.com/logo/hkdc/favicon.ico">
  <link rel="stylesheet" type="text/css" media="all" href="salestyle.css">
 
  <link rel="stylesheet" type="text/css" media="all" href="responsive.css">
  <style>
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
</style>
</head>

<body>
<?php
$con=oci_connect('hr','hr','orcl');
$log="select bool from login where bool=1";
$logpar=oci_parse($con,$log);
oci_execute($logpar);
$logarr=oci_fetch_array($logpar,OCI_BOTH);
if($logarr[0]==1)
{
	?>
	<section id="container">
		<form name="hongkiat" id="hongkiat-form" method="get" action="statistical.php">
	
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			
			
			<em><h3><a>Enter </a>date search for showing statistical sell:</h3></em>
		     <input type="date" name="d1" placeholder="enter first date" class="txtinput">
			 <h3><a>To</a></h3>
			  <input type="date" name="d2" placeholder="enter second date" class="txtinput">
			</section>
			 <span class="chyron"><em><a href="frontpage.php">&laquo; back to the bekari</a></em></span>
             
	    </div>
			   <section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
			<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="search">
			<br style="clear:both">
		
		  	</form>
			

  </section>
  <?php
    if(!isset($_REQUEST['d1']))
{
	$v=1;
}
 else if (empty($_REQUEST['d1']) or empty($_REQUEST['d2'])) 
  {
   ?> 
   <span class ="chyron"><em><h1>You Must fill up both field</h1></em> </span>
   <?php
  }
else
{
// $strSQL = "SELECT  * FROM client  WHERE (NAME LIKE '%".$_GET["txtKeyword"]."%' )";
//$newDate = date("d-m-Y", strtotime($originalDate));
 $strSQL ="select count(goods) from sellinfo where selldate between TO_CHAR(TO_DATE('".$_GET["d1"]."','YYYY-MM-DD'),'DD-MON-YYYY') and TO_CHAR(TO_DATE('".$_GET["d2"]."','YYYY-MM-DD'),'DD-MON-YYYY')";
 //$strSQL+="and TO_CHAR(TO_DATE('".$_GET["b2"]."','YYYY-MM-DD'),'DD-MON-YYYY')";
 $stid=oci_parse($con,$strSQL);
 oci_execute($stid);
 while(($row=oci_fetch_array($stid,OCI_BOTH))!=false)
{
	//echo $row[0]."<br>";
	$total=$row[0];
}
  $strSQL1 ="select goods,count(goods) as totalgood from sellinfo where selldate between TO_CHAR(TO_DATE('".$_GET["d1"]."','YYYY-MM-DD'),'DD-MON-YYYY') and TO_CHAR(TO_DATE('".$_GET["d2"]."','YYYY-MM-DD'),'DD-MON-YYYY') group by goods order by totalgood desc";

 
 $stid1=oci_parse($con,$strSQL1);
 oci_execute($stid1);
 ?>
 <section id="container">
            
   <table id="t01">
   </tr>

	<td><h3><a>NAME of Goods<</a></h3></td>
	<td><h3><a>Selling Rate Between two date (
	<?php 
	echo $_REQUEST['d1']."   TO   ".$_REQUEST['d2'].")";
	?>
	</a></h3></td>
	</tr>
	<?php
	$cn=1;
 while(($row1=oci_fetch_array($stid1,OCI_BOTH))!=false)
{

   if($cn<=10)
   {
	   $cn++;
       ?>
	   <tr>
        <td><em><h3><?php  	echo $row1[0]." "; ?></h3></em></td>
		<td><em><a><h3>
		<?php
	      echo number_format($row1[1]*100/$total,2)." %<br>";   ?><h3></em></a></td>
	  </tr> 
  <?php 
   }else
   {
	   ?>
	    <tr>
        <td><h3><?php  	echo $row1[0]." "; ?></h3></td>
		<td><h3>
		<?php
	      echo number_format($row1[1]*100/$total,2)." %<br>";   ?><h3></td>
	  </tr> 
	   <?php
   }
}//
?>
</table> 
</section>
<?php
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