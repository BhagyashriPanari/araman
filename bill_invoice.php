<?php
  

  
include 'DBClass.php';
$db = new DBClass();
$billno = "";
$name = "";
$address = "";
$date = "";
$gst = 0;
$gstno = "";


if(isset($_POST['save']))
{
	$billno = $_POST['bil'];

	$query = "SELECT * FROM sale_products WHERE billno = '$billno'";
	$result = $db->getdata($query);
	while($row = mysqli_fetch_assoc($result))
	{
		$name = $row['customer_name'];
		$address = $row['address'];
		$date = $row['sale_date'];
		$gstno = $row['gstno'];
		$gst=$row['gst'];
		
	}

}
include('includes/header.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Arman Traders | Sale</title>

<style type="text/css">
.invoice {
	font-size: 28px;
}

</style>
<style id="table_style" type="text/css">
   
    table
    {
        border: 1px solid #ccc;
        border-collapse: collapse;
    }
    table th
    {
        background-color: #F7F7F7;
        color: #333;
        font-weight: bold;
    }
    table th, table td
    {
        padding: 5px;
        border: 1px solid #ccc;
    }
</style>
</head>
<body>
<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
                <div class="card-header bg-secondary">
						<span style="color:white;"><b>Sale Invoice</b></span>
						<a class="btn btn-primary btn-sm" href="edit_bill.php?billno=<?=$billno;?>" style="float:right"><i class="bi bi-pencil"></i> Edit Bill</a>
					</div><br>
                      <div class="card-body">
                      <div class="col-md-6 offset-3">
			<input class="form-control" id="gstPercent" type="hidden"
				value="<%=gstPercent%>">
			<input class="form-control" id="lName" type="hidden"
				value="<%=ledgerN%>">
		</div>
                      <div id="dvContents" class="col-md-8 offset-2 ">
			<table class="table table-bordered mt-3">
				<thead>
					<tr>
						<th class="text-center" colspan="8">
							<p class="text-center"
								style="font-size: 2rem; padding: 0; margin: 0;">Arman
								Trader's</p>
							<p class="text-center" style="padding: 0; margin: 0;">Near By
								Nagar Parishad, Malkapur. Tal. Shahuvadi, Dist Kolhapur- 415101
							</p>
							<p class="text-center" style="padding: 0; margin: 0;">Contact
								No. +919420970909</p>
						</th>
					</tr>
					<tr>
						<th style="padding: 3px; margin: 0;" colspan="4">
							<p style="padding: 3px; margin: 0;">GST NO: 27CMXPB5713N1ZF</p>
						</th>
						<th style="padding: 3px; margin: 0;" colspan="4">
							<p style="padding: 3px; margin: 0;">FSSAI NO : 11519043000086</p>
						</th>
					</tr>
					<tr>
						<th style="padding: 3px; margin: 0;" colspan="8">
							<p style="padding: 3px; margin: 0; font-size: 20px;"
								class="text-center">TAX INVOICE</p>
						</th>
					</tr>
					<tr>
						<td colspan="8"><h6 style="padding: 3px; margin: 0;">Bill
								To:</h6></td>
					</tr>
					
					<tr>
						<td class="" colspan="4"><strong>NAME: </strong>  <?php echo $name;?></td>
						<td class="" colspan="4"><strong>BILL NO:</strong> <?php echo $billno;?></td>
					</tr>
					<tr>
						<td class="" colspan="4"><strong>ADDRESS: </strong> <?php echo $address;?></td>
						<td class="" colspan="4"><strong>DATE:</strong> <?php echo  date("d-m-Y", strtotime($date));;?></td>
					</tr>
					<tr>
						<td class="" colspan="4"><strong>GST NO: </strong>  <?php echo $gstno;?></td>
						<td class="" colspan="4"><strong>FSSAI NO: </strong></td>
					</tr>
					<tr>
						<th scope="col">Sr.No</th>
						<th scope="col">Material Name</th>
						<th scope="col">HSN NO</th>
						<th scope="col">Quantity</th>
						<th scope="col">Rate</th>
						<th scope="col">Per/Kg</th>
						<th scope="col">Total Amount</th>
					</tr>
					
				</thead>
				<tbody>
				<?php
				$count = 0;
				$amt = 0;
				$sum = 0;
					$query = "SELECT * FROM sale_products WHERE billno='$billno'";
					$result = $db->getdata($query);
					while($row = mysqli_fetch_assoc($result))
					{
						$count ++;
						$amt =($row['qty'] * $row['rate']) ;
                       ?>
                       <tr>
						<th class="text-center" scope="row"><?php echo $count;?></th>
						<td class="text-center"><?=$row['productName'];?></td>
						<td class="text-center"><?=$row['hsn'];?></td>
						<td class="text-center"><?=$row['qty'];?></td>
						<td class="text-center"><?=$row['rate'];?></td>
						<td class="text-center"><?=$row['per'];?></td>
						<td class="text-center"><?php echo $amt;?></td>
					</tr>
                       <?php
					   $sum +=$amt;
                   }
				   if($count < 4)
				   {
				?>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
					
<?php
				   }
				   elseif($count >= 4 ){
					   ?>
					   <tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr style="height:40px;">
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
					   <?php
				   }
				// }
?>
					<tr>
						<th class="text-center" colspan="4"></th>
						<th class="text-center" colspan="2">GROSS Amount :</th>
						<td class="text-center" colspan="2">
							<?php
							
							//   echo sprintf('%0.2f', $sum);;
							 echo number_format($sum,2);
							  
							?>
						</td>
					</tr>
					<tr>
						<?php
                            //  $pt= 0;

						  if($gst == "0")
						  {
                             $gstt = $amt;
						  }elseif($gst == "5")
						  {
						     $gstt1 = ($sum/105*100);
							
							 $teX = explode('.', $gstt1);
							 
							 if(isset($teX[1])){
								 $de = substr($teX[1], 0, 2);
								 $gstt = $teX[0].'.'.$de;
								 $gstt = (float) $gstt;
							 }else{
								 $gstt = $gstt1;   
							 }
							
						  }elseif($gst == "12")
						  {
						     $gstt1 = (($sum/112)*100);
							 $teX = explode('.', $gstt1);
							 
							 if(isset($teX[1])){
								 $de = substr($teX[1], 0, 2);
								 $gstt = $teX[0].'.'.$de;
								 $gstt = (float) $gstt;
							 }else{
								 $gstt = $gstt1;   
							 }
						
						  }elseif($gst == "18")
						  {
						     $gstt1 = (($sum/118)*100);
							 $teX = explode('.', $gstt1);
							 
							 if(isset($teX[1])){
								 $de = substr($teX[1], 0, 2);
								 $gstt = $teX[0].'.'.$de;
								 $gstt = (float) $gstt;
							 }else{
								 $gstt = $gstt1;   
							 }
						
						  }
						$query = "INSERT INTO `customer_bill`(`customer_name`, `billno`, `billdate`, `total`) ";
						$query .="VALUES('".$name."','".$billno."','".$date."',".$sum.")";
						$db->executequery($query);
						?>
						<th class="text-center" colspan="4"></th>
						<th class="text-center" colspan="2">Net Amount :</th>
						<td class="text-center" colspan="2"><p
								style="padding: 0; margin: 0;" id="netAmo"></p><?php echo $gstt;?></td>
								<input type="hidden" >
					</tr>
					<tr>
					<?php
					 $gt = 0;
					 if($gst == "0")
						{
							echo $gt;
						}
						elseif($gst == "5")
						{
							$gt = 5/2;
						}elseif($gst == "12"){
							$gt = 12/2;
						}elseif($gst == "18"){
							$gt = 18/2;
						}
                         if($gst != 0)
						 {
							$csgst = 0;
							$csgst = ($sum - $gstt1);
						 }
						

					 ?>
						<th class="text-center" colspan="4"></th>
						<th class="text-center" colspan="2">CGST : <?php echo $gt;?> %</th>
						<td class="text-center" colspan="2"><p
								style="padding: 0; margin: 0;" id="netAmo"></p><?php 
								if($gt == 0)
								{
									echo "";
								}else{
									$gsst = ($csgst/2);
									$teX = explode('.', $gsst);
								}
								
							 
								if(isset($teX[1])){
									$de = substr($teX[1], 0, 2);
									$gsst1 = $teX[0].'.'.$de;
								echo	$gsst1 = (float) $gsst1;
								}elseif($gst != 0){
								echo	$gsst1 = $gsst;   
								}
								?></td>
								<input type="hidden" >
					</tr>
					<tr>
						<?php
						if($gst != 0)
						{
							$gstn = ((int)$sum - (int)$gstt1);
							$gstn1 = ($gstn/2);
	
						}
						
						 
						?>
						<td class="" colspan="4"><strong>Bank Name:</strong> Bank Of India, Shahuwadi Branch</td>
                    
						<th class="text-center" colspan="2">
							<p style="display: inline-flex; padding: 0; margin: 0;"
								class="px-2">SGST:</p>
							<p style="display: inline-flex; padding: 0; margin: 0;" id="SGST"><?php echo $gt;?> %</p>
						</th>
						<td class="text-center" colspan="2"><p
								style="padding: 0; margin: 0;" id="sgstAm"> </p><?php 
								if($gt == 0)
								{
									echo "";
								}else{
									$gsst = ($csgst/2);
									$teX = explode('.', $gsst);
								}
							
							 
								if(isset($teX[1])){
									$de = substr($teX[1], 0, 2);
									$gsst1 = $teX[0].'.'.$de;
								echo	$gsst1 = (float) $gsst1;
								}elseif($gst != 0){
								echo	$gsst1 = $gsst;   
								}
								?></td>
					</tr>
					<tr>
						<td class="" colspan="4"><strong>Account Number:</strong>  091420110000157</td>

						<th class="text-center" colspan="2">
							<p style="display: inline-flex; padding: 0; margin: 0;"
								class="px-2">Round Off:</p>
							<p style="display: inline-flex; padding: 0; margin: 0;" id="CGST"></p>
						</th>

						<td class="text-center" colspan="2"><p
								style="padding: 0; margin: 0;" id="cgstAm"></p><?php 
					if($gst != 0)
					{
						$rd = ($gsst1*2);
						$rd1 = $rd + $gstt;
					  echo number_format($sum - $rd1,2);
					}
						 
						?></td>
					</tr>
					<tr>
						<td class="" colspan="4"><strong>Bank IFSC Code: </strong> BKID0000914</td>

						<th class="text-center" colspan="2">Total Amount</th>
						<td class="text-center" colspan="2"><strong><?php echo number_format($sum,2);?></strong></td>
					</tr>
					
	 <?php
				
				//  }
				$number = number_format($sum,2);
				$locale = 'en_US';
				$fmt = numfmt_create($locale,NumberFormatter::SPELLOUT);
				$in_word = numfmt_format($fmt,$number);
	 ?>
	 <tr>

						<td colspan="8"><span style="padding: 3px; margin: 0;"><strong> AMOUNT IN WORDS:</strong></span> <?php echo strtoupper($in_word);?></td>
					</tr>
				</tbody>

			</table>
		</div>
			<div class="col-md-12 mb-3">
				<button id="printBtn" onClick="PrintTable()"  class="btn btn-danger">PRINT</button>
				<a class="btn btn-success" href="sale_invoice.php">Go Back</a>
			</div>
		<input type="hidden" id="TotalAmount" value="<%=total%>">
	
	</div>
	
	<script language="Javascript" src="Bill_Generator.js"></script>
<script type="text/javascript">
    function PrintTable() {
        var printWindow = window.open('', '', 'height=768,width=1366');
        var custName = document.getElementById("lName").value;
        printWindow.document.write('<html><head><title></title>');
 
        //Print the Table CSS.
        var table_style = document.getElementById("table_style").innerHTML;
        printWindow.document.write('<style type = "text/css">');
        printWindow.document.write(table_style);
        printWindow.document.write('</style>');
        printWindow.document.write('</head>');
 
        //Print the DIV contents i.e. the HTML Table.
        printWindow.document.write('<body>');
        var divContents = document.getElementById("dvContents").innerHTML;
        printWindow.document.write(divContents);
        printWindow.document.write('</body>');
 
        printWindow.document.write('</html>');
        printWindow.document.close();
        printWindow.print();
        
    }
  function ParseFloat(str,val) {
							str = str.toString();
							str = str.slice(0, (str.indexOf(".")) + val + 1); 
							return Number(str);   
						}
						console.log(ParseFloat("10.547892",2))
</script>
                     </div>
                </div>
           </div>
      </div>
    </section>

  </main><!-- End #main -->
                    </body>
<?php
  include('includes/footer.php');
?>