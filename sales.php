<?php include('includes/header.php');

include('DBClass.php');
$db = new DBClass();
 
$bill = "";
$billno ="";
$billdate = "";
$product = "";
$hsn = "";
$per = "";
$qty = null;
$rate = null;

$id = 0;
$mode = "";
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    
        $query = "SELECT * FROM sale_products WHERE id=" . $id;
        $result = $db->getdata($query);
        $row = mysqli_fetch_assoc($result);
        $billno = $row['billno'];
        $billdate = $row['sale_date'];
        $product = $row['productName'];
        $hsn = $row['hsn'];
        $per = $row['per'];
        $qty = $row['qty'];
        $rate = $row['rate'];
  
  
}
?>

<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
                <div class="card-header bg-secondary">
						<span style="color:white;"><b>Sale Invoice</b></span>
					</div><br>
                      <div class="card-body">
                      <form action="sales.php" method="POST">
                          <input type="hidden" name="id" value="<?=$id;?>">
						  <div class="row">
                              <div class="col-3">
                                 <label for=""><strong> Bill No</strong></label>
								 <input type="text" name="billno" autocomplete="of" value="<?=$billno;?>" class="form-control" required><br>
							  </div>
							  <div class="col-3">
                                 <label for=""><strong>Bill Date</strong></label>
								 <input type="date" name="sale_date" autocomplete="of" value="<?=$billdate;?>" class="form-control" required><br>
							  </div>
						  </div>
							<div class="row">
								<div class="col-3">
									<label for=""><strong>Select Product</strong></label>
                                        <select name="productName" id="product" onchange="myFunction1()" class="form-control">
                                        <option  value="<?=$product;?>"><?=$product;?></option>
                                            <?php
                                                $query = "SELECT * FROM product_list order by name asc";
                                                $result = $db->getdata($query);
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    ?>
                                                    <option value="<?=$row['name'];?>"data-name="<?php echo $row['name'] ?>" data-gst="<?php echo $row['gst'] ?>" data-per="<?php echo $row['per'] ?>" data-hsn="<?php echo $row['hsn'] ?>"><?php echo $row['name']?></option>
                                                    <?php
                                                }
                                            ?>
                                        
                                        </select>
								</div>
								<input type="hidden" name="gst" id="gst">
								<div class="col-3">
									<label for=""><strong>HSN</strong></label>
									<input type="text" name="hsn" id="hsn" value="<?=$hsn;?>" readonly="true" class="form-control" required>
								</div>
							<div class="col-2">
									<label for=""><strong>Per/Kg</strong></strong></label>
									<select name="per" class="form-control">
                                        <option value="BOX">BOX</option>
                                        <option value="TIN">TIN</option>
                                        <option value="Piece">Piece</option>
                                        <option value="KG">KG</option>
                                    </select>
								</div>
								<div class="col-2">
									<label for=""><strong>Qty</strong></label>
									<input type="text" name="qty" autocomplete="of" value="<?=$qty;?>" class="form-control" required>
								</div>
								<div class="col-2">
									<label for=""><strong>Rate</strong></label>
									<input type="text" name="rate" autocomplete="of" value="<?=$rate;?>" class="form-control" required>
								</div>
								
							</div><br>
							<input type="submit" name="submit" style="float:right;" value="Add To List" class="btn btn-success btn-sm">
						</form>
						
					</div>
                    <?php
                    
                                    if(isset($_POST['submit']))
                                    {
                                       
                                    $id = $_POST['id'];
                                    $billno = $_POST['billno'];
                                    $billdate = $_POST['sale_date'];
                                    $product = $_POST['productName'];
                                    $qty = $_POST['qty'];
                                    $rate = $_POST['rate'];
                                    $hsn = $_POST['hsn'];
                                    $gst = $_POST['gst'];
                                    $per = $_POST['per'];

                                    if($id == 0)
                                    {
                                    $query = "INSERT INTO `sale_products`(`productName`, `hsn`, `qty`, `rate`, `billno`, `sale_date`, `gst`, `per`) ";
                                    $query .="VALUES('".$product."',".$hsn.",".$qty.",".$rate.",'".$billno."','".$billdate."',".$gst.",'".$per."')";
                                    //   print_r($query);
                                    //   exit();
                                    $db->executequery($query);
                                    }
                                    else{
                                        $query = "UPDATE sale_products SET productName = '" . $product . "', ";
                                        $query .= "qty = " . $qty . ", ";
                                        $query .= "rate = " . $rate . ", ";
                                        $query .= "billno = '" . $billno . "', ";
                                        $query .= "sale_date = '" . $billdate . "', ";
                                        $query .= "hsn = '" . $hsn . "', ";
                                        $query .= "per = '" . $per . "' ";
                                        $query .= "WHERE id = " .$id;
                                        $db->executequery($query);
                                    }
                                    $query = "SELECT * FROM product_list WHERE name='$product'";
                                        $result = $db->getdata($query);
                                        $row = mysqli_fetch_assoc($result);
                                        $qtyy = 0;
                                        $qty1 = 0;
                                        $qtyy = $row['available'];
                                        $qty1 = ($qtyy - $qty);
                                        $query = "UPDATE product_list SET available = " . $qty1 . " ";
                                        $query .= "WHERE name = '$product'";
                                    $db->executequery($query);

                                    $query = "SELECT billno FROM sale_products ORDER BY id desc LIMIT 1";
                                    $result = $db->getdata($query);
                                    $row = mysqli_fetch_assoc($result);
                                    $bill = $row['billno'];
                                    }
                    ?>
				    <table class="table table-bordered table-striped">
                        <thead class="bg-secondary">
                            <tr>
                                <th style="color:white;">SRNO</th>
                                <th style="color:white;">Product Name</th>
                                <th style="color:white;">HSN</th>
                                <th style="color:white;">Per/Kg</th>
                                <th style="color:white;">GST</th>
                                <th style="color:white;">QTY</th>
                                <th style="color:white;">Rate</th public  $server = "localhost";
        public  $username = "u826879810_arman";
        public  $password = "Arman@11";
        public  $dbname = "u826879810_armantraders";>
                             
                                <th style="color:white;">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $sum = 0;
                            $total = 0;

                            $date = date("Y-m-d");
                            $query = "SELECT * FROM sale_products WHERE billno='$bill'";
                            $result = $db->getdata($query);
                            while($row = mysqli_fetch_assoc($result))
                            {
                           
                                $count++;
                               ?>
                                 <tr>
                                     <td><?=$count;?></td>
                                     <td><strong><?=$row['productName'];?></strong></td>
                                     <td><?=$row['hsn'];?></td>
                                     <td><?=$row['per'];?></td>
                                     <td><strong><?=$row['gst'];?></strong> %</td>
                                     <td style="color:blue;"><strong><?=$row['qty'];?></strong></td>
                                     <td style="color:green;"><strong><?=number_format($row['rate'],2);?></strong></td>
                                    
                                     <td>
                                         <a href="sales.php?id=<?=$row['id'];?>"><button class="btn btn-primary btn-sm"><i class="bi bi-pen"></i></button></a>
                                        <button class="btn btn-danger btn-sm delete" data-id=<?=$row['id'];?>><i class="bi bi-trash"></i></button></a>
                                     </td>
                                 </tr>
                               <?php
                                    $sum = $row['qty'] * $row['rate'];
                                    $total +=$sum;
                            }
                      
                            ?>
                        </tbody>
                           
                    </table>
						<a href="pos.php"><button class="btn btn-success btn-sm" style="float:right;margin-right:7px;"><i class="fa fa-file-invoice"></i> Create Bill</button></a>
				<br>
                     </div>
                </div>
           </div>
      </div>
    </section>

  </main><!-- End #main -->
  <script src='jquery-3.0.0.js' type='text/javascript'></script>
        <script src='script.js' type='text/javascript'></script>
  <script>
                                  
								  function myFunction1(){
									   var hsn = $('#product').find(':selected').data('hsn');
									   var per = $('#product').find(':selected').data('per');
									   var gst = $('#product').find(':selected').data('gst');
									 
									   $('#hsn').val(hsn);
									   $('#per').val(per);
									   $('#gst').val(gst);
									 
								   }
							 </script>
<?php include('includes/footer.php');?>