<?php include('includes/header.php');
include('db_connect.php');
include('DBClass.php');
$db = new DBClass();

$name= "";
$id = 0;

if(isset($_POST['submit']))
{
	$name = $_POST['name'];

	$query = "INSERT INTO category_list(`name`) ";
	$query .="VALUES('".$name."')";
	$db->executequery($query);
}
if(isset($_GET['id']))
{
	$id = $_GET['id'];

	$query = "DELETE FROM category_list WHERE id=" . $id;
	$db->executequery($query);
	// header("Location:category.php");
}
?>

<main id="main" class="main">

    <section class="section">
      <div class="row">
	  <div class="col-lg-12"><br>
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="category.php" method="POST">
				<div class="card">
					<div class="card-header bg-secondary">
						   <span style="color:white;"><strong>Category Form</strong> </span>
				  	</div>
					<div class="card-body"><br>
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Category</label><br><br>
								<input type="text" class="form-control" name="name">
							</div>
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
							<input type="submit" name="submit" value="Save" class="btn btn-primary btn-sm">
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-category').get(0).reset()"> Cancel</button>
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
					<div class="card-body"><br>
						<table class="table table-bordered table-hover table-striped">
							<thead class="bg-secondary">
								<tr style="color:white;">
									<th class="text-center">#</th>
									<th class="text-center">Name</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$count = 0;
								  $query = "SELECT * FROM category_list ORDER BY id ASC";
								  $result = $db->getdata($query);
								  while($row = mysqli_fetch_assoc($result))
								  {
									  $count ++;
                                       ?>
									      <tr>
											  <td><?=$count;?></td>
											  <td><?=$row['name'];?></td>
											  <td>
												  <a href="category.php?id=<?=$row['id'];?>"><button class="btn btn-danger btn-sm">Delete</button></a>
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
	</div>
   </div>
    </section>

  </main><!-- End #main -->

<?php include('includes/footer.php');?>
