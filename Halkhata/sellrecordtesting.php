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
  <script>
function newDoc() {
    window.location.assign("indivisual.php")
}
</script>
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
//$ar = array('apple', 'orange', 1, false, null, true, 3 + 5);
$rnd=mt_rand(100,10000000000);
$con =oci_connect('hr','hr','orcl');
$tak="select distinct(goods) from sellinfo";
$takparse=oci_parse($con,$tak);
oci_execute($takparse);
$t=0;
$ar="";
while(($row=oci_fetch_array($takparse,OCI_BOTH))!=false)
{
	$ar[$t++]=$row[0];

}
	
	$us="select distinct(phone) from phoneinfo";  //phone no 
	$usparse=oci_parse($con,$us);
	oci_execute($usparse);
	$usloop="";
	$k=0;
	while(($usval=oci_fetch_array($usparse,OCI_BOTH))!=false)
		$usloop[$k++]=$usval[0];
	
	
?>

<script >
var counter = 1;
var limit = 51;
var totalsum=0;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
		      var usval = <?php echo json_encode($usloop) ?>;
        
		   
		var pop='';
		  for(var ind=0;ind<usval.length;ind++)
		  {
			  pop+='<option value="'+usval[ind]+'"/>';
			  
		  }
		 document.getElementById("months").innerHTML=pop;
		  
     
                 var newdiv = document.createElement('div');
		  newdiv.innerHTML ="<br><br>"+"<h2>&laquo list no '"+counter+"' </h2>";
		  newdiv.innerHTML+=""  + "<h3><em>&laquo</em>Name of Goods</h3>";
		  newdiv.innerHTML+=""  + "<input list='month'  name='good"+counter+"' class='txtinput'>";
		  newdiv.innerHTML+=""  + "<datalist id='month' value='testing'>";
		  newdiv.innerHTML+=""  + "</datalist>";  
		  newdiv.innerHTML +="" + "<h3><em>&laquo</em>Quantity</h3>";
		  newdiv.innerHTML +="" +  " <input type='text' name='quantity"+counter+"' class='txtinput'>";
		  newdiv.innerHTML +="" + "<h3><em>&laquo</em>Price per Quantity</h3>";
          newdiv.innerHTML +="" +  " <input type = 'text' name='perquantity"+counter+"'  class='txtinput'>";
		  newdiv.innerHTML +="" + "<h3><em>&laquo</em>Total price</h3>";
          newdiv.innerHTML +="" +  " <input type='text' id='myInput"+counter+"' name='price"+counter+"' value='' oninput='myfunc()' class='txtinput'>";
		 // newdiv.innerHTML +="" +  "<p id='demo'></p>";
		
		document.getElementById(divName).appendChild(newdiv);
		var ar = <?php echo json_encode($ar) ?>;
  
		var op='';
		  for(var i=0;i<ar.length;i++)
		  {
			  op+='<option value="'+ar[i]+'"/>';
		  }
		  document.getElementById("month").innerHTML=op;	  
          window.scrollBy(0,1000);
		 
		  //if(counter==2){
		 // totalsum+=parseInt(document.hongkiat.price1.value); 
	
		  //}
		  
		       counter++;
			  // document.getElementById("demo").innerHTML=totalsum;
		  
     }
	 
}
var tr=[];
var ctr=[]
for(var i=0;i<50;i++)
	tr[i]=ctr[i]=0;
	
function myfunc()
{
// var x=document.getElementById("myInput1").value;
 var v='myInput'+(counter-1);
 var x=document.getElementById(v).value;
 var val=parseInt(x);
  if(isNaN(val))
	  val=0;
   tr[0]=0;
   tr[counter-1]=val;
 //document.getElementById("demo").innerHTML="you wrote :"+tr[counter-1];
	
var sum=0;
   for(var i=0;i<counter-1;i++)
	   sum+=tr[i];
   sum+=tr[counter-1];
   document.getElementById("demo").innerHTML="Total sells price :"+sum;
 
}
</script>

<?php 
$con=oci_connect('hr','hr','orcl');
?>

