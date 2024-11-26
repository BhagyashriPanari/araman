<?php
include('DBClass.php');
$db = new DBClass();

if(isset($_POST['submit']))
{
    $date = $_POST['date'];
    $supplier = $_POST['supplier'];
    $product = $_POST['productName'];
    $hsn = $_POST['hsn'];
    $qty = $_POST['qty'];
    $rate = $_POST['rate'];
    $total = $_POST['total'];

    $query = "INSERT INTO `purchase`(`date`, `supplier`, `productName`, `hsn`, `qty`, `rate`, `total`) ";
    $query .= "VALUES('".$date."','".$supplier."','".$product."',".$hsn.",".$qty.",".$rate.",".$total.")";
    $db->executequery($query);

    $query = "SELECT * FROM product_list WHERE name='$product'";
    $result = $db->getdata($query);
    $row = mysqli_fetch_assoc($result);
    $qtyy = 0;
    $qty1 = 0;
    $qtyy = $row['available'];
    $qty1 = ($qty + $qtyy);
    $query = "UPDATE product_list SET available = " . $qty1 . " ";
    $query .= "WHERE name = '$product'";
   
    
    $db->executequery($query);

    header("Location:purchase.php");


}
?>