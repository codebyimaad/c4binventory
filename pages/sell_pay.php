<!-- Content Wrapper. Contains page content  --> 
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid mt-5">
      <div class="row">
        <div class="col-md-6">
          <h1 class="m-0 text-dark">Debt Sell Payment</h1>
        </div>
        <div class="col-md-6 mt-3">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <?php 
        if (isset($_GET['id']) && $_GET['id'] != '') {
          $edit_id = $_GET['id'];
          $data = $obj->find('member' , 'id' , $edit_id);

          if ($data) {
        ?>
        <div class="col-md-12 mt-3">
          <div class="card">
            <div class="card-header">
              <h3 class="text-center">Debt Sell Payments</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 col-lg-6">
                  <p class="m-0 p-0"><b><i>Customer info:</i></b></p>
                  <p class="m-0 p-0">Customer Name: <?= $data->name; ?></p>
                  <p class="m-0 p-0">Business Name: <?= $data->company; ?></p>
                  <p class="m-0 p-0">Address: <?= $data->address; ?></p>
                  <p class="m-0 p-0">Contact: <?= $data->con_num; ?></p>
                  <p class="m-0 p-0">Email: <?= $data->email; ?></p>
                  <p class="m-0 p-0">Total Due: <?= number_format($data->total_due, 2); ?></p>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              <form id="sell_payForm">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="payment_date">Date</label>
                      <input type="hidden" name="customer_id" value="<?= $data->id; ?>">
                      <input type="text" class="form-control datepicker" id="payment_date" name="payment_date" placeholder="Please select a date" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="spay_amount">Amount</label>
                      <input type="text" class="form-control" id="spay_amount" name="pay_amount" value="<?= number_format($data->total_due, 2); ?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="spay_type">Payment Mode</label>
                      <select name="pay_type" id="spay_type" class="form-control">
                        <?php 
                        $all_pay_type = $obj->all('paymethode');
                        foreach ($all_pay_type as $paymethode) {
                        ?>
                          <option value="<?= $paymethode->name ?>"><?= $paymethode->name ?></option>
                        <?php 
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="pay_descrip">Description</label>
                  <textarea rows="3" class="form-control" id="pay_descrip" name="pay_descrip"></textarea>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block mt-4 rounded-0">Pay now</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- JS Script to remove commas before submission -->
        <script>
        document.getElementById('sell_payForm').addEventListener('submit', function (e) {
          const amountInput = document.getElementById('spay_amount');
          amountInput.value = amountInput.value.replace(/,/g, '');
        });
        </script>

        <?php 
          } else {
            header("location:index.php?page=member");
          }
        } else {
          header("location:index.php?page=member");
        }
        ?>
      </div>
    </div>
  </section>
</div>
<!-- /.content-wrapper -->
