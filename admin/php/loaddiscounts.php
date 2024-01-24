<?php
include_once 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $arr = array();
    $stmt = "SELECT * FROM coupon ORDER BY date DESC";
    $prep_stmt = $conn->prepare($stmt);
    $prep_stmt->execute();
    if ($result = $prep_stmt->get_result()) {
        while ($couponrow = $result->fetch_assoc()) {
            array_push($arr, $couponrow);
        }
        $number = mysqli_num_rows($result);
        echo json_encode(['coupons' => $arr, 'number' => $number]);
    }
}
