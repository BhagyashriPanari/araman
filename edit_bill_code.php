<?php
 include('DBClass.php');
 $db = new DBClass();

 if(isset($_POST['submit']))
 {
    $bill = $_POST['bill'];
    $date = $_POST['sale_date'];
    $billno = $_POST['billno'];
    $address = $_POST['address'];
    $customer = $_POST['customer_name'];
    $gstno = $_POST['gstno'];
    //  $product = $_POST['productName'];
    //  $hsn = $_POST['hsn'];
    //  $qty = $_POST['qty'];
    //  $rate = $_POST['rate']; 
    //  $per = $_POST['per'];

   
        $query = "UPDATE sale_products SET sale_date = '" . $date . "', ";
        $query .= "billno = ". $billno . ", ";
        $query .= "customer_name = '". $customer . "', ";
        $query .= "address = '". $address . "', ";
        $query .= "gstno = '". $gstno . "' ";
        // $query .= "productName = '". $product . "', ";
        // $query .= "productName = '". $product . "', ";
        // $query .= "hsn = '". $hsn . "', ";
        // $query .= "qty = ". $qty . ", ";
        // $query .= "rate = ". $rate . ", ";
        // $query .= "per = '". $per . "' ";
        $query .= "WHERE billno =". $bill;
        // print_r($query);
        // exit();
        $db->executequery($query);
        header("Location:sale_invoice.php");
   
 }
?>