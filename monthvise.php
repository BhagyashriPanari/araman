<?php include('includes/header.php');
include 'db_connect.php';

include("DBClass.php");
$db = new DBClass();
?>

<main id="main" class="main">

    <section class="section">
    <div class="row">
			<div class="col-md-12"><br>
				<div class="card">
				<div class="card-header bg-secondary">
						<span style="color:white;"><b>Month Vise Summery</b></span>
						
					</div>
				<br>	<div class="card-body">
                    <form action="" method="POST">
                      <label for=""><strong> Select Date :</strong></label><br><br>
                        <div class="row">
                     
                            <div class="col-4">
                               <input type="date" name="from_date" class="form-control">
                            </div>
                            <div class="col-4">
                               <input type="date" name="to_date" class="form-control">
                            </div>
                            <div class="col-4">
                            <input type="submit" name="submit" value="Search Summery" class="btn btn-warning">
                            </div>
                          
                          </div><br>
                     </form>
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
                         $query = "SELECT * FROM sale_products WHERE sale_date BETWEEN '$date' AND '$to_date'"; 
                            $total = 0;
                            $gst = 0;
                            $amt = 0;
                            $amt1 = 0;
                            $count = 0;
                            $gstamt = 0;
                             $net = 0;
                         $result = $db->getdata($query);
                     
                               $output .= '  
                                           <table id="recieve_data" class="table table-bordered table-striped">  
                                                <thead class="bg-secondary">
                                                <tr>
                                                 
                                                    <th style="color:white;">Date</th>
                                                    <th style="color:white;">BillNo</th>
                                                    <th style="color:white;">Quantity</th>
                                                       <th style="color:white;">Per/Kg</th>
                                                    <th style="color:white;">TAX Rate</th>
                                                    <th style="color:white;">HSN</th>
                                                    <th style="color:white;">Gross Amount</th>
                                                    <th style="color:white;">NET Taxable Amt</th>
                                                    <th style="color:white;">CGST</th>
                                                    <th style="color:white;">SGST</th>
                                                </tr>
                                            </thead> 
                                             ';  
                                        if(mysqli_num_rows($result) > 0)  
                                        {  
                                            while($row = mysqli_fetch_array($result))  
                                            {  
                                                $count++;
                                               $total = ($row["qty"]*$row["rate"]);
                                               $gst = $row["gst"];
                                               if($gst == 0)
                                               {
                                                   $net = $total;
                                               }
                                               elseif($gst == 5)
                                               {
                                                   $net = ($total/105)*100;
                                               }
                                               elseif($gst == 12)
                                               {
                                                   $net = ($total/112)*100;
                                               }
                                               elseif($gst == 18)
                                               {
                                                   $net = ($total/118)*100;
                                               }
                                              
                                               if($gst == 0)
                                               {
                                                   $gstamt = 0;
                                               }else{
                                                $gstamt = ($total - $net)/2;
                                               }
                                              
                                               $hsn = $row['hsn'];
                                               if($hsn == '904' || $hsn == '902' || $hsn == '910')
                                               { 
                                                  $hsn1 = '0'.$hsn;
                                               }else{
                                                   $hsn1 = $hsn;
                                               }
                                                    $output .= '  
                                                                <tr>  
                                                                <td><strong>'. date("d-m-Y", strtotime($row['sale_date'])) .'</strong></td> 
                                                                    <td><strong>'. $row['billno'] .' No</strong></td> 
                                                                    <td>'. $row['qty'] .'</td> 
                                                                      <td>'. $row['per'] .'</td> 
                                                                    <td>'. $row["gst"] .' %</td>  
                                                                    <td><strong>'.$hsn1.'</strong></td>  
                                                                    <td style="color:green;"><strong>'.number_format($total,2).'</strong></td> 
                                                                    <td style="color:green;"><strong>'.number_format($net,2).'</strong></td> 
                                                                    <td style="color:blue;"><strong>'.number_format($gstamt,2).'</strong></td> 
                                                                    <td style="color:blue;"><strong>'.number_format($gstamt,2).'</strong></td>
                                                                </tr>  
                                                               '; 
                                                          $sum += $total;
                                                          $sum1 += $gstamt;
                                                   
                                             }  
                                             $output .='
                                             <tfoot style="background-color:yellow;">
                                                     <tr>
                                                      <th></th>
                                                     <th></th>
                                                     <th></th>
                                                     <th></th>
                                                     <th></th>
                                                     <th></th>
                                                     <th>'.number_format($sum,2).'</th>
                                                     <th></th>
                                                     <th>'.number_format($sum1,2).'</th>
                                                     <th>'.number_format($sum1,2).'</th>
                                                    </tr>
                                             </tfoot>
                                          ';

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
                                        }        
                            ?>
      
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