<?php include('includes/header.php');

include 'DBClass.php';

$db = new DBClass();
 
$query = "SELECT * FROM product_list ORDER BY id ASC";
$result = $db->getdata($query);

?>

<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Stock</h5>
                  <table class="table datatable">
                       <thead class="bg-secondary">
								<tr style="color:white;">
									<th class="text-center">SRNO</th>
									<th class="text-center">Product Name</th>
									<th class="text-center">HSN</th>
									<th class="text-center">Per/Kg</th>
									<th class="text-center" style="width:10px;">Available Quantity</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$count = 0;
								    while($row = mysqli_fetch_assoc($result))
									{
										$count++;
										if($row['available'] != 0)
										{
											
									?>
									 <tr style="background-color:yellow;">
										 <td><?=$count;?></td>
										 <td style="color:blue"><strong><?=$row['name'];?></strong></td>
										 <td><strong><?=$row['hsn'];?></strong></td>
										 <td><?=$row['per'];?></td>
										 <td><?=$row['available'];?></td>

									 </tr>
									<?php
									}else{
                                         ?>
										  <tr>
										 <td><?=$count;?></td>
										 <td style="color:blue"><strong><?=$row['name'];?></strong></td>
										 <td><strong><?=$row['hsn'];?></strong></td>
										  <td><?=$row['per'];?></td>
										 <td><?=$row['available'];?></td>

									 </tr>
										 <?php
									}
								}
								?>
							</tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
<?php include('includes/footer.php');?>