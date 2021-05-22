<?php
include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php'); 
}
include("connect.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Admin Login | Stop My Starvation </title>
  </head>
  <link rel="stylesheet" type = "text/css" href ="css/view_order_details.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <body>
    <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
    <script type="text/javascript">
      window.onscroll = function()
      {
        scrollFunction()
      };
      function scrollFunction(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("myBtn").style.display = "block";
        } else {
          document.getElementById("myBtn").style.display = "none";
        }
      }
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>
    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Stop My Starvation</a>
        </div>
        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>
            <li><a href="feedback_m.php">FeedBack</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?> </a></li>
            <li class="active"> <a href="managerlogin.php">ADMIN CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
        </div>
      </div>
    </nav>
<div class="container">
    <div class="jumbotron">
     <h1>Hello Admin! </h1>
    </div>
    </div>
<div class="container">
    <div class="container">
    	<div class="col"> 		
    	</div>
    </div>  
    	<div class="col-xs-3" style="text-align: center;">
    	<div class="list-group">
			<a href="view_order_details.php" class="list-group-item">View Order Details</a>
    		<a href="view_food_items.php" class="list-group-item">View Food Items</a>
    		<a href="add_food_items.php" class="list-group-item">Add Food Items</a>
    		<a href="edit_food_items.php" class="list-group-item">Edit Food Items</a>
    		<a href="delete_food_items.php" class="list-group-item">Delete Food Items</a> 
			<a href="report_food.php" class="list-group-item active">Food Report</a>	
			<a href="feedback_m.php" class="list-group-item">User Feedback</a>
			<a href="view_user.php" class="list-group-item">All Users</a>
    	</div>
    </div>   
    <div class="col-xs-9">
      <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> YOUR FOOD REPORT </h3>
<html>
  <head> 		
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Food Category', 'Food Item'],          
		  <?php  
		  $query = "SELECT category_name,food_category FROM catg_mst,food_mst WHERE food_mst.food_category = catg_mst.category_id"; 
 		$result = mysqli_query($con, $query); 
                          while($row = mysqli_fetch_array($result))  
                          {  
		$cmd444=mysqli_query($con,"SELECT count(food_category) from catg_mst,food_mst where category_id=".$row['food_category']."");
		$res444=mysqli_fetch_array($cmd444);
		$sub_cat=$res444[0];
				//echo "['".$row["cat_type"]."','".$row["cat_type"]."'],"; //varchar_varchar
                               echo "['".$row["category_name"]."', ".$sub_cat."],";        //varchar_int
				//echo "[".$row2[0].",".$row2[1]."],";                      //int_int				
                          }  
                          ?> 	  
        ]);
        var options = {
          title: 'Food Report By Category'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
        </form>      
        </div>  
    </div>
</div>
<br>
<br>
<br>
<br>
  </body>
</html>