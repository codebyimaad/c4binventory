<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid mt-5">
      <div class="row">
        <div class="col-md-6">
          <h1 class="m-0 text-dark">Profit and Loss Report</h1>
        </div>
        <div class="col-md-6 mt-3">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profit and loss report</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- Purchase Side -->
        <div class="col-md-6 col-lg-6">
          <div class="card">
            <div class="card-body">
              <table class="table">
                <tr>
                  <td class="text-info" colspan="2">Purchase</td>
                </tr>
                <tr>
                  <td>Total Purchase</td>
                  <td class="text-right">
                    <?php
                      $stmt = $pdo->prepare("SELECT SUM(`purchase_subtotal`) FROM `purchase_products`");
                      $stmt->execute();
                      $res = $stmt->fetch(PDO::FETCH_NUM);
                      $total_purchase = (float)$res[0];
                      echo number_format($total_purchase);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Paid Amount</td>
                  <td class="text-right">
                    <?php
                      $stmt = $pdo->prepare("SELECT SUM(`payment_amount`) FROM `purchase_payment`");
                      $stmt->execute();
                      $res = $stmt->fetch(PDO::FETCH_NUM);
                      echo number_format((float)$res[0]);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Purchase Due</td>
                  <td class="text-right">
                    <?php
                      $stmt = $pdo->prepare("SELECT SUM(`total_due`) FROM `suppliar`");
                      $stmt->execute();
                      $res = $stmt->fetch(PDO::FETCH_NUM);
                      echo number_format((float)$res[0]);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Purchase Return</td>
                  <td class="text-right">
                    <?php
                      $stmt = $pdo->prepare("SELECT SUM(`netTotal`) FROM `purchase_return`");
                      $stmt->execute();
                      $res = $stmt->fetch(PDO::FETCH_NUM);
                      $total_return = (float)$res[0];
                      echo number_format($total_return);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Gross Purchase</b></td>
                  <td class="text-right">
                    <b><?php echo number_format($total_purchase - $total_return); ?></b>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <!-- Sales Side -->
        <div class="col-md-6 col-lg-6">
          <div class="card">
            <div class="card-body">
              <table class="table">
                <tr>
                  <td class="text-info" colspan="2">Sales</td>
                </tr>
                <tr>
                  <td>Total Sell</td>
                  <td class="text-right">
                    <?php
                      $stmt = $pdo->prepare("SELECT SUM(`sub_total`) FROM `invoice`");
                      $stmt->execute();
                      $res = $stmt->fetch(PDO::FETCH_NUM);
                      $total_sell_amount = (float)$res[0];
                      echo number_format($total_sell_amount);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Paid Amount</td>
                  <td class="text-right">
                    <?php
                      $stmt = $pdo->prepare("SELECT SUM(`payment_amount`) FROM `sell_payment`");
                      $stmt->execute();
                      $res = $stmt->fetch(PDO::FETCH_NUM);
                      echo number_format((float)$res[0]);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Sell Due</td>
                  <td class="text-right">
                    <?php
                      $stmt = $pdo->prepare("SELECT SUM(`total_due`) FROM `member`");
                      $stmt->execute();
                      $res = $stmt->fetch(PDO::FETCH_NUM);
                      echo number_format((float)$res[0]);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td>Sell Return</td>
                  <td class="text-right">
                    <?php
                      $stmt = $pdo->prepare("SELECT SUM(`amount`) FROM `sell_return`");
                      $stmt->execute();
                      $res = $stmt->fetch(PDO::FETCH_NUM);
                      $total_sell_return = (float)$res[0];
                      echo number_format($total_sell_return);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td><b>Gross Sells</b></td>
                  <td class="text-right">
                    <b><?php echo number_format($total_sell_amount - $total_sell_return); ?></b>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>
