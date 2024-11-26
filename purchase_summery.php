<?php include('includes/header.php');
include('db_connect.php');
include('DBClass.php');

$db = new DBClass();
?>

<main id="main" class="main">

    <section class="section">
    <div class="col-lg-12"><br>
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-6">
			<form action="" method="POST">
				<div class="card">
					<div class="card-header bg-secondary">
						   <span style="color:white;">Month Vise Summery</span>
				  	</div>
					<br><div class="card-body">
                    <label for=""><strong> Select Date :</strong></label><br>
                      <br>  <div class="row">
                       
                            <div class="col-4">
                               <input type="date" name="from_date" class="form-control">
                            </div>
                            <div class="col-4">
                               <input type="date" name="to_date" class="form-control">
                            </div>
                            <div class="col-2">
                            <input type="submit" name="submit" value="Search" class="btn btn-warning">
                            </div>
                        
                        </div>
							
					</div>
					
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-6">
                <form action="" method="POST">
			     	<div class="card">
                         <div class="card-header bg-secondary">
						     <span style="color:white;">HSN Vise Summery</span>
				      	</div>
				      	<br><div class="card-body">
                              <label for=""><strong>Select HSN No :</strong></label>
                                 <br><br><div class="row">
                                      <div class="col-6">
                                            <select name="hsn" id="" class="form-control">
                                                <option value="">Select HSN..</option>
                                                <?php
                                                        $query = "SELECT DISTINCT hsn FROM product_list ORDER BY id";
                                                        $result = $db->getdata($query);
                                                        while($row = mysqli_fetch_assoc($result))
                                                        {
                                                            ?>
                                                            <option value="<?=$row['hsn'];?>"><?php echo $row['hsn']?></option>
                                                            <?php
                                                        }
                                                    ?>
                                            </select>
                                      </div>
                                      <div class="col-6">
                                      <input type="submit" name="save" value="Search Summery" class="btn btn-warning">
                                      </div>
                                       
                                  </div>
					         </div>
                      </form>
				  </div>
			  </div>
			<!-- Table Panel -->
		</div>
        <br>
        <div class="row">
        <div class="col-md-12">
			<form action="" id="manage-category">
				<div class="card">
					
					<div class="card-body">
                    <?php
                     if(isset($_POST["submit"]))  
                     {  
                         $date = $_POST['from_date'];
                         $to_date = $_POST['to_date'];
                         $sum = 0;
                         $sum1= 0;
                         $hsn = 0;
                          $hsn1 = 0;
                         $output = '';  
                         $query = "SELECT * FROM purchase WHERE date BETWEEN '$date' AND '$to_date'"; 
                            $total = 0;
                            $gst = 0;
                            $count = 0;
                         $result = $db->getdata($query);
                     
                               $output .= '  
                                           <table id="recieve_data" class="table table-bordered table-striped">  
                                                <thead class="bg-secondary">
                                                <tr>
                                                    <th style="color:white;">SRNO</th>
                                                    <th style="color:white;">Purchase Date</th>
                                                    <th style="color:white;">Product Name</th>
                                                    <th style="color:white;">HSN</th>
                                                    <th style="color:white;">Supplier Name</th>
                                                    <th style="color:white;">Quantity</th>
                                                </tr>
                                            </thead> 
                                             ';  
                                        if(mysqli_num_rows($result) > 0)  
                                        {  
                                            while($row = mysqli_fetch_array($result))  
                                            {  
                                                $count++;
                                            
                                               $hsn = $row['hsn'];
                                               if($hsn == '904' || $hsn == '902' || $hsn == '910')
                                               { 
                                                  $hsn1 = '0'.$hsn;
                                               }else{
                                                   $hsn1 = $hsn;
                                               }
                                                    $output .= '  
                                                                <tr>  
                                                                    <td>'. $count .'</td>  
                                                                    <td>'. $row["date"] .'</td>  
                                                                    <td style="color:blue;"><strong>'. $row["productName"] .'</strong></td>  
                                                                    <td><strong>'.$hsn1.'</strong></td>  
                                                                    <td>'. $row["supplier"] .'</td>   
                                                                    <td>'. $row["qty"] .'</td>
                                                                </tr>  
                                                               '; 
                                                        
                                                   
                                             }  
                                            
                                          } else  
                                             {  
                                                    $output .= '  
                                                        <tr>  
                                                            <td colspan="5">No Record Found</td>  
                                                        </tr>  
                                                    ';  
                                          }  
                                          ?>
                                          	<button type="button" id="export_button" style="float:right;" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Export</button><br><br>
                                          <?php
                                                $output .= '</table>';  
                                                echo $output;  
                                                ?>
                                                <script>
                                                        function html_table_to_excel(type)
                                                        {
                                                            var data = document.getElementById('recieve_data');

                                                            var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

                                                            XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

                                                            XLSX.writeFile(file, 'file.' + type);
                                                        }

                                                        const export_button = document.getElementById('export_button');

                                                        export_button.addEventListener('click', () =>  {
                                                            html_table_to_excel('xlsx');
                                                        });
                                                    </script>
                                                <?php
                                        } 
                                        
                                        if(isset($_POST['save']))
                                        {
                                            $hsnno = $_POST['hsn'];

                                            $query = "SELECT * FROM purchase WHERE hsn=" .$hsnno;
                                            $result = $db->getdata($query);

                                   ?>
                                     <br>  	<button type="button" id="export_button" style="float:right;" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Export</button><br><br>
                                               <br> <table id="recieve_data1" class="table table-bordered">
                                                            <thead class="bg-secondary">
                                                                <tr>
                                                                <th style="color:white;">SRNO</th>
                                                                <th style="color:white;">Purchase Date</th>
                                                                <th style="color:white;">Product Name</th>
                                                                <th style="color:white;">HSN</th>
                                                                <th style="color:white;">Supplier Name</th>
                                                                <th style="color:white;">Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <?php
                                                                    $count = 0;

                                                                    while($row = mysqli_fetch_assoc($result))
                                                                    {
                                                                        $count++;
                                                                        $hsn = $row['hsn'];
                                                                        if($hsn == '904' || $hsn == '902' || $hsn == '910')
                                                                        { 
                                                                           $hsn1 = '0'.$hsn;
                                                                        }else{
                                                                            $hsn1 = $hsn;
                                                                        }
                                                                        ?>
                                                                          <tr>
                                                                              <td><?=$count;?></td>
                                                                              <td><?=$row['date'];?></td>
                                                                              <td style="color:blue;"><strong><?=$row['productName'];?></strong></td>
                                                                              <td><strong><?=$hsn1;?></strong></td>
                                                                              <td><?=$row['supplier'];?></td>
                                                                              <td><?=$row['qty'];?></td>
                                                                          </tr>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                            </tbody>
                                                               
                                                            </table>
                                                    <?php
                                           }
                                                    ?>
					</div>
					
				</div>
			</form>
			</div>
        </div>
	</div>	
    </section>

  </main><!-- End #main -->
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>


<script>
	function html_table_to_excel(type)
    {
        var data = document.getElementById('recieve_data1');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'file.' + type);
    }

    const export_button = document.getElementById('export_button');

    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });
</script>

<?php include('includes/footer.php');?>