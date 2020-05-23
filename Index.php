<html>
<head>
 <!--- 
this project has three main php file, one navbar file and one footer
the javascript written in the Orders.php
the Css file is writen externally.

---> 
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

$conn=mysqli_connect("localhost", "root", "", "classicmodels"); 

# ==== check connection ====
if (mysqli_connect_error())
    {
    echo "<p class=\"error\">Error: MySQL server connection fail.</p>";
    die; 
    }
$sql = "SELECT productLine, textDescription FROM productlines";
$result = $conn->query($sql);
if ($result === false) { 
    
    echo "<p class=\"error\">Error: There was a problem with the query sent to the database - please contact an administrator for further support.</p>";
    die; 
} else {
    if(isset($_GET['product'])){
// new table that shows the detials of specific product line
        $productinfo=$_GET['product'];
        $detialtable="SELECT * FROM products WHERE productLine='$productinfo';";
        $sql2=mysqli_query($conn, $detialtable);
        if ($sql2 === false){
            echo "<p class=\"error\">Error: MySQL server connection fail.</p>";
        }
else{
        echo "<h2 class='center'>".$productinfo."</h2>";
        echo "<table id='page1'>";
        echo "<tr>";
        echo "<th>MSRP</th>";
        echo "<th>Product Code</th>";
        echo "<th>Product Name</th>";
        echo "<th>Product Scale</th>";
        echo "<th>Product Vendor</th>";
        echo "<th>Price</th>";
        echo "<th>Quantity In Stock</th></tr>";
        
        while($row = mysqli_fetch_assoc($sql2)) {
            $msrp=$row['MSRP'];
            $code=$row['productCode'];
            $name=$row['productName'];
            $scale=$row['productScale'];
            $vendor=$row['productVendor'];
            $stock=$row['quantityInStock'];
            $price=$row['buyPrice'];
            
            echo "<tr><td>".$msrp."</td>";
            echo "<td>".$code."</td>";
            echo "<td>".$name."</td>";
            echo "<td>".$scale."</td>";
            echo "<td>".$vendor."</td>";
            echo "<td>".$stock."</td>";
            echo "<td>".$price."</td></tr>";
        }
    echo "</table>";
# ==== footer =====
    include 'footer.php';
    }
    }
    else{
        echo "<h2 class='center'>Product Line Table</h2>";
            echo "<table>
            <tr>
            <th>Product Line</th>
            <th>Text Description</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result)) { 
//original table shows the productline description
//by clicking the productline, a new table will show
        $productline=$row['productLine'];
        $description=$row['textDescription'];
        echo "<tr><td><a href='"."Index.php?product=".$productline."'>".$productline."</a></td><td>".$description."</td></tr>";
    }
    echo "</table>";
# ==== footer =====
    include 'footer.php';
}
}

?>

</html>