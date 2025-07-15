<?php 
require_once '../init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    $issueData = $_POST['issuedate'];
    $customer = $_POST['customer'];

    // Convert input date range
    $dates = explode('-', $issueData);
    $issu_first_date = $obj->convertDateMysql(trim($dates[0]));
    $issu_end_date = $obj->convertDateMysql(trim($dates[1]));

    // Base query and parameters
    $query = "SELECT * FROM `invoice` WHERE `order_date` BETWEEN :start AND :end";
    $params = [
        ':start' => $issu_first_date,
        ':end' => $issu_end_date
    ];

    if ($customer !== 'all') {
        $query .= " AND `customer_id` = :customer_id";
        $params[':customer_id'] = $customer;
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($results) {
        $i = 0;
        $total_net = $total_paid = $total_due = 0;

        foreach ($results as $data) {
            $i++;
            $total_net += $data->net_total;
            $total_paid += $data->paid_amount;
            $total_due += $data->due_amount;

            echo "<tr>
                    <td>{$i}</td>
                    <td>{$data->invoice_number}</td>
                    <td>{$data->order_date}</td>
                    <td>{$data->customer_id}</td>
                    <td>{$data->customer_name}</td>
                    <td>" . number_format($data->net_total, 2) . "</td>
                    <td>" . number_format($data->paid_amount, 2) . "</td>
                    <td>" . number_format($data->due_amount, 2) . "</td>
                  </tr>";
        }

        // Display totals row
        echo "<tr>
                <th colspan='5' style='text-align:right;'>Total:</th>
                <th>" . number_format($total_net, 2) . "</th>
                <th>" . number_format($total_paid, 2) . "</th>
                <th>" . number_format($total_due, 2) . "</th>
              </tr>";
    } else {
        echo "<tr><td colspan='8' style='text-align:center;'>No data found</td></tr>";
    }
}
?>
