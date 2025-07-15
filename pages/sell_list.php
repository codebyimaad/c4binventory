<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row ">
        <div class="col-md-6">
          <h1 class="m-0 text-dark"><!-- Dashboard v2 --></h1>
        </div>
        <div class="col-md-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><b>Total Sell List</b></h3>
          <a href="index.php?page=quick_sell" target="_blank" class="btn btn-primary btn-sm float-right rounded-0" style="margin:8px;"><i class="fas fa-plus"></i> New sell</a>
        </div>

        <div class="card-body">
          <div class="calculation-area">
            <div class="row">
              <!-- Total Sell -->
              <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box bg-danger">
                  <div class="info-box-content">
                    <span class="info-box-text">Total Sell</span>
                    <span class="info-box-number"> 
                      <?php 
                        $stmt = $pdo->prepare("SELECT SUM(`net_total`) FROM `invoice`");
                        $stmt->execute();
                        $res = $stmt->fetch(PDO::FETCH_NUM);
                        echo number_format($res[0]);
                      ?>
                    </span>
                  </div>
                  <span class="info-box-icon"><i class="material-symbols-outlined">sell</i></span>
                </div>
              </div>

              <!-- Total Paid Amount -->
              <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box bg-secondary">
                  <div class="info-box-content">
                    <span class="info-box-text">Total Paid Amount</span>
                    <span class="info-box-number"> 
                      <?php 
                        $stmt = $pdo->prepare("SELECT SUM(`paid_amount`) FROM `invoice`");
                        $stmt->execute();
                        $res = $stmt->fetch(PDO::FETCH_NUM);
                        echo number_format($res[0]);
                      ?>
                    </span>
                  </div>
                  <span class="info-box-icon"><i class="material-symbols-outlined">payments</i></span>
                </div>
              </div>

              <!-- Total Due Amount -->
              <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box bg-info">
                  <div class="info-box-content">
                    <span class="info-box-text">Total Due Amount</span>
                    <span class="info-box-number"> 
                      <?php 
                        $stmt = $pdo->prepare("SELECT SUM(`due_amount`) FROM `invoice`");
                        $stmt->execute();
                        $res = $stmt->fetch(PDO::FETCH_NUM);
                        echo number_format($res[0]);
                      ?>
                    </span>
                  </div>
                  <span class="info-box-icon"><i class="material-symbols-outlined">currency_rupee</i></span>
                </div>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table id="sellTable" class="display dataTable text-center">
              <thead>
                <tr>
                  <th>Invoice no</th>
                  <th>Customer</th>
                  <th>Order Date</th>
                  <th>Sub Total</th>
                  <th>Previous Due</th>
                  <th>Net Total</th>
                  <th>Paid</th>
                  <th>Due</th>
                  <th>Status</th>
                  <th>Payment Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <!-- Data is populated by DataTables JS or backend -->
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
