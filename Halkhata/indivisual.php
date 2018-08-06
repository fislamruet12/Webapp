<!doctype html>	
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title>Farid bekari</title>
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
	width:65%;
	float:left;
	height:auto;
	text-align:center;
	font-weight:bold;
	
}
#mPART
{
  background-color:while;
	color:black;
	width:34%;
	float:left;
	height:auto;
	  background-color:#5798B4;
}
#mPART1
{
	color:black;
	width:1%;
	float:left;
	height:auto;
}
#sPART
{
  background-color:#E0F574;
	color:black;
	float:left;
	width:65%;
	text-align:center;
	height:auto;
	font-weight:bold;
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

<body>
<?php
	$con=oci_connect('hr','hr','orcl');
	$us="select distinct(phone) from phoneinfo";  //phone no 
	$usparse=oci_parse($con,$us);
	oci_execute($usparse);
	$usloop="";
	$k=0;
	while(($usval=oci_fetch_array($usparse,OCI_BOTH))!=false)
		$usloop[$k++]=$usval[0];
		
?>
<?php
function get_input($phone= "") 
{
  echo <<<END
  
  <section id="container">
		<form name="hongkiat" id="hongkiat-form" method="get" action="indivisual.php">
	
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			
			<em><h3>Enter search for Customer:</h3></em>
		<input list= "months" name="phone" id="phone" value ="$phone" placeholder="+88" tabindex="5" class="txtinput" />
	       <datalist id="months" >
            </datalist>

			</section>
			 <span class="chyron"><em><a href="frontpage.php">&laquo; back to the bekari</a></em></span>
             
	    </div>
			   <section id="buttons">
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
			<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="search">
			<br style="clear:both">
		
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
 
 ///-------
 if(empty($_REQUEST['phone']))
 {
	 get_input();
 }else if(!empty($_REQUEST['phone']))
 {
	 get_input($_REQUEST['phone']);
	 
  $matchphone="select c.id ,p.phone,c.name,c.father,c.home,c.postcode,c.email from sellinfo s,phoneinfo p,customerinfo c where p.phone='".$_GET["phone"]."' and p.id=c.id";
  $matchphoneparse=oci_parse($con,$matchphone);
  oci_execute($matchphoneparse);
  $sellitem=oci_fetch_array($matchphoneparse,OCI_BOTH);
  if($sellitem[0]==null){
	  
	  echo "<br> No items are found";
  }
   else{
  ?>
   <div id="space">
  </div>
  <section id="container">
  <div id="wrapping" class="clearfix">
<div id="fPART">
	<table id="t01">
	<tr><th><h1>Customer details</h1></th>
	<th> </th></tr>
  <tr>
    <th>phone</th>
    <td><?php echo $_GET["phone"]?></td>		
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
  
  <div id="space">
  </div>
  <div id="space">
  </div>
  <?php
  $sellgoods="select *from sellinfo where sellinfo.phone='".$_GET["phone"]."' order by selldate asc";
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
	<td><h1><?php echo $sum?><h1></td>
	<th>Taka</th>
	</tr>  
  </table>
  </div>
<div id="mPART1">
.
</div>
<div id="mPART">
		    <?php
  $sellgoods="select *from amount where amount.phone='".$_GET["phone"]."' order by dpdate asc";
  $sellgoodsparse=oci_parse($con,$sellgoods);
  oci_execute($sellgoodsparse);
  ?>
	<table id="t01">
	<tr>
	<th>Serial no</th>
	<th>deposited Amount</th>
	<th>date</th>

	</tr>  
  <?php
  $it=1;
  $sum1=0;
  while(($item=oci_fetch_array($sellgoodsparse,OCI_BOTH))!=false)
  {
	  $sum1+=$item[1];
  ?>
     <?php
	  for($i=1;$i<3;$i++)
	  if(!isset($item[$i]))
		  $item[$i]="$";
		  
	 ?>
	<tr>
	<td><?php echo $it++?></td> 
	<td><?php echo $item[1] ?></td>
	<td><?php echo $item[2] ?></td>
	</tr>  
<?php	
  }
  ?>
  </tr>
	<tr>
	<th>Total Deposited Taka =</th>

	<td><h1><?php echo $sum1?><h1></td>
	<th>Taka</th>
	</tr>  
  </table>
  </div>
  </div>
  </section>
	<?php
 
  }
 }
 
 ///--------------
?>
<script>
var usval = <?php echo json_encode($usloop) ?>;
            
		var pop='';
		  for(var ind=0;ind<usval.length;ind++)
		  {
			  pop+='<option value="'+usval[ind]+'"/>';
			  
		  }
		 document.getElementById("months").innerHTML=pop;
</script>
<?php	
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