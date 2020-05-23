<html>
<head>
   
<link rel="stylesheet" type="text/css" href="style.css"> 
<script>
function checkComment(){
// to edit blank comments
 var x = document.getElementsByName("comment");
  var i;
  for (i = 0; i < x.length; i++) {
    if (x[i].innerHTML = " ") {
      x[i].innerHTML = "No specific comment";
}
  }
}
</script>   
</head>
<body onload="checkComment()">
<?php

# ==== nav bar =====
include 'navbar.php';
# ==== create connection ====
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "classicmodels";

$conn=mysqli_connect("localhost", "root", "", "classicmodels"); 

# ==== check connection ====
if (mysqli_connect_error())
    {
    echo "<p class=\"error\">Error: MySQL server connection fail.</p>";
    die; 
    }
# === write sql qurey ===
$sql1 = "SELECT orderNumber, orderDate,status FROM orders WHERE status='In Process';";
$result1 = $conn->query($sql1);

$sql2 = "SELECT orderNumber, orderDate,status FROM orders WHERE status='Cancelled';";
$result2 = $conn->query($sql2);

$sql3 = "SELECT orderNumber, orderDate,status FROM orders ORDER BY orderDate DESC LIMIT 20;";
$result3 = $conn->query($sql3);

# === check connection====
if ($result1 === false) { 
    echo "<p class=\"error\">Error: There was a problem with the query sent to the database - please contact an administrator for further support.</p>";
    die; 
} else {
    if(isset($_GET['orderNumber'])){
        $productinfo=$_GET['orderNumber'];
        $detialtable="SELECT * 
        FROM products, orderdetails, orders
        WHERE products.productCode=orderdetails.productCode
        AND orderdetails.orderNumber=orders.orderNumber
        AND orders.orderNumber='$productinfo';";
        $sql4=mysqli_query($conn, $detialtable);
        if ($sql4 === false){
            echo "error";
        }
else{
        echo "<h2 class='center'>Order Details of Order Number:".$productinfo."</h2>";
        echo "<table id='details'>";
        echo "<tr>";
        echo "<th>Order Number</th>";
        echo "<th>Product Code</th>";
        echo "<th>Product Name</th>";
        echo "<th>Product Line</th>";
        echo "<th>Comments</th></tr>";
	
        while($row = mysqli_fetch_assoc($sql4)) {
            $number=$row['orderNumber'];
            $code=$row['productCode'];
            $name=$row['productName'];
            $line=$row['productLine'];
            $comments=$row['comments'];
            
            echo "<tr><td>".$number."</td>";
            echo "<td>".$code."</td>";
            echo "<td>".$name."</td>";
            echo "<td>".$line."</td>";
            echo "<td name='comment' id='comment'>".$comments."</td></tr>";
        }
    echo "</table>";
# ==== footer =====
    include 'footer.php';
    }
    }
    else{   
# === first table ===
        
        echo "<h2 class='center'>In Process Product Table</h2>";
        echo "<table id='page3'><tr><th>Order Number</th><th>Order Date</th><th>Order Status</th></tr>";
    while($row = mysqli_fetch_assoc($result1)) { 
        $number1=$row['orderNumber'];
        $date1=$row['orderDate'];
        $status1=$row['status'];
        
        echo "<tr><td><a href='"."Orders.php?orderNumber=".$number1."'>".$number1."</a></td><td>".$date1."</td><td>".$status1."</td></tr>";
    }
    echo "</table><br>";
# === second table ===
        
        echo "<h2 class='center'>Cancelled Product Table</h2>";
        echo "<table id='page3'><tr><th>Order Number</th><th>Order Date</th><th>Order Status</th></tr>";
    while($row = mysqli_fetch_assoc($result2)) { 
        $number2=$row['orderNumber'];
        $date2=$row['orderDate'];
        $status2=$row['status'];
        
        echo "<tr><td><a href='"."Orders.php?orderNumber=".$number2."'>".$number2."</a></td><td>".$date2."</td><td>".$status2."</td></tr>";
    }
    echo "</table><br>";
# === third table ====
        
        echo "<h2 class='center'>20 Most Recent Product Table</h2>";
        echo "<table id='page3'><tr><th>Order Number</th><th>Order Date</th><th>Order Status</th></tr>";
    while($row = mysqli_fetch_assoc($result3)) { 
        $number3=$row['orderNumber'];
        $date3=$row['orderDate'];
        $status3=$row['status'];
        
        echo "<tr><td><a href='"."Orders.php?orderNumber=".$number3."'>".$number3."</a></td><td>".$date3."</td><td>".$status3."</td></tr>";
    }
    echo "</table><br>";
# ==== footer =====
    include 'footer.php';
        
}
}


?>
</body>
</html>