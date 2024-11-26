<?php include('includes/header.php');
include('DBClass.php');
$db = new DBClass();
$id = 0;
$name = "";
$username = "";
$password = "";
if(isset($_GET['id']))
{
   $id = $_GET['id'];
   $query = "DELETE FROM users WHERE id=" . $id;
   $db->executequery($query);
}
if(isset($_POST['submit']))
{
   $name = $_POST['name'];
   $username = $_POST['username'];
   $password = $_POST['password'];

   $query = "INSERT INTO users(`name`,`username`,`password`) ";
   $query .="VALUES('".$name."','".$username."','".$password."')";
   $db->executequery($query);
}
?>

<main id="main" class="main">

    <section class="section">
    <div class="row">
			<div class="col-md-12"><br>
				<div class="card">
				<div class="card-header bg-secondary">
						<span style="color:white;"><b>User List</b></span>
						<button type="button" class="btn btn-warning btn-sm" style="float:right;" data-bs-toggle="modal" data-bs-target="#basicModal">
               <i class="bi bi-user"></i> Add User
              </button>
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">New User</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="POST">
					  <label for="">Name Of User</label>
						  <input type="text" name="name" autocomplete="of" class="form-control" required><br>
						  <label for="">Username</label>
						  <input type="text" name="username" autocomplete="of" class="form-control" required><br>
						  <label for="">Password</label>
						  <input type="text" name="password" autocomplete="of" class="form-control" required>
					 
                    </div><br>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" name="submit" value="Add" class="btn btn-primary btn-sm">
					</form>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->
					</div>
				<br><br>	<div class="card-body">
						<table class="table table-bordered">
						<thead class="bg-secondary">
				<tr style="color:white;">
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$count = 0;

 					$query = "SELECT * FROM users ORDER BY id ASC";
					 $result = $db->getdata($query);
					 while($row = mysqli_fetch_assoc($result))
					 {
						 $count ++;
					?>
                         <tr>
							 <td><?=$count;?></td>
							 <td><?=$row['name'];?></td>
							 <td><?=$row['username'];?></td>
							 <td>
								 <a href="users.php?id=<?=$row['id'];?>"><button class="btn btn-danger btn-sm">Delete</button></a>
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

