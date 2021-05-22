<?php
include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php'); 
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title> Admin Login | Stop My Starvation </title>
  </head>
  <link rel="stylesheet" type = "text/css" href ="css/edit_food_items.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function display_alert()
    {
      alert("Data Updated Successfully...!!!");
    }
  </script>
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
     <p>Manage all your Categories from here</p>
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
    		<a href="add_food_items.php" class="list-group-item ">Add Food Items</a>
						<a href="add_food_category.php" class="list-group-item">Add Food Category</a>
    		<a href="edit_food_items.php" class="list-group-item">Edit Food Items</a>
			<a href="edit_category_items.php" class="list-group-item active">Edit Category Items</a>
    		<a href="delete_food_items.php" class="list-group-item ">Delete Food Items</a> 
			<a href="report_food.php" class="list-group-item">Food Report</a>	
			<a href="feedback_m.php" class="list-group-item">User Feedback</a>	
			<a href="view_user.php" class="list-group-item">All Users</a>	
    	</div>
    </div>
<div class="col-xs-3">
  <div class="form-area" style="padding: 10px 10px 110px 10px; "> 
    <div style="text-align: center;">
      <h3>Click On Menu <br><br></h3>
    </div>
    <?php   
    if (isset($_GET['submit'])) {
    $F_ID = $_GET['dfid'];
    $name = $_GET['dname'];

    $query = mysqli_query($conn, "UPDATE catg_mst set
    category_id='$F_ID', category_name='$name'");
    }
    $query = mysqli_query($conn, "SELECT * FROM catg_mst ORDER BY category_id");
    while ($row = mysqli_fetch_array($query)) {
      ?>
      <div class="list-group" style="text-align: center;">
        <?php
      echo "<b><a href='edit_category_items.php?update= {$row['category_id']}'>{$row['category_name']}</a></b>";  
        ?>
      </div>
    <?php
    }
    ?>
    <?php
    if (isset($_GET['update'])) {
    $update = $_GET['update'];
    $query1 = mysqli_query($conn, "SELECT * FROM catg_mst WHERE category_id=$update");
    while ($row1 = mysqli_fetch_array($query1)) {
    ?>
</div>
</div>
<div class="container">
<div class="col-md-6">
 <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="edit_category_items.php" method="GET">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> EDIT YOUR CATEGORY HERE </h3>

          <div class="form-group">
            <input class='input' type='hidden' name="dfid" value=<?php echo $row1['category_id'];  ?> />
          </div>

          <div class="form-group">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Category ID: </label>
            <input type="text" class="form-control" id="dcid" name="dcid" value=<?php echo $row1['category_id'];  ?> placeholder="Your Category ID" required="">
          </div>     

          <div class="form-group">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Category Name: </label>
            <input type="text" class="form-control" id="dname" name="dname" value=<?php echo $row1['category_name'];  ?> placeholder="Your Category Name" required="">
          </div>
		  


          <div class="form-group">
          <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right" onclick="display_alert()" value="Display alert box" > Update </button>    
      </div>
        </form>
    <?php
}
}
  ?>     
  </div>
</div>
<?php
mysqli_close($conn);
?>
</div>
</div>
  </body>
<br>
</html>