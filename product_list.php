<?php include('includes/header.php');
include('db_connect.php');
include('DBClass.php');
$db = new DBClass();


$name= "";
$hsn = 0;
$cat_id = 0;
$gst = 0;
$price = 0;

$id = 0;

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$hsn = $_POST['hsn'];
	$cat_id = $_POST['category_id'];
	$gst = $_POST['gst'];
	$price = $_POST['price'];

	$query = "INSERT INTO `product_list`(`category_id`, `hsn`, `price`, `name`, `gst`) ";
	$query .="VALUES(".$cat_id.",".$hsn.",".$price.",'".$name."',".$gst.")";
	$db->executequery($query);
}
if(isset($_GET['id']))
{
	$id = $_GET['id'];

	$query = "DELETE FROM product_list WHERE id=" . $id;
	$db->executequery($query);
	// header("Location:category.php");
}
?>

<main id="main" class="main">

    <section class="section">
    <div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="product_list.php" method="POST">
				<div class="card">
					<div class="card-header bg-secondary">
						   <span style="color:white;"><strong> Product Form</strong></span>
				  	</div>
                      <br>	<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Product Name</label>
							<input type="text" autocomplete="of" class="form-control" name="name">
							</div>
							<div class="form-group">
								<br><label class="control-label">HSN</label>
								<input type="text" autocomplete="of" class="form-control" name="hsn">
							</div>
					
							<div class="form-group">
                            <br><label class="control-label">Category</label>
						<select name="category_id" id="" class="form-control">
                                        <option value="">Select HSN..</option>
                                            <?php
                                                $query = "SELECT * FROM category_list order by name asc";
                                                $result = $db->getdata($query);
                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    ?>
                                                    <option value="<?=$row['id'];?>"><?php echo $row['name']?></option>
                                                    <?php
                                                }
                                            ?>
                                        
                                        </select>
							</div>
					
						<div class="form-group">
                        <br><label class="control-label">GST</label>
                          <select name="gst" class="form-control">
									<option>Select GST Option..</option>
									<option value="0">0%</option>
									<option value="5">5%</option>
									<option value="12">12%</option>
									<option value="18">18%</option>
						     </select>
						</div>	
						<div class="form-group">
							<br><label class="control-label">Rate</label>
                           <input type="text" name="price" class="form-control">
						</div>	
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
							<input type="submit" name="submit" value="Save" class="btn btn-primary">
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#manage-product').get(0).reset()"> Cancel</button>
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
						   <span style="color:white;"><strong> Product Info</strong></span>
				  	</div>
					<div class="card-body">
                    <table class="table datatable table table-bordered table-hover">
							<thead class="bg-secondary">
								<tr style="color:white;">
									<th class="text-center">#</th>
									<th class="text-center">Product Info</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
							     $count = 0;
								 $query = "SELECT * FROM product_list ORDER BY id ASC";
								 $result = $db->getdata($query);
								 while($row = mysqli_fetch_assoc($result))
								 {
									 $count ++;
								?>
								<tr>
									<td class="text-center"><?php echo $count; ?></td>
									<td class="">
										<p>HSN : <b><?php echo $row['hsn'] ?></b></p>
										<p><small>Category : <b><?php echo $cat_arr[$row['category_id']] ?></b></small></p>
										<p><small>Name : <b><?php echo $row['name'] ?></b></small></p>
									
										<p><small>GST : <b><?php echo $row['gst']; ?>%</b></small></p>
									</td>
									<td class="text-center">
									<a href="product_list.php?id=<?=$row['id']?>"><button class="btn btn-danger btn-sm">Delete</button></a>
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
  <script>    
				     function myFunction1()
					 {
					       var hsn = $('#productName').find(':selected').data('hsn');
						 
					        $('#hsn').val(hsn);
						
					}
							 </script>	
							 <script>
								 function getrate()
								 {
									 var rate = parseInt(document.getElementById('rate').value,10);
									 var gst = parseInt(document.getElementById('gst').value,10);
				             	
										 var total = (rate/105*100);
										 var gst_rate = ($rate-total);
										 var price = (rate + gst_rate);
								
									 document.getElementById('price').value = price;
								 }
							 </script>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin:unset;
	}
</style>
<script>
	$('table').dataTable()
	$('#manage-product').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_product',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_product').click(function(){
		start_load()
		var cat = $('#manage-product')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='hsn']").val($(this).attr('data-hsn'))
		cat.find("[name='category_id']").val($(this).attr('data-category_id'))
		cat.find("[name='gst']").val($(this).attr('data-gst'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		end_load()
	})
	$('.delete_product').click(function(){
		_conf("Are you sure to delete this product?","delete_product",[$(this).attr('data-id')])
	})
	function delete_product($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_product',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
<?php include('includes/footer.php');?>