<?php include('includes/header.php');

include 'DBClass.php';
$db = new DBClass();
 
$query = "SELECT * FROM purchase ORDER BY id ASC";
$result = $db->getdata($query);
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
                      <table class="table datatable">
                      <thead class="bg-info">
								<tr style="color:white;">
									<th class="text-center">#</th>
                                    <th class="text-center">Purchase Date</th>
									<th class="text-center">Supplier Name</th>
									<th class="text-center">Product Name</th>
									<th class="text-center">HSN</th>
									<th class="text-center">Quantity</th>
									<th class="text-center">Total Amount</th>
										<th class="text-center">#</th>
								</tr>
							</thead>
							<tbody>
							<?php
                            $total = 0;
                            $count = 0;
                               while($row = mysqli_fetch_assoc($result))
                               {
                                   $count ++;
                                  $total = ($row['qty']*$row['rate']);
                                   ?>
                                    <tr>
                                        <td><?=$count;?></td>
                                        <td><?=$row['date'];?></td>
                                        <td><?=$row['supplier'];?></td>
                                        <td><strong><?=$row['productName'];?></strong></td>
                                        <td style="color:blue;"><strong><?=$row['hsn'];?></strong></td>
                                        <td><?=$row['qty'];?> Kg</td>
                                        <td style="color:green;"><strong><?=number_format($total,2);?></strong></td>
                                        <td>
                                          <a href="edit_purchase.php?id=<?=$row['id'];?>"><button class="btn btn-primary btn-sm">Edit</button></a>
                                        </td>
                                    </tr>
                                   <?php
                               }
                            ?>
							</tbody>
              </table>
                     </div>
                </div>
           </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php include('includes/footer.php');?>