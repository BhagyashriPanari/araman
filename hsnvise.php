<?php include('includes/header.php');
include 'db_connect.php';
include 'DBClass.php';
$db = new DBClass();
?>

<main id="main" class="main">

    <section class="section">
    <div class="row">
			<div class="col-md-12"><br>
				<div class="card">
				<div class="card-header bg-secondary">
						<span style="color:white;"><b>HSN Vise Summery</b></span>
						
					</div>
				<br>	<div class="card-body">
                       <form action="" method="POST">
                           <div class="row">
                                 <div class="col-4">
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
                                            <div class="col-4">
                                                 <input type="submit" name="submit" value="Search Summery" class="btn btn-success">
                                            </div>
                                          
                                        </div><br>
                                </form>
                <?php
                 $hsn = 0;
                 $count = 0;
                 $sum = 0;
                 $sum1 = 0;
                 $amt = 0;
                 $amt1 = 0;
                
                 $gstamt = 0;
                  if(isset($_POST['submit']))
                                {
                                    $hsn = $_POST['hsn'];
                                    $query = "SELECT * FROM sale_products WHERE hsn=" . $hsn;
                                    $result = $db->getdata($query);

                                    ?>
                      <table id="recieve_data" class="table table-bordered table-striped">
                          <thead class="bg-secondary">
                              <tr>
                                  <th style="color:white;">SRNO</th>
                                  <th style="color:white;">TAX Rate</th>
                                  <th style="color:white;">HSN</th>
                                  <th style="color:white;">NET Taxable Amt</th>
                                  <th style="color:white;">CGST</th>
                                  <th style="color:white;">SGST</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php 
                             

                             
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                       
                                        $count ++;
                                        $total = ($row["qty"]*$row["rate"]);
                                        $gst = $row["gst"];
                                        if($gst == 5)
                                        {
                                            $amt = ($total*105)/100;
                                             $amt1 = ($amt - $total);
                                             $gstamt = ($amt1/2);
                                        }elseif($gst == 12)
                                        {
                                         $amt = ($total*112)/100;
                                         $amt1 = ($amt - $total);
                                         $gstamt = ($amt1/2);
                                        }elseif($gst == 18)
                                        {
                                         $amt = ($total*118)/100;
                                         $amt1 = ($amt - $total);
                                         $gstamt = ($amt1/2);
                                        }

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
                                         <td><?=$row['gst'];?> %</td>
                                         <td><strong><?=$row['hsn'];?></strong></td>
                                         <td><?php echo number_format($total);?></td>
                                         <td><?php echo number_format($gstamt);?></td>
                                         <td><?=$gstamt;?></td>
                                     </tr>
                                    <?php
                                  $sum +=$total;
                                  $sum1 += $gstamt;
                                }
                          
                              ?>
                          </tbody>
                          <tfoot style="background-color:yellow;">
                          <tr>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th><?=$sum;?></th>
                                  <th><?=$sum1;?></th>
                                  <th><?=$sum1;?></th>
                              </tr>
                          </tfoot>
                          <button type="button" id="export_button" style="float:right;" class="btn btn-success btn-sm"><i class="fa fa-download"></i> Export</button><br><br>
                          <?php
                            }
                          ?>
                       
                      </table>
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