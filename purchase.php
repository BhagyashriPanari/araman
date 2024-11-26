<?php include('includes/header.php');
include('db_connect.php');
include 'DBClass.php';
$db = new DBClass();
?>

<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
                <div class="card-header bg-secondary">
						<span style="color:white;"><b>Sale Invoice</b></span>
                        <a href="purchase_list.php"><button class="btn btn-warning btn-sm" style="float:right;">All Purchase List</button></a>
					</div><br>
                      <div class="card-body">
                      <form action="purchase_code.php" method="POST">
                          <div class="row">
                              <div class="col-4">
                                 <label for=""><strong> Select Date:</strong>   </label><br><br>
                               <input type="date" name="date" class="form-control"><br>
							  </div>
						  </div> <hr>
						  <div class="row">
                              <div class="col-4">
                                  <label for=""><strong>Supplier Name :</strong></label>
                                  <br> <br> <select name="supplier" class="form-control">
									  <option value="">Select Supplier..</option>
									  <?php
									   $query = "SELECT supplier_name FROM supplier_list ORDER BY id";
									   $result = $db->getdata($query);
									   while($row = mysqli_fetch_assoc($result))
									   {
										   ?>
										    <option value="<?=$row['supplier_name'];?>"><?php echo $row['supplier_name'];?></option>
										   <?php
									   } 
									  ?>
								  </select>
							  </div>
							  <div class="col-4">
                                <label for=""><strong>Product Name :</strong></label>
                                <br> <br>	<select name="productName" id="productName" onchange="myFunction()" class="form-control">
									  <option value="">Select Product..</option>
									  <?php
									   $query = "SELECT name,hsn FROM product_list ORDER BY id";
									   $result = $db->getdata($query);
									   while($row = mysqli_fetch_assoc($result))
									   {
										   ?>
										    <option value="<?=$row['name'];?>" data-hsn=<?=$row['hsn'];?>><?php echo $row['name'];?></option>
										   <?php
									   } 
									  ?>
								  </select>
							  </div>
							  <div class="col-4">
                                  <label for=""><strong>HSN No :</strong></label>
                                  <br>  <br><input type="text" name="hsn" id="hsn" readonly="true" class="form-control"><br>
							  </div>
						  </div> 
						  <div class="row">
                              <div class="col-4">
                                  <label for=""><strong>Quantity :</strong></label>
                                  <br> <br> <input type="text" name="qty" id="qty" autocomplete="of" class="form-control">
							  </div>
							  <div class="col-4">
                                <label for=""><strong>Rate :</strong></label>
								<br> <br><input type="text" name="rate" id="rate" onchange="gettotal()" autocomplete="of" class="form-control">
							  </div>
							  <div class="col-4">
                                  <label for=""><strong>Total Amount :</strong></label>
                                  <br>  <br><input type="text" name="total" id="total" readonly="true" readonly="true" class="form-control">
							  </div>
						  </div><br> 
						  <input type="submit" name="submit" style="float:right;" class="btn btn-success btn-sm" value="Add to stock">
						</form>
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