<?php
require_once 'db.php';

header('Access-Control-Allow-Origin: *');

$totals = 0;
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $productQty = $_POST['productQty'];

    for ($i = 0; $i < count($productId); $i++) {
        $stmnt = "SELECT * from products WHERE id = ?";
        $prep_stmnt = $conn->prepare($stmnt);
        $prep_stmnt->bind_param('s', $productId[$i]);
        $prep_stmnt->execute();
        if ($result = $prep_stmnt->get_result()) {
            $rowArray = $result->fetch_assoc()['price'];
            $prototal = $rowArray * $productQty[$i];
            global $totals;
            $totals = $totals + $prototal;
        }
    }
    $prep_stmnt->close();

    echo json_encode(['amount' => $totals]);
    exit();
}
