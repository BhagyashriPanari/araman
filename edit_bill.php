<?php include('includes/header.php');
include('db_connect.php');
include('DBClass.php');
$db = new DBClass();
$billno = 0;
$date = "";
$customer = "";
$address = "";
$gstno = "";
$material = "";
$hsn = "";
$qty = 0;
$rate = 0;
$per = "";
$id = 0;
if(isset($_GET['billno']))
{
  
  $billno = $_GET['billno'];
  $query = "SELECT * FROM sale_products WHERE billno=" . $billno;
  $result = $db->getdata($query);
  $row = mysqli_fetch_assoc($result);
  $customer = $row['customer_name'];
  $date = $row['sale_date'];
  $address = $row['address'];
  $gstno = $row['gstno'];
  $material = $row['productName'];
  $hsn = $row['hsn'];
  $qty = $row['qty'];
  $rate = $row['rate'];
  $per = $row['per'];
  $id = $row['id'];
} 

?>

<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
                <div class="card-header bg-secondary">
						<span style="color:white;"><b>Edit Bill No :</b> <?=$billno;?></span>
					</div><br>
                      <div class="card-body">
                        <form action="edit_bill_code.php" method="POST">
                            <input type="hidden" name="bill" value="<?=$billno;?>">
                            <div class="row">
                                <div class="col-4">
                                <label for="">Purchase Date</label>
                                     <input type="date" name="sale_date" value="<?=$date;?>" class="form-control">
                                </div>
                                <div class="col-3">
                                    <label for="">Bill No</label>
                                     <input type="number" name="billno" value="<?=$billno;?>" class="form-control">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-4">
                                    <label for="">Customer Name</label>
                                    <?php
													
                                                    $sql = "SELECT customer_name,address,gstno FROM customer_list ORDER BY id ASC";
                                                    $resultset = mysqli_query($conn, $sql);
                                                ?>
                                                        <select name="customer_name" id="customer_name" onchange="myFunction1()" class="form-control">
                                                    <option value="<?php echo $customer;?>" selected="selected"><?php echo $customer;?></option>
                                                    
                                                    <?php
                                                
                                                    while($rows = mysqli_fetch_assoc($resultset)) { 
                                            
                                                    ?>
                                                    <option data-address="<?php echo $rows['address'];?>" data-gstno="<?php echo $rows['gstno'];?>" value="<?php echo $rows["customer_name"]; ?>"><?php echo $rows["customer_name"]; ?></option>
                                                    <?php 
                                                }
                        
                                                ?>
                                            </select>
                                </div>
                                <div class="col-4">
                                <label for="">Address</label>
                                     <input type="text" name="address" id="address" value="<?=$address;?>" class="form-control">
                                </div>
                                <div class="col-4">
                                      <label for="">GST NO</label>
                                     <input type="text" name="gstno" id="gstno" value="<?=$gstno;?>" class="form-control">
                                </div>
                            </div><br>
                            <input type="submit" name="submit" style="float:right;" value="Save Changes" class="btn btn-success">
                           <br><br>
                        </form>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                   <thead class="bg-secondary">
                                       <tr>
                                          <th style="color:white;">Material Name</th>
                                          <th style="color:white;">HSN NO</th>
                                          <th style="color:white;">Per/Kg</th>
                                          <th style="color:white;">Quantity</th>
                                          <th style="color:white;">Rate</th>
                                          <th style="color:white;">#</th>
                                       </tr>
                                   </thead>
                                 
                                   <tbody>
                                  
                                    <?php
                                      $query = "SELECT * FROM sale_products WHERE billno=" . $billno;
                                      $result = $db->getdata($query);
                                      while($row = mysqli_fetch_assoc($result))
                                      {
                                       
                                 
                                    ?>
                                      <form action="edit_sale_product.php" method="POST">
                                    <input type="hidden" name="billno" value="<?=$billno;?>">
                                    <input type="hidden" name="id" value="<?=$row['id'];?>">
                                      <tr>
                                        <td>
                                        <?php
													
                                                    $sql = "SELECT name,hsn FROM product_list ORDER BY id ASC";
                                                    $resultset = mysqli_query($conn, $sql);
                                                ?>
                                                        <select name="productName" id="productName" onchange="myFunction()" class="form-control">
                                                    <option value="<?php echo $row['productName'];?>" selected="selected"><?php echo  $row['productName'];?></option>
                                                    
                                                    <?php
                                                
                                                    while($rows = mysqli_fetch_assoc($resultset)) { 
                                            
                                                    ?>
                                                    <option data-hsn="<?php echo $rows['hsn'];?>" value="<?php echo $rows["name"]; ?>"><?php echo $rows["name"]; ?></option>
                                                    <?php 
                                                }
                        
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="hsn" id="hsn" readonly="true" value="<?=$row['hsn'];?>" class="form-control">
                                        </td>
                                        <td>
                                           <select name="per" class="form-control">
                                                <option value="<?=$row['per'];?>"><?=$row['per'];?></option>
                                                <option value="BOX">BOX</option>
                                                <option value="TIN">TIN</option>
                                                <option value="Piece">Piece</option>
                                                <option value="KG">KG</option>
                                           </select>
                                        </td>
                                        <td>
                                            <input type="text" name="qty" id="qty" value="<?=$row['qty'];?>" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="rate" id="rate" onchange="gettotal()" value="<?=$row['rate'];?>" class="form-control">
                                        </td>
                                      <td>
                                    <input type="submit" name="sale" value="Edit" class="btn btn-primary btn-sm">
                                      </td>
                                      </tr>
                                      </form>
                                      <?php
                                      }
                                      ?>
                                   </tbody>
                                 
                                </table><br>
                            
                            </div>
                      
                     </div>
                </div>
           </div>
      </div>
    </section>

  </main><!-- End #main -->
  <script>    
				     function myFunction()
					 {
					       var hsn = $('#productName').find(':selected').data('hsn');

					        $('#hsn').val(hsn);
					}
                    function myFunction1()
					 {
					       var address = $('#customer_name').find(':selected').data('address');
                           var gstno = $('#customer_name').find(':selected').data('gstno');
					        $('#address').val(address);
                            $('#gstno').val(gstno);
					}
							 </script>
							 <script>
								 function gettotal()
								 {
									 var qty = parseInt(document.getElementById('qty').value,10);
									 var rate = parseInt(document.getElementById('rate').value,10);

									 var total = (qty * rate);
									 document.getElementById('total').value = total;
								 }
							 </script>
<?php include('includes/footer.php');?>