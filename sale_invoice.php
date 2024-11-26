<?php include('includes/header.php');
include 'DBClass.php';
$db = new DBClass();
$bill = "";


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
                        <form action="bill_invoice.php" method="POST">
                            <label for=""><strong>Enter Bill No :</strong></label>
                                <div class="row">
                                    <div class="col-4">
                                    <br><input type="text" autocomplete="of" name="bil" class="form-control" required>
                                    </div>
                                    <div class="col-4"><br>
                                      <input type="submit" name="save" value="Create Invoice" class="btn btn-success">
                                    </div>
                                </div>

                        </form>

                      
                     </div>
                </div>
           </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php include('includes/footer.php');?>