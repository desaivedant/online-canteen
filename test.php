<?php
session_start();
error_reporting(0);
include("connect.php");

$p_dd = $_GET["id"];

$sql = "select * from cust_mst where CU_ID='$user_profile'";
$cmd = mysqli_query($con,$sql) or die(mysql_error());
$res = mysqli_fetch_array($cmd);

$sql1 = "select * from food_mst where F_ID='$p_dd'";
$cmd1 = mysqli_query($con,$sql1) or die(mysql_error());
$res1 = mysqli_fetch_array($cmd1);

$sql2 = "select * from cart_master";
$cmd2 = mysqli_query($con,$sql2) or die(mysql_error());

$total="0";
$qty="1";

$uid = $res[0];
$ttotal=0;


	$uid = $res[0];
	$ttotal = 0;

	$pid = $res1[0];
	//$psize = $_POST['ssize'];
	$pprice = $res1[5];	
	
	$pdis = "0";
	$sql987 = "select * from food_mst where F_ID='$pid'";
	$cmd987 = mysqli_query($con,$sql987) or die(mysql_error());
	$res987 = mysqli_fetch_array($cmd987);
	$pdis = $res987[2];
	$fdis = $pprice * $pdis / 100;
	$fprice = $pprice - $fdis;
	$pt =($qty * $fprice);
$res31 = mysqli_query($con,"select * from cart_master where u_id='$uid'");
if(mysqli_num_rows($res31)>0)
{
	while($res2=mysqli_fetch_array($cmd2))
	{						
		if($res2[1]==$res['u_id'])
		{
			$ccid=$res2[0];
			
			$res66 = mysqli_query($con,"select * from cart_detail where p_id='$p_dd' and cart_id='$ccid'");
			if(mysqli_num_rows($res66)>0)
			{
				
				$query1 = "select * from cart_detail where p_id='$p_dd' and cart_id='$ccid'";
				$res8 = mysqli_query($con,$query1);
				$pto = "0";
				while($a = mysqli_fetch_array($res8))
				{
					$aa = $a[3];
					$bb = $a[2];
				}
				$qtyy = "1" + $aa;
				$pto = $pto + ($qtyy * $bb);
				
				$query = "update cart_detail set p_qty='$qtyy',p_t_amt='$pto' where p_id='$p_dd'";
				$res7 = mysqli_query($con,$query);
				echo "<script type='text/javascript'>";
				//echo "alert('qty added');";
				echo "window.location.href='cart.php';";
				echo "</script>";
			}
			else
			{
				$res222 = mysqli_query($con,"insert into cart_detail values($ccid,$pid,$fprice,$qty,$pt)");
				if($res222 =="1")
				{
					echo "<script type='text/javascript'>";
					//echo "alert('add to cart succefully');";
					echo "window.location.href='cart.php';";
					echo "</script>";
				}
				else
				{
					echo "<script type='text/javascript'>";
					//echo "alert('check details!!!');";
					echo "window.location.href='index2.php';";
					echo "</script>";
				}
			}
		}
	}
}
else
{
	$ress11 = mysqli_query($con,"select max(cart_id) from cart_master");
	$ccid=0;
	while($rr1=mysqli_fetch_row($ress11))
	{
		$ccid=$rr1[0];
	}
	$ccid++;
	$ress2 = mysqli_query($con,"insert into cart_master values($ccid,$uid,$ttotal)");
	if($ress2=="1")
	{
		$res222 = mysqli_query($con,"insert into cart_detail values($ccid,$pid,$fprice,$qty,$pt)");
		if($res222 =="1")
		{
			echo "<script type='text/javascript'>";
			//echo "alert('add to cart succefully');";
			echo "window.location.href='cart.php';";
			echo "</script>";
		}
		else
		{
			echo "<script type='text/javascript'>";
			//echo "alert('check details!!!');";
			echo "window.location.href='index2.php';";
			echo "</script>";
		}
	}
	else
	{
		echo "<script type='text/javascript'>";
		//echo "alert('check details!!!');";
		echo "window.location.href='index2.php';";
		echo "</script>";
	}
}
mysql_close();
?>