<?php
function get_input($phone= "") 
{
  echo <<<END
  
  <section id="container">
		<form name="hongkiat" id="hongkiat-form" method="post" action="sellrecord.php">
	
		<div id="wrapping" class="clearfix">
			<section id="aligned">
			
			<em><h3>Username</h3></em>
		<input list= "months" name="phon" id="phon" value ="" placeholder="+88" tabindex="5" class="txtinput" />
	       <datalist id="months" >
            </datalist>
			</section>
			
			 <span class="chyron"><em><a href="frontpage.php">&laquo; back to the bekari</a></em></span>
             <span class="chyron"><em><a href="record.php" target="_blank"><br><br>&laquo; Create New Customer ACCout</a></em></span>
             
	    </div>
		
	    <p id="demo"></p>
		 
			 <input type =text" name ="amount" id="amount" placeholder="Enter deposited Amount" class="txtinput">
			   <section id="buttons">
			   
			 <input type="button" value="Create a text input" class="submitbtn" id="submitbtn" onClick="addInput('aligned')">
			
			<input type="reset" name="reset" id="resetbtn" class="resetbtn" value="Reset">
			<input type="submit" name="submit" id="submitbtn" class="submitbtn" tabindex="7" value="Submit this!">
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
if(!empty($_POST["phon"]))
{
 //get_input();
//echo "marked"."<br>";	
?>
   <section id="container">
   
   <h3><span class="chyron"><em><a href="sellrecord.php">&laquo; refresh<br><br></a></em></span></h3>
            
   <table id="t01">
   </tr>

	<th><h1>Goods name</h1></th>
	<td><h1>quantity</h1></td>
	 <th><h1>price per quantity</h1></th>
	<td><h1>price</h1></td></h1>
	</tr>
<?php
$x=1;
$total=0;
$va=50;
 while($va>0)
 {
	 $va--;
	 $st=(string)$x;
	 $gd="good".$st;
	 $qn="quantity".$st;
	 $pq="perquantity".$st;
     $pr="price".$st;
	
	   if(empty($_POST["$gd"]) or empty($_POST["$pr"]))	   
	   $x++;
       else{
       ?>
	   <tr>
        <td><h1><?php  
	    echo $_POST["$gd"];?><h1></td><td><h1>
		<?php
	    echo $_POST["$qn"];  ?></h1></td><td><h1><?php
	    echo $_POST["$pq"];?></h1></td><td></h1><?php
	    echo $_POST["$pr"];
		$total+=$_POST[$pr];
           ?></h1></td>
	  </tr>
	  
	   <?php
$strSQL = "INSERT INTO sellinfo ";  
$strSQL .="(phone,goods,quantity,perquantity,price) ";  
$strSQL .="VALUES ";  
$strSQL .="('".$_POST["phon"]."','".$_POST["$gd"]."','".$_POST["$qn"]."' ";  
$strSQL .=",'".$_POST["$pq"]."','".$_POST["$pr"]."') ";  
$objParse = oci_parse($con, $strSQL);  
$objExecute = oci_execute($objParse);  

 $x++;
 //oci_rollback($con);
}
 }
 if(!empty($_POST["amount"])){
 $st="INSERT INTO amount";
 $st.="(phone,amount)";
 $st.="values";
 $st.="('".$_POST["phon"]."','".$_POST["amount"]."')";
 $dep=oci_parse($con,$st);
 oci_execute($dep);
 
 }
 else
	 $_POST["amount"]=0;
?>

</table>
<br>
<h2>
<?php
echo "Total sales price is ".$total." Taka<br>";
?></h2>
<h2>
<?php
echo "Total deposited amount  is ".$_POST["amount"]." Taka<br>";
?></h2> </section>
<?php
}
else
{
	get_input();
	if(!empty($_POST["submit"]))
	{
     ?>
     <script>
	 alert("You must fill up the user name \n If Username not matched then create New");

  </script>
	<?php
	}
    //echo "You Must Enter the user name"."<br>";
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
oci_commit($con);
}
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
oci_close($con);
?>
</body>
</html>