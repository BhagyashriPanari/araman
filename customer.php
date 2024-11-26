<?php include('includes/header.php');
include('db_connect.php');

include('DBClass.php');
$db = new DBClass();

$name= "";
$gstno = 0;
$address = 0;

$id = 0;

if(isset($_POST['submit']))
{
	$name = $_POST['customer_name'];
	$gstno = $_POST['gstno'];
	$address = $_POST['address'];

	$query = "INSERT INTO `customer_list`(`customer_name`, `gstno`, `address`) ";
	$query .="VALUES('".$name."','".$gstno."','".$address."')";
	$db->executequery($query);
}
if(isset($_GET['id']))
{
	$id = $_GET['id'];

	$query = "DELETE FROM customer_list WHERE id=" . $id;
	$db->executequery($query);
	// header("Location:category.php");
}

?>

<main id="main" class="main">

    <section class="section">
    <div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="customer.php" method="POST">
				<div class="card">
					<div class="card-header bg-secondary">
						   <span style="color:white;">Customer Form</span> 
				  	</div>
				<br>	<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Customer Name</label>
								<input type="text" class="form-control" name="customer_name">
							</div>
							<div class="form-group">
								<br><label class="control-label">GST NO</label>
								<input type="text" class="form-control" name="gstno">
							</div>
							<div class="form-group">
							<br>	<label class="control-label">Address</label>
								<textarea class="form-control" cols="30" rows="3" name="address"></textarea>
							</div>
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
							<input type="submit" name="submit" value="Save" class="btn btn-primary">
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-customer').get(0).reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
				<div class="card-header bg-secondary">
						   <span style="color:white;">Customer List</span> 
				  	</div>
					<div class="card-body">
						<table class="table datatable table-bordered table-hover">
							<thead class="bg-secondary">
								<tr style="color:white;">
									<th class="text-center">#</th>
									<th class="text-center">Customer</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								
								$count = 0;
								$query = "SELECT * FROM customer_list ORDER BY id ASC";
								$result = $db->getdata($query);
								while($row = mysqli_fetch_assoc($result))
								{
									$count ++;
								?>
								<tr>
									<td class="text-center"><?php echo $count; ?></td>
									<td class="">
										<p>Name : <b><?php echo $row['customer_name'] ?></b></p>
										<p><small>Contact : <b><?php echo $row['gstno'] ?></b></small></p>
										<p><small>Address : <b><?php echo $row['address'] ?></b></small></p>
									</td>
									<td class="text-center">
									<a href="customer.php?id=<?=$row['id'];?>"><button class="btn btn-danger btn-sm">Delete</button></a>
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
			<!-- Table Panel -->
		</div>
    </section>

  </main><!-- End #main -->

<?php include('includes/footer.php');?>