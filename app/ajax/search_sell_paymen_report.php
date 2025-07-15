<?php  
require_once '../init.php';

if (isset($_POST) && !empty($_POST)) {
    $issueData = $_POST['issuedate'];
    $customer = $_POST['customer'];

    $data = explode('-', $issueData);
    $issu_first_date = $obj->convertDateMysql($data[0]);
    $issu_end_date = $obj->convertDateMysql($data[1]);

    if ($customer == 'all') {
        $stmt = $pdo->prepare("
            SELECT sell_payment.`payment_date`, sell_payment.`customer_id`, member.name, 
                   sell_payment.`payment_amount`, sell_payment.`payment_type` 
            FROM sell_payment 
            INNER JOIN member ON sell_payment.`customer_id` = member.`id` 
            WHERE `payment_date` BETWEEN ? AND ?");
        $stmt->execute([$issu_first_date, $issu_end_date]);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        if ($res) {
            $i = 0;
            foreach ($res as $data) {
                $i++;
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $data->payment_date; ?></td>
                    <td><?= $data->customer_id; ?></td>
                    <td><?= $data->name; ?></td>
                    <td><?= $data->payment_type; ?></td>
                    <td><?= number_format($data->payment_amount, 2); ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <th colspan="5" style="text-align:right;">Total:</th>
                <th>
                    <?php
                    $stmt = $pdo->prepare("SELECT SUM(`payment_amount`) FROM `sell_payment` WHERE `payment_date` BETWEEN ? AND ?");
                    $stmt->execute([$issu_first_date, $issu_end_date]);
                    $res = $stmt->fetch(PDO::FETCH_NUM);
                    echo number_format($res[0], 2);
                    ?>
                </th>
            </tr>
            <?php
        } else {
            echo "<p style='text-align:center' class='mt-2'>No data found</p>"; 
        }
    } else {
        $stmt = $pdo->prepare("
            SELECT sell_payment.`payment_date`, sell_payment.`customer_id`, member.name, 
                   sell_payment.`payment_amount`, sell_payment.`payment_type` 
            FROM sell_payment 
            INNER JOIN member ON sell_payment.`customer_id` = member.`id` 
            WHERE `payment_date` BETWEEN ? AND ? AND sell_payment.`customer_id` = ?");
        $stmt->execute([$issu_first_date, $issu_end_date, $customer]);
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);

        if ($res) {
            $i = 0;
            foreach ($res as $data) {
                $i++;
                ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $data->payment_date; ?></td>
                    <td><?= $data->customer_id; ?></td>
                    <td><?= $data->name; ?></td>
                    <td><?= $data->payment_type; ?></td>
                    <td><?= number_format($data->payment_amount, 2); ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <th colspan="5" style="text-align:right;">Total:</th>
                <th>
                    <?php
                    $stmt = $pdo->prepare("SELECT SUM(`payment_amount`) FROM `sell_payment` WHERE `payment_date` BETWEEN ? AND ? AND `customer_id` = ?");
                    $stmt->execute([$issu_first_date, $issu_end_date, $customer]);
                    $res = $stmt->fetch(PDO::FETCH_NUM);
                    echo number_format($res[0], 2);
                    ?>
                </th>
            </tr>
            <?php
        } else {
            echo "<p style='text-align:center' class='mt-2'>No data found</p>"; 
        }
    }
}
?>
