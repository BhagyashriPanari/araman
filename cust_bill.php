<?php include('includes/header.php');

include 'DBClass.php';
$db = new DBClass();
$bill = 0;
$customer = "";
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
                          
                           <form action="" method="POST">
                               <label for=""><strong> Customer Name :</strong></label>
                                    <div class="row">
                                        <div class="col-4">
                                              <br>  <select name="customer_name" class="form-control">
                                                    <option value="">Select Customer..</option>
                                                    <?php
                                                    $query = "SELECT DISTINCT customer_name FROM customer_list ORDER BY id";
                                                    $result = $db->getdata($query);
                                                    while($row = mysqli_fetch_assoc($result))
                                                    {
                                                        ?>
                                                            <option value="<?=$row['customer_name'];?>"><?php echo $row['customer_name'];?></option>
                                                        <?php
                                                    } 
                                                    ?>
                                            </select>
                                        </div>
                                        <div class="col-4"><br>
                                        <input type="submit" name="save" class="btn btn-success" value="Search Bill">
                                        </div>
                                     
                                    </div>
                         </form><br><br>
                         <?php
                         if(isset($_POST['save']))
                                        {
                                            $customer = $_POST['customer_name'];
                                            $query = "SELECT * FROM customer_bill WHERE customer_name='$customer'";
                                            $result = $db->getdata($query);
                                            ?>
                                    <label for=""><strong>Customer Name : </strong><span style="color:blue;"><strong><?php echo $customer;?></strong></span></label><br> 
                                <br><table id="recieve_data" class="table table-bordered table-striped">
                                    <thead class="bg-secondary">
                                        <tr>
                                            <th style="color:white;">SRNO</th>
                                            <th style="color:white;">Bill No</th>
                                            <th style="color:white;">Bill Date</th>
                                            <th style="color:white;">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                       
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                $count++;
                                                ?>
                                                  <tr>
                                                      <td><?=$count;?></td>
                                                      <td><strong><?=$row['billno'];?></strong></td>
                                                      <td><strong><?=$row['billdate'];?></strong></td>
                                                      <td style="color:green;"><strong><?=number_format($row['total'],2);?></strong></td>
                                                  </tr>
                                                <?php
                                            }
                                      
                                        ?>
                                    </tbody>
                                </table>
                        <?php
                                        }
                                        
                        ?>
                        	<button type="button" id="export_button" style="float:right;" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Export</button><br><br>
                     </div>
                </div>
           </div>
      </div>
    </section>

  </main><!-- End #main -->
 <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
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
<?php include('includes/footer.php');?>