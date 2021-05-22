<?php
session_start();
if(!isset($_SESSION['login_user2'])){
header("location: customerlogin.php");
}
?>
<html>
  <head>
    <title> Explore |Stop My Starvation</title>
  </head>
  <link rel="stylesheet" type = "text/css" href ="css/foodlist.css">
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
          <a class="navbar-brand" href="index.php">Stop My starvation</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>
            <li><a href="contactus.php">Feedback</a></li>
          </ul>
          <?php
          if(isset($_SESSION['login_user1'])){
          ?>
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user1']; ?> </a></li>
                      <li><a href="myrestaurant.php">MANAGER CONTROL PANEL</a></li>
                      <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
                    </ul>
          <?php
          }
          else if (isset($_SESSION['login_user2'])) {
            ?>
                     <ul class="nav navbar-nav navbar-right">
                      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
                      <li><a href="foodzone.php"><span class="glyphicon glyphicon-cutlery"></span> Food Zone </a></li>
                      <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart  (<?php
                        if(isset($_SESSION["cart"])){
                        $count = count($_SESSION["cart"]);
                        echo "$count";
                      }
                        else
                          echo "0";
                        ?>) </a></li>
                      <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
                    </ul>
            <?php
          }
          else {
            ?>
<ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="customersignup.php"> User Sign-up</a></li>
              <li> <a href="managersignup.php"> Manager Sign-up</a></li>

            </ul>
            </li>

            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li> <a href="customerlogin.php"> User Login</a></li>
              <li> <a href="managerlogin.php"> Manager Login</a></li>

            </ul>
            </li>
          </ul>

<?php
}
?>
        </div>
      </div>
    </nav>
<div class="jumbotron">
  <div class="container text-center">
    <h3>Here is our foodzone.</h3>
    <!--p>Let food be thy medicine and medicine be thy food</p-->
  </div>
</div>
<?php

    $link = mysql_connect("localhost","root","");
    if(!$link) {
        die('Failed to connect to server: ' . mysql_error());
    }

    //Select database
    $db = mysql_select_db("canteen");
    if(!$db) {
        die("Unable to select database");
    }

//selecting all records from the food_details table. Return an error if there are no records in the table
$result=mysql_query("SELECT * FROM food_mst,catg_mst WHERE food_mst.food_category=catg_mst.category_id ")
or die(mysql_error());
?>
<?php
    //retrive categories from the categories table
    $categories=mysql_query("SELECT * FROM catg_mst")
    or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours.");
?>

<?php
    if(isset($_POST['Submit'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysql_real_escape_string($str);
        }
        //get category id
        $id = clean($_POST['category']);

        //selecting all records from the food_details and categories tables based on category id. Return an error if there are no records in the table
        $result=mysql_query("SELECT * FROM food_mst,catg_mst WHERE food_category='$id' AND food_mst.food_category=catg_mst.category_id ")
        or die(mysql_error());
    }
?>
<form name="categoryForm" id="categoryForm" method="post" action="foodzone.php" onsubmit="return categoriesValidate(this)">
     <table width="360" align="center">
     <tr>
        <td>Category</td>
        <td width="168"><select name="category" id="category">
        <option value="select">- select category -
        <?php
        //loop through categories table rows
        while ($row=mysql_fetch_array($categories)){
        echo "<option value=$row[category_id]>$row[category_name]";
        }
        ?>
        </select></td>
        <td><input type="submit" name="Submit" value="Show Foods" /></td>
     </tr>
     </table>
 </form>
 <center>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
      <table width="auto" height="auto" style="text-align:center;">
	  <center>
        <tr>
                <th>Food Name</th>
                <th><br></th>
                <th>Food Description</th>
                <th><br></th>
                <th>Food Category</th>
                <th><br></th>
                <th>Food Price</th>
                <th><br></th>
                <th>Action(s)</th>
        </tr>
        <?php
            $count = mysql_num_rows($result);
            if(isset($_POST['Submit']) && $count < 1){
                echo "<html><script language='JavaScript'>alert('There are no foods under the selected category at the moment. Please check back later.')</script></html>";
            }
            else{
                //loop through all table rows
                //$counter = 3;
                while ($row=mysql_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . $row['name']."</td>";
                    echo "<td><br> </td>";
                    echo "<td>" . $row['description']."</td>";
                    echo "<td><br> </td>";
                    echo "<td>" . $row['category_name']."</td>";
                    echo "<td><br> </td>";
                    echo "<td>" . $row['price']."</td>";
                    echo "<td><br> </td>";
					          echo '<td><h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
                    <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>
                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>
                    <input type="hidden" name="hidden_RID" value="<?php echo $row["food_categoey"]; ?>
                    </td><td><input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart"></td>';
					          echo "</tr>";
                    }
                }
            mysql_free_result($result);
            mysql_close($link);
        ?>
		<?php
			$count++;
			if($count==4)
			{
				echo "</div>";
				$count=0;
			}
		?>
		</tr>
		 </center>
      </table>
  </div>
  </center>
</div>
</body>
</html>
