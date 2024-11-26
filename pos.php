<?php include('includes/header.php');

include 'DBClass.php';
$db = new DBClass();
$billno = "";

$query = "SELECT billno,sale_date,gst FROM sale_products ORDER BY id desc LIMIT 1";
$result = $db->getdata($query);
$row = mysqli_fetch_assoc($result);
$billno = $row['billno'];
$sale_date = $row['sale_date'];
$gst = $row['gst'];
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
                      <form action="invoice.php" method="POST">
				<input type="hidden" name="billno" value="<?=$billno;?>">
				<input type="hidden" name="sale_date" value="<?=$sale_date;?>">
				<input type="hidden" name="gst" value="<?=$gst;?>">
					<div class="col-md-12">
						<div class="row">
							<div class="form-group col-md-4">
								<label class="control-label">Customer</label>
                                <select name="customer_name" id="customer_name" onchange="myFunction()" class="form-control">
											<option value="Guest" selected="">Guest</option>
                                            <?php
                                                $query = "SELECT customer_name,address,gstno FROM customer_list order by id asc";
                                                $result = $db->getdata($query);
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    ?>
                                                  <option data-address ='<?=$row["address"]?>' data-gstno ='<?=$row["gstno"]?>' value="<?php echo $row['customer_name'] ?>"><?php echo $row['customer_name'] ?></option>
                                                    <?php
                                                }
                                            ?>
                                        
                                        </select>
							
							</div>
							<div class="col-4">
                               <label for="">Address</label>
							   <input type="text" name="address" id="address" readonly="true"  class="form-control">
							</div>
							<div class="col-4">
                               <label for="">GST No</label>
							   <input type="text" name="gstno" id="gstno" readonly="true" class="form-control">
							</div>
							
						</div>
						<hr>
						<input type="submit" value="Generate Bill" style="float:right;" name="submit" class="btn btn-success">
				</form>
                     </div>
                </div>
           </div>
      </div>
    </section>

  </main><!-- End #main -->
  <script>
                                  
                                  function myFunction(){
                                       var address = $('#customer_name').find(':selected').data('address');
                                       var gstno = $('#customer_name').find(':selected').data('gstno');
                                     
                                       $('#address').val(address);
                                       $('#gstno').val(gstno);
                                  
                                     // alert(contactNo);
                                   }
                             </script>
<?php include('includes/footer.php');?>