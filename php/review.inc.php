<?php

include_once 'db.php';

header('Access-Control-Allow-Origin: *');


if (isset($_POST['rating_data']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id = testinput($_POST['user_id']);
    $user_name = testinput($_POST['user_name']);
    $rating = testinput($_POST['rating_data']);
    $product_id = testinput($_POST['product_id']);
    $comment = testinput($_POST['review']);



    $query = "INSERT INTO reviews(product_id, user_id, user_name, rating, comment) VALUES(?, ?, ?, ?, ?);";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $query)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }


    mysqli_stmt_bind_param($statement, "iisis", $product_id, $user_id, $user_name, $rating, $comment);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);


    echo "Your review successful";
}


if (isset($_GET['prodId'])) {

    $prodId = $_GET['prodId'];

    $stmt = "SELECT * FROM reviews WHERE product_id = ? ORDER BY id DESC;";
    $prep_stmt = $conn->prepare($stmt);
    $prep_stmt->bind_param('s', $prodId);
    $prep_stmt->execute();
    if ($result = $prep_stmt->get_result()) {
        $arr = array();
        while ($rowArray = $result->fetch_assoc()) {
            array_push($arr, $rowArray);
        }
        $totalreviews = mysqli_num_rows($result);
        echo json_encode(['reviews' => $arr, 'noofreviews' => $totalreviews]);
    }
};


function testinput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
