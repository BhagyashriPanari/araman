<?php
 include('DBClass.php');
 $db = new DBClass();

 if(isset($_POST['submit']))
 {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $supplier = $_POST['supplier'];
    $product = $_POST['productName'];
    $hsn = $_POST['hsn'];
    $qty = $_POST['qty'];
     $rate = $_POST['rate'];

    if($id != 0)
    {
        $query = "UPDATE purchase SET date = '" . $date . "', ";
        $query .= "supplier = '". $supplier . "', ";
        $query .= "productName = '". $product . "', ";
        $query .= "hsn = '". $hsn . "', ";
        $query .= "qty = ". $qty . ", ";
        $query .= "rate = ". $rate . " ";
        $query .= "WHERE id =". $id;
        // print_r($query);
        // exit();
        $db->executequery($query);
        header("Location:purchase_list.php");
    }
 }
?>