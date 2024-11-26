<?php
 include('DBClass.php');
 $db = new DBClass();

 if(isset($_POST['sale']))
 {
    $id = $_POST['id'];
    $bill = $_POST['billno'];
     $product = $_POST['productName'];
     $hsn = $_POST['hsn'];
     $qty = $_POST['qty'];
     $rate = $_POST['rate']; 
     $per = $_POST['per'];

   
        $query = "UPDATE sale_products SET productName = '" . $product . "', ";
        $query .= "hsn = '". $hsn . "', ";
        $query .= "qty = ". $qty . ", ";
        $query .= "rate = ". $rate . ", ";
        $query .= "per = '". $per . "' ";
        $query .= "WHERE id =". $id;
        // print_r($query);
        // exit();
        $db->executequery($query);
        header("Location:sale_invoice.php");
   
 }
?>