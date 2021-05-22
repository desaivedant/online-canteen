<html>
<?php

//Connect to mysql server
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
$result=mysql_query("SELECT * FROM food_mst,catg_mst WHERE food_mst.CAT_ID=catg_mst.CAT_ID ")
or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
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
        $result=mysql_query("SELECT * FROM food_mst,catg_mst WHERE CAT_ID='$id' AND food_mst.CAT_ID=catg_mst.CAT_ID ")
        or die("A problem has occured ... \n" . "Our team is working on it at the moment ... \n" . "Please check back after few hours."); 
    }
?>
<h1>CHOOSE YOUR FOOD</h1>
 <hr>
 <h3>Note: limit the food zone by selecting a category below:</h3>
 <form name="categoryForm" id="categoryForm" method="post" action="food_cat.php">
     <table width="360" align="center">
     <tr>
        <td>Category</td>
        <td width="168"><select name="category" id="category">
        <option value="select">- select category -
        <?php 
        //loop through categories table rows
        while ($row=mysql_fetch_array($categories)){
        echo "<option value=$row[CAT_ID]>$row[cat_name]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Submit" value="Show Foods" /></td>
     </tr>
     </table>
<table width="860" height="auto" style="text-align:center;">
        <tr>
                <th>Food Photo</th>
                <th>Food Name</th>
                <th>Food Description</th>
                <th>Food Category</th>
                <th>Food Price</th>
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
                    echo '<td><a href=images/'. $row['images_path']. ' alt="click to view full image" target="_blank"><img src=images/'. $row['images_path']. ' width="80" height="70"></a></td>';
                    echo "<td>" . $row['name']."</td>";
                    echo "<td>" . $row['description']."</td>";
                    echo "<td>" . $row['cat_name']."</td>";
                    echo "<td>" . $row['price']."</td>";
                    echo "</td>";
                    echo "</tr>";
                    }      
                }
            mysql_free_result($result);
            mysql_close($link);
        ?>
      </table>
</html>