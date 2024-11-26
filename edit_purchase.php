<?php include('includes/header.php');
include('db_connect.php');
include 'DBClass.php';
$db = new DBClass();
$id = 0;
$date = "";
$supplier = "";
$product = "";
$qty = 0;
$rate = 0;
$hsn = 0;

if(isset($_GET['id']))
{
   $id = $_GET['id'];
   $query = "SELECT * FROM purchase WHERE id=" . $id;
   $result = $db->getdata($query);
   $row = mysqli_fetch_assoc($result);
   $date = $row['date'];
   $supplier = $row['supplier'];
   $product = $row['productName'];
   $hsn = $row['hsn'];
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
						<span style="color:white;"><b>Edit Purchase</b></span>
					</div><br>
                    <form action="edit_purchase_code.php" method="POST">
                        <input type="hidden" name="id" value="<?=$id;?>">
                      <div class="card-body">
                        <div class="row">

                           <div class="col-4">
                               <label for="">Purchase Date</label>
                               <input type="date" name="date" value="<?=$date;?>" class="form-control">
                           </div>
                           <div class="col-4">
                               <label for="">Supplier Name</label>
                               <?php
													
                                                    $sql = "SELECT supplier_name FROM supplier_list ORDER BY id ASC";
                                                    $resultset = mysqli_query($conn, $sql);
                                                ?>
                                                        <select name="supplier" id="supplier_name" class="form-control">
                                                    <option value="<?php echo $supplier;?>" selected="selected"><?php echo $supplier;?></option>
                                                    
                                                    <?php
                                                
                                                    while($rows = mysqli_fetch_assoc($resultset)) { 
                                            
                                                    ?>
                                                    <option value="<?php echo $rows["supplier_name"]; ?>"><?php echo $rows["supplier_name"]; ?></option>
                                                    <?php 
                                                }
                        
                                                ?>
                                            </select>
                           </div>
                        </div><br>
                        <div class="row">
                         
                           <div class="col-3">
                               <label for="">Product Name</label>
                               <?php
													
                                                    $sql = "SELECT name,hsn FROM product_list ORDER BY id ASC";
                                                    $resultset = mysqli_query($conn, $sql);
                                                ?>
                                                        <select name="productName" id="productName" onchange="myFunction()" class="form-control">
                                                    <option value="<?php echo $product;?>" selected="selected"><?php echo $product;?></option>
                                                    
                                                    <?php
                                                
                                                    while($rows = mysqli_fetch_assoc($resultset)) { 
                                            
                                                    ?>
                                                    <option data-hsn="<?php echo $rows['hsn'];?>" value="<?php echo $rows["name"]; ?>"><?php echo $rows["name"]; ?></option>
                                                    <?php 
                                                }
                        
                                                ?>
                                            </select>
                           </div>
                           <div class="col-3">
                               <label for="">HSN</label>
                               <input type="text" name="hsn" id="hsn" readonly="true" value="<?=$hsn;?>" class="form-control">
                           </div>
                           <div class="col-2">
                               <label for="">Quantity</label>
                               <input type="text" name="qty" id="qty" value="<?=$qty;?>" class="form-control">
                           </div>
                           <div class="col-2">
                               <label for="">Rate</label>
                               <input type="text" name="rate" id="rate" onchange="gettotal()" value="<?=$rate;?>" class="form-control">
                           </div>
                           <div class="col-2">
                               <label for="">Total</label>
                               <input type="text" readonly="true" id="total" class="form-control">
                           </div>
                        </div><br>
                       <input type="submit" name="submit" value="Save Changes" class="btn btn-primary" style="float:right;"><br><br>
                     </div>
                     </form>
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

                    function gettotal()
                    {
                        var qty = parseInt(document.getElementById('qty').value,10);
                        var rate = parseInt(document.getElementById('rate').value,10);

                        total = (qty * rate);
                        document.getElementById('total').value = total;
                    }
</script>
<?php include('includes/footer.php');?>