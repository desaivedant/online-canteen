<?php
session_start();
$con = mysql_connect("localhost","root","");
mysql_select_db("shoping", $con);
$cid=0;
$iid=$_POST['t1'];
$inm=$_POST['t2'];
$pr=$_POST['t3'];
$qty=$_POST['t4'];
$amt=$_POST['t5'];
$fl=0;
$d=date("Y-m-d");
$usr=$_SESSION['usr'];
$m="";
$flag=true;
if (isset($_POST['b1']))
{
	if(empty ($qty))
	{
	 $m=$m."*Enter quantity first ";
	$flag=false;
	}
	elseif(!is_numeric($qty))
	{
	$m=$m."*Not a number, please enter a number"; 
	}

	if(!isset($_SESSION['crt']))
	{
	$fl=1;
		$res=mysql_query("select max(cart_is) from cart_mast",$con);
		$rows=mysql_fetch_array($res);
		$n=mysql_num_rows($res);

		if($n>0)
		{
			$cid=$rows[0];
			$cid++;
		}
		else
		{
				$cid=1;
		}	
		$_SESSION['crt']=$cid;		
		
		mysql_query("insert into cart_details values($cid,$iid,$pr,$qty,$amt)");
		
		mysql_query("insert into cart_mast values ($cid,'$d','$usr',$amt)");
	}
	else
	{
	$fl=2;
		$cid=$_SESSION['crt'];		
		mysql_query("insert into cart_details values($cid,$iid,$pr,$qty,$amt)");
		mysql_query("update cart_mast set amount=amount+$amt where cart_is=$cid");
	}
	}


	
	
?>


<html>
<head><title>Ardent Square</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!-- Main CSS -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<!-- Short Codes Style -->
<link rel="stylesheet" href="css/shortcode.css" type="text/css" media="all">
<!-- skins -->
<link rel="stylesheet" name="skins" href="css/default.css" type="text/css" media="all">
<!-- Java CSS -->
<link rel="stylesheet" href="css/javascri.css" type="text/css" media="all">
<!-- full width gallery CSS -->
<link rel="stylesheet" href="css/full-width-gallery.css" type="text/css" media="all">
<!-- Google Font -->
<link href='http://fonts.googleapis.com/css?family=Raleway:200' rel='stylesheet' type='text/css'>
<!-- Responsive CSS -->
<link rel="stylesheet" href="css/responsive-layout.css" type="text/css" media="all">
<!-- Style Switcher Box -->
<link rel="stylesheet" href="css/switcher.css">
<!--[if lt IE 7]>
<script type="text/javascript" src="js/ie6_script_other.js"></script>
<![endif]-->
<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->

<style type="text/css">
<!--
.style1 {color: BLUE}
-->
</style>

<script language="JavaScript">
function calc(f)
{
	var v1,v2,v3;
	v1=eval(f.t3.value);
	v2=eval(f.t4.value);
	v3=v1*v2;
	f.t5.value=v3;
}
</script>

</head>
<!-- header -->
<?php include("utop.php"); ?>  
  <!-- header End --> 

<body>
<p>&nbsp;</p>
        <p>&nbsp;</p>
        
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<table border=0 width="100%">
<tr>
	<td width="15%" valign="top">
	<?php echo $fl ;?>
	&nbsp;&nbsp;
	<h2><p class="text2">Categories</p></h2>
<?php 
$res=mysql_query("select * from pro_cat",$con);
while($rr=mysql_fetch_array($res))
{
?>
<br/><img src="images/star0000.png">&nbsp;&nbsp;
<a href="disp.php?cid=<?php echo $rr[0];?>">
<?php echo $rr[1];?></a>
<?php } ?>
	

	</ul>								
	</td>
	
<td width="80%" valign="top">

<?php 
$id=$_GET['id'];
$res1=mysql_query("select * from product where p_id=$id",$con);
$r1=mysql_fetch_array($res1);
?>

<form id="f" method="post" action="#">
<table  border=0>
            <tr>
                <td rowspan="6">
                    <img src="<?php echo $r1[5];?>" height=200 width=200></td>
                <td>
                    PCode</td>
                <td>
                    <input  name= "t1" type="text" id="t1" value="<?php echo $r1[0];?>" readonly="readonly"/></td><td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    Name</td>
                <td>
                    <input name="t2" type="text" id="t2" value="<?php echo $r1[1];?>" readonly="readonly"/></td><td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                   For </td>
                <td>
                    <?php echo $r1[3];?></td><td>&nbsp;</td>
            </tr>
            <tr>
                <td>
                    Price</td>
                <td>
                   <input name="t3" type="text"  id="t3" value="<?php echo $r1[4];?>" readonly="readonly"/></td><td>&nbsp;</td>
            </tr>
			<tr>
                <td>
                    Quantity</td>

                <td><input type="text" id="t4" name="t4" />&nbsp;&nbsp;&nbsp;<input type="button" value="Click" onClick="calc(f)" class="sendbtn">&nbsp;&nbsp;&nbsp; 
	<font color="red" >
	<?php if($f==false)
	{
	echo $m;
	}
	?></font>
	</td>	
            <td>
	
	</td>
	</tr>
			<tr>
                <td>
                    Amount</td>
                <td>
                    <input name="t5" type="text" id="t5" readonly="readonly"/> &nbsp;&nbsp;
<a href="viewcart.php" style="text-decoration:none">
<input type="submit" id="b1" name="b1" value="Save To Cart" class="sendbtn" /></td></a>
	<td>&nbsp;</td>
            </tr>
<tr><td></td>
<td></td>
<td></td>
<td></td></tr>
            
        </table>
</form> 

<p>&nbsp;&nbsp;</p>
 <br>
<br>
  </td>

<td width="30%" valign="top">
<p>&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;</p>
<p>&nbsp;&nbsp;</p><p>&nbsp;&nbsp;</p>	
	</td>
</tr>
</center>
</table>

<br>
<br>
<br><br><br>
<!--footer-->

<?php include("foot.php"); ?>
      
  <!-- footer end --> 
</div>
<div class="switcher"></div>
<!-- Start JavaScript --> 
<script type="text/javascript" src="js/jquery-all.js"></script><!-- all files --> 
<script type="text/javascript" src="js/jquery-banner.js"></script><!-- Banner JS --> 
<script type="text/javascript" src="js/jquery-u.js"></script><!-- jQuery Ui --> 
<script type="text/javascript" src="js/sourtin-jquery.js"></script><!-- sourtin Slider --> 
<script type="text/javascript" src="js/colortip.js"></script><!-- Colortip Tooltip Plugin  --> 
<script type="text/javascript" src="js/tytabs00.js"></script><!-- jQuery Plugin tytabs  --> 
<script type="text/javascript" src="js/jquery04.js"></script><!-- jQuery Prettyphoto  --> 
<script type="text/javascript" src="js/jquery06.js"></script><!-- UItoTop plugin  --> 
<script type="text/javascript" src="js/custom00.js"></script><!-- Custom Js file for javascript in html --> 
<script type="text/javascript" src="js/focus.js"></script><!-- text field clear --> 
<script src="js/cockies.js"></script> <!-- jQuery cookie --> 
<script src="js/styleswi.js"></script> <!-- Style Switcher -->


</body>
</html>
