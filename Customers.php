<html>
<head>
   
<link rel="stylesheet" type="text/css" href="style.css"> 
    
</head>

<?php

# ==== nav bar =====
include 'navbar.php';

# ==== create connection ====  
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "classicmodels";

$conn = new mysqli($servername, $username, $password, $dbname);
# ==== check connection ====
if ($conn->connect_error) {
    echo "Error: Cannot connect to the database!";
    die("Connection failed: " . $conn->connect_error);
    } 
# === edit qurey ===
$sql = "SELECT customerName, city, country, phone FROM customers ORDER BY country";
$result=$conn->query($sql);

# === test connection ====
if($result === false){
    echo "Error: Cannot sent query!";
    die;
} else {
    echo "<h2 class='center'>Ordered Customer Table</h2>";
    echo "<table id='page2'><tr><th>Customer Name</th>";
    echo "<th>City</th>";
    echo "<th>Country</th>";
    echo "<th>Telephone Number</th></tr>";
    
    while ($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row["customerName"]."</td>";
        echo "<td>".$row["city"]."</td>";
        echo "<td>".$row["country"]."</td>";
        echo "<td>".$row["phone"]."</td>";
    }
    echo "</table>";
# ==== footer =====
    include 'footer.php';
}

?>
</html>