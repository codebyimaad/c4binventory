<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid mt-5">
      <div class="row">
        <div class="col-md-6">
          <h1 class="m-0 text-dark">Supplier</h1>
          </div><!-- /.col -->
          <div class="col-md-6 mt-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">supplier</li>
            </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <!-- .row -->
             <div class="card">
               <div class="card-body">
                 <div class="row">
                         <div class="col-12 col-sm-6 col-md-4">
                          <div class="info-box bg-danger mb-3">
                           
                            <div class="info-box-content">
                              <span class="info-box-text">Total transaction</span>
                              <span class="info-box-number"> 
                                <?php 
                                  $stmt = $pdo->prepare("SELECT SUM(`total_buy`) FROM `suppliar`");
                                  $stmt->execute();
                                  $res = $stmt->fetch(PDO::FETCH_NUM);

                                  echo $res[0];

                                ?>
                                </span>
                            </div>
                             <span class="info-box-icon"><i class="material-symbols-outlined">stacked_line_chart</i></span>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>

                         <div class="col-12 col-sm-6 col-md-4">
                          <div class="info-box bg-success mb-3">
                           
                            <div class="info-box-content">
                              <span class="info-box-text">Total paid</span>
                              <span class="info-box-number"> 
                                <?php 
                                  $stmt = $pdo->prepare("SELECT SUM(`total_paid`) FROM `suppliar`");
                                  $stmt->execute();
                                  $res = $stmt->fetch(PDO::FETCH_NUM);

                                  echo $res[0];

                                ?>
                                </span>
                            </div>
                             <span class="info-box-icon "><i class="fas fa-money-bill-wave"></i></span>
                       <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>

                         <div class="col-12 col-sm-6 col-md-4">
                          <div class="info-box bg-info mb-3">
                           
                            <div class="info-box-content">
                              <span class="info-box-text">Total due</span>
                              <span class="info-box-number"> 
                                <?php 
                                  $stmt = $pdo->prepare("SELECT SUM(`total_due`) FROM `suppliar`");
                                  $stmt->execute();
                                  $res = $stmt->fetch(PDO::FETCH_NUM);

                                  echo $res[0];

                                ?>
                                </span>
                            </div>
                             <span class="info-box-icon"><i class="material-symbols-outlined">paid</i></span>

                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                      </div>
               </div>
             </div>
                <!-- *************  table start here *********** -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><b>All Supplier info</b></h3>
                    <button type="button" class="btn btn-primary btn-sm float-right rounded-0" data-toggle="modal" data-target=".suppliarModal"><i class="fas fa-plus"></i> Add new</button>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="suppliarTable" class="display dataTable text-center">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Driver's Name</th>
                            <th>Company</th>
                            <th>Truck No. Plate</th>
                            <th>Contact</th>
                            <th>Total buy</th>
                            <th>Total paid</th>
                            <th>Total due</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                          </table>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.row -->
                      </div><!--/. container-fluid -->
                    </section>
                    <!-- /.content -->
                  </div>
                  <!-- /.content-wrapper -->