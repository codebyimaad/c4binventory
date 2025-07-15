<?php 
require_once '../init.php';

if (isset($_POST) && !empty($_POST)) {
    $issueData = $_POST['issuedate'];
    $customer = $_POST['customer'];

    $data = explode('-', $issueData);
    $issu_first_date = $obj->convertDateMysql(trim($data[0]));
    $issu_end_date = $obj->convertDateMysql(trim($data[1]));

    if ($customer == 'all') {
        $stmt = $pdo->prepare("SELECT * FROM `purchase_products` WHERE `purchase_date` BETWEEN ? AND ?");
        $stmt->execute([$issu_first_date, $issu_end_date]);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($res) {
            $i = 0;
            foreach ($res as $data) {
                $i++;
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $data->id; ?></td>
                    <td><?= $data->purchase_date; ?></td>
                    <td><?= $data->purchase_suppliar; ?></td>
                    <td><?= $data->suppliar_name; ?></td>
                    <td><?= number_format($data->purchase_net_total); ?></td>
                    <td><?= number_format($data->purchase_paid_bill); ?></td>
                    <td><?= number_format($data->purchase_due_bill); ?></td>
                </tr>
                <?php
            }

            // Total Row
            $stmt = $pdo->prepare("SELECT 
                SUM(`purchase_subtotal`), 
                SUM(`purchase_net_total`), 
                SUM(`purchase_due_bill`) 
                FROM `purchase_products` 
                WHERE `purchase_date` BETWEEN ? AND ?");
            $stmt->execute([$issu_first_date, $issu_end_date]);
            $totals = $stmt->fetch(PDO::FETCH_NUM);
            ?>
            <tr>
                <th colspan="4"></th>
                <th>Total:</th>
                <th><?= number_format($totals[0]); ?></th>
                <th><?= number_format($totals[1]); ?></th>
                <th><?= number_format($totals[2]); ?></th>
            </tr>
            <?php
        } else {
            echo "<p style='text-align:center;'>No data found</p>";
        }
    } else {
        $stmt = $pdo->prepare("SELECT * FROM `purchase_products` WHERE `purchase_date` BETWEEN ? AND ? AND `purchase_suppliar` = ?");
        $stmt->execute([$issu_first_date, $issu_end_date, $customer]);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($res) {
            $i = 0;
            foreach ($res as $data) {
                $i++;
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $data->id; ?></td>
                    <td><?= $data->purchase_date; ?></td>
                    <td><?= $data->purchase_suppliar; ?></td>
                    <td><?= $data->suppliar_name; ?></td>
                    <td><?= number_format($data->purchase_net_total); ?></td>
                    <td><?= number_format($data->purchase_paid_bill); ?></td>
                    <td><?= number_format($data->purchase_due_bill); ?></td>
                </tr>
                <?php
            }

            // Totals for specific supplier
            $stmt = $pdo->prepare("SELECT 
                SUM(`purchase_subtotal`), 
                SUM(`purchase_net_total`), 
                SUM(`purchase_due_bill`) 
                FROM `purchase_products` 
                WHERE `purchase_date` BETWEEN ? AND ? AND `purchase_suppliar` = ?");
            $stmt->execute([$issu_first_date, $issu_end_date, $customer]);
            $totals = $stmt->fetch(PDO::FETCH_NUM);
            ?>
            <tr>
                <th colspan="4"></th>
                <th>Total:</th>
                <th><?= number_format($totals[0]); ?></th>
                <th><?= number_format($totals[1]); ?></th>
                <th><?= number_format($totals[2]); ?></th>
            </tr>
            <?php
        } else {
            echo "<p style='text-align:center;'>No data found</p>";
        }
    }
}
?>
