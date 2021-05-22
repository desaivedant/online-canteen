<?php
session_start();
$con = mysql_connect("localhost","root","");
mysql_select_db("shoping", $con);
$v1=0;
$f=0;
if(!isset($_SESSION['crt']))
{
$msg="There are no items in your cart";
}
if(isset($_POST['b1']))
{
	$crt=$_SESSION['crt'];
	$usr=$_SESSION['usr'];
	$res=mysql_query("select max(sal_id) from sal_mast",$con);
	$rows=mysql_fetch_array($res);
	$n=mysql_num_rows($res);

	if($n>0)
	{
	$v1=$rows[0];
	$v1++;
	}
	else
	{
	$v1=1;
	}	

	$result=mysql_query("select * from cart_mast where cart_is=$crt",$con);
	$r=mysql_fetch_array($result);
	$namt=$r[3];
	$d=date('Y-m-d');
	mysql_query("insert into sal_mast values($v1,'$d','".$_SESSION['usr']."',$namt)",$con);

	$res2=mysql_query("select * from cart_details where cart_id='$crt'",$con);
	while($rs=mysql_fetch_array($res2))
	{
	$v2=$rs[1];
	$v3=$rs[2];
	$v4=$rs[3];
	$v5=$rs[4];
	$sql="insert into sal_details values($v1,$v2,$v3,$v4,$v5)";
	//echo $sql;
	mysql_query($sql,$con);
	header('location:buy.php?sis='.$v1);
	}
}
else
{
$cid=$_GET['cid'];
$pid=$_GET['pid'];
$res=mysql_query("Select * from cart_details where cart_id='$cid' and p_id='$pid'",$con);
$r=mysql_fetch_array($res);
$amt=$r[4];
$cmd=mysql_query("delete from cart_details where cart_id='$cid' and p_id='$pid'",$con);
mysql_query("update cart_mast set amount=amount-$amt where cart_is='$cid'",$con);
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
	<td width="25%" valign="top">
	
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
								
	</td>
	
<td width="80%" valign="top">
<form method="post" action="#" enctype="multipart/form-data">
<?php 
$res1=mysql_query("select * from cart_mast where cart_is=".$_SESSION['crt'],$con);
$rw=mysql_fetch_array($res1);
$res2=mysql_query("select * from cart_details where cart_id=".$_SESSION['crt'],$con);
$rw1=mysql_fetch_array($res2);
?>
<table width="80%" border=0>
<tr>
<td>Cart Id</td>
<td><?php echo $rw[0];?></td>
</tr>
<tr>
<td>Cart Date</td>
<td><?php echo $rw[1];?></td>
</tr>
<tr>
<td>User Name</td>
<td><?php echo $_SESSION['usr'];?></td>
</tr>
<tr>
<td>Amount</td>
<td><?php echo $rw[3];?></td>
</tr>
</tr>
</table>
<br><br>
<font color="red">
<?php echo $msg; ?></font>
<br>

<br>
<!----- cart Details -->

<div style="margin: 0; padding: 0; border-collapse: collapse; width:700px; height: 300px; overflow: hidden; border: 1px solid black;">

<table style="margin: 0; padding: 0; border-collapse: collapse; color: White; width: 700px; height: 20px; text-align: left; background-color:#660000;">
<colgroup>
<col width="80px"/>
<col width="50px"/>
<col width="150px"/>
<col width="105px"/>
<col width="60px"/>
<col width="10px"/>
</colgroup>
<tbody>
<tr style="margin: 0; padding: 0; border-collapse: collapse;">
<th style="margin: 0; padding: 0; border-collapse: collapse;">
Delete
</th>
<th style="margin: 0; padding: 0; border-collapse: collapse;">
Id
</th>
<th style="margin: 0; padding: 0; border-collapse: collapse;">
Name
</th>

<th style="margin: 0; padding: 0; border-collapse: collapse;">
Price
</th>
<th style="margin: 0; padding: 0; border-collapse: collapse;">
 Qty
</th>
<th style="margin: 0; padding: 0; border-collapse: collapse;">
 Amount
</th>
<th style="margin: 0; padding: 0; border-collapse: collapse;">
 &nbsp;&nbsp;&nbsp;Image
</th>

</tr>
</tbody>
</table>

<div style="margin: 0; padding: 0; border-collapse: collapse; width: 700px; height: 300px; overflow: auto;">
<table style="margin: 0; padding: 0; border-collapse: collapse; width: 700px;">
<colgroup>
<col width="65px"/>
<col width="50px"/>
<col width="150px"/>
<col width="100px"/>
<col width="65px"/>
<col width="65px"/>

</colgroup>
<tbody style="margin: 0; padding: 0; border-collapse: collapse;">
<?php 
$rr=mysql_query("select * from cart_details where cart_id=".$_SESSION['crt'],$con);

while($r1=mysql_fetch_array($rr))
{
?>
<tr style="margin: 0; padding: 0; border-collapse: collapse;">
<td>
<a href="?cid=<?php echo $r1[0];?>&pid=<?php echo $r1[1];?>">
Delete
</a></td>
<td style="border: 1px solid lightgrey;">
<?php echo $r1[1];?></td>
<td style="border: 1px solid lightgrey;">
<?php 
$res2=mysql_query("select * from product where p_id=".$r1[1],$con);
$rs=mysql_fetch_array($res2);
?>
<?php echo $rs[1];
$t1=$rs[0];
$t2=$rs[1]; ?>

</td>
<td style="border: 1px solid lightgrey;">
<?php echo $r1[2];?>
</td>
<td style="border: 1px solid lightgrey;">
<?php echo $r1[3];?>
</td>
<td style="border: 1px solid lightgrey;">
<?php echo $r1[4];?>
</td>
<td style="border: 1px solid lightgrey;">
<a href="?iid=<?php echo $r1[0];?>" ><img src="<?php echo $rs[5];?>" width=50 height=50/></a>
</td>
</tr>
<?php } ?>

</tbody>
</table>
</div>

</div>

<!-- End Cart Details -->
<br/>
<a href="home.php" style="text-decoration:none;">
<input type="button" name="b2" id="b2" value="Continue shopping" class="sendbtn"/>
</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="buy.php?sid='$v1'" style="text-decoration:none;">

<input type="submit" name="b1" value="Confirm to Order" class="sendbtn"/></a>

</tr>
</center>
</table>
</form>


<br><br>
<br><br>
<br><br>
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
