<?php
require_once '../init.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length'];
$columnIndex = $_POST['order'][0]['column'];
$columnName = $_POST['columns'][$columnIndex]['data'];
$columnSortOrder = $_POST['order'][0]['dir'];
$searchValue = $_POST['search']['value'];

$searchArray = array();

## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " AND (id LIKE :id OR 
        invoice_number LIKE :invoice_number OR 
        customer_name LIKE :customer_name OR 
        order_date LIKE :order_date OR 
        paid_amount LIKE :paid_amount OR 
        payment_type LIKE :payment_type ) ";
   $searchArray = array( 
        'id'=>"%$searchValue%", 
        'invoice_number'=>"%$searchValue%",
        'customer_name'=>"%$searchValue%",
        'order_date'=>"%$searchValue%",
        'paid_amount'=>"%$searchValue%",
        'payment_type'=>"%$searchValue%",
   );
}

## Total number of records without filtering
$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM invoice");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM invoice WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$stmt = $pdo->prepare("SELECT * FROM invoice WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

foreach($searchArray as $key => $search){
   $stmt->bindValue(':'.$key, $search, PDO::PARAM_STR);
}
$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();
foreach($empRecords as $row){
   $data[] = array(
      "id" => $row['id'],
      "customer_name" => $row['customer_name'],
      "order_date" => $row['order_date'],
      "sub_total" => number_format($row['sub_total']),
      "prev_due" => number_format($row['pre_cus_due']),
      "net_total" => number_format($row['net_total']),
      "paid_amount" => number_format($row['paid_amount']),
      "due_amount" => number_format($row['due_amount']),
      "return_status" => $row['return_status'],
      "payment_type" => $row['payment_type'],
      "action" => '
         <div class="btns-group">
            <a href="index.php?page=view_sell&&view_id='.$row["id"].'" class="btn btn-primary btn-sm rounded-0"><i class="fa fa-eye"></i></a>
            <a href="index.php?page=return_sell&&reurn_id='.$row["id"].'" class="btn btn-dark btn-sm rounded-0 mx-3"><i class="fas fa-undo"></i></a>
            <a href="index.php?page=edit_sell&&edit_id='.$row["id"].'" class="btn btn-secondary btn-sm rounded-0"><i class="fas fa-edit"></i></a>
            <a href="index.php?page=sell_pay&&id='.$row['id'].'" class="dropdown-item">Pay now</a>
         </div>'
   );
}

## Response
$response = array(
   "draw" => intval($draw),
   "iTotalRecords" => $totalRecords,
   "iTotalDisplayRecords" => $totalRecordwithFilter,
   "aaData" => $data
);

echo json_encode($response);
