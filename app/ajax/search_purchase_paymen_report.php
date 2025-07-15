<?php 
require_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    $issueData = $_POST['issuedate'];
    $customer = $_POST['customer'];

    $data = explode('-', $issueData);
    $issu_first_date = $obj->convertDateMysql(trim($data[0]));
    $issu_end_date = $obj->convertDateMysql(trim($data[1]));

    $params = [$issu_first_date, $issu_end_date];

    if ($customer === 'all') {
        $query = "
            SELECT 
                pp.payment_date,
                pp.suppliar_id,
                s.name,
                pp.payment_type,
                pp.payment_amount
            FROM purchase_payment pp
            INNER JOIN suppliar s ON pp.suppliar_id = s.id
            WHERE pp.payment_date BETWEEN ? AND ?
        ";
    } else {
        $query = "
            SELECT 
                pp.payment_date,
                pp.suppliar_id,
                s.name,
                pp.payment_type,
                pp.payment_amount
            FROM purchase_payment pp
            INNER JOIN suppliar s ON pp.suppliar_id = s.id
            WHERE pp.payment_date BETWEEN ? AND ? AND pp.suppliar_id = ?
        ";
        $params[] = $customer;
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($res) {
        $i = 0;
        $totalAmount = 0;
        foreach ($res as $data) {
            $i++;
            $totalAmount += $data->payment_amount;
            ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= htmlspecialchars($data->payment_date); ?></td>
                <td><?= htmlspecialchars($data->suppliar_id); ?></td>
                <td><?= htmlspecialchars($data->name); ?></td>
                <td><?= htmlspecialchars($data->payment_type); ?></td>
                <td><?= number_format($data->payment_amount, 2); ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Total:</th>
            <th><?= number_format($totalAmount, 2); ?></th>
        </tr>
        <?php
    } else {
        echo "<p class='pt-1' style='text-align:center;'>No data found</p>";
    }
}
?>
