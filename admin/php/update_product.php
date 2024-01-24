<?php

include_once 'dbconn.php';

$id = $_POST['id'];
$field = $_POST['field'];
$value = $_POST['value'];

$sql = "UPDATE products SET $field = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $value, $id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();

?>
