<?php
include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php');
}
?>
<?php
$id = $conn->real_escape_string($_POST['category_id']);
$name = $conn->real_escape_string($_POST['category_name']);

$query = "INSERT INTO catg_mst(category_id,category_name) VALUES('" . $id . "','" . $name . "')";
$success = $conn->query($query);
if (!$success){
	die("Couldnt enter data: ".$conn->error);
}
$conn->close();
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Admin Login | Stop My Starvation </title>
  </head>
  <link rel="stylesheet" type = "text/css" href ="css/add_food_items.css">
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
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?> </a></li>
            <li class="active"> <a href="managerlogin.php">Admin CONTROL PANEL</a></li>
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
			<a href="add_food_category.php" class="list-group-item active">Add Food Category</a>
			<a href="edit_category_items.php" class="list-group-item">Edit Category Items</a>
    		<a href="edit_food_items.php" class="list-group-item">Edit Food Items</a>
    		<a href="delete_food_items.php" class="list-group-item ">Delete Food Items</a> 
			<a href="report_food.php" class="list-group-item">Food Report</a>	
			<a href="feedback_m.php" class="list-group-item">User Feedback</a>	
			<a href="view_user.php" class="list-group-item">All Users</a>				
    	</div>
    </div>
    <div class="col-xs-9">
      <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="add_food_items.php" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> ADD NEW FOOD ITEM HERE </h3>
          <div class="form-group">
            <input type="text" class="form-control" id="id" name="id" placeholder="Your Category ID" required="">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Your Category Name" required="">
          </div>

          <div class="form-group">
          <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right"> ADD CATEGORY </button>
      </div>
        </form>
        </div>
    </div>
</div>
  </body>
</html>
