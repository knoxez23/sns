<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if (isset($_GET['sortAll'])) {

    $sort = ($_GET['sortAll']);
    $array = array();

    if ($sort === 'latest') {
        $stmnt1 = "SELECT * FROM products WHERE status= 1 ORDER BY added_on DESC;";
        if ($result1 = $conn->query($stmnt1)) {
            while ($rowArray1 = $result1->fetch_assoc()) {
                array_push($array, $rowArray1);
            }
            $totalpros = mysqli_num_rows($result1);
        }
    } else if ($sort === 'lotohi') {
        $stmnt2 = "SELECT * FROM products WHERE status= 1 ORDER BY price ASC;";
        if ($result2 = $conn->query($stmnt2)) {
            while ($rowArray2 = $result2->fetch_assoc()) {
                array_push($array, $rowArray2);
            }
            $totalpros = mysqli_num_rows($result2);
        }
    } else if ($sort === 'hitolo') {
        $stmnt3 = "SELECT * FROM products WHERE status= 1 ORDER BY price DESC;";
        if ($result3 = $conn->query($stmnt3)) {
            while ($rowArray3 = $result3->fetch_assoc()) {
                array_push($array, $rowArray3);
            }
            $totalpros = mysqli_num_rows($result3);
        }
    } else if ($sort === 'default') {
        $stmnt4 = "SELECT * FROM products WHERE status= 1;";
        if ($result4 = $conn->query($stmnt4)) {
            while ($rowArray4 = $result4->fetch_assoc()) {
                array_push($array, $rowArray4);
            }
            $totalpros = mysqli_num_rows($result4);
        }
    } else if ($sort === 'popularity') {
        $stmnt5 = "SELECT * FROM products WHERE status= 1 ORDER BY stock DESC;";
        if ($result5 = $conn->query($stmnt5)) {
            while ($rowArray5 = $result5->fetch_assoc()) {
                array_push($array, $rowArray5);
            }
            $totalpros = mysqli_num_rows($result5);
        }
    }

    echo json_encode(['sort' => $array, 'totalpros' => $totalpros]);
}


if (isset($_GET['sortKid'])) {

    $sort = ($_GET['sortKid']);
    $array = array();

    if ($sort === 'latest') {
        $stmnt1 = "SELECT * FROM products WHERE status= 1 AND category_id = 3 ORDER BY added_on DESC;";
        if ($result1 = $conn->query($stmnt1)) {
            while ($rowArray1 = $result1->fetch_assoc()) {
                array_push($array, $rowArray1);
            }
            $totalpros = mysqli_num_rows($result1);
        }
    } else if ($sort === 'lotohi') {
        $stmnt2 = "SELECT * FROM products WHERE status= 1 AND category_id = 3 ORDER BY price ASC;";
        if ($result2 = $conn->query($stmnt2)) {
            while ($rowArray2 = $result2->fetch_assoc()) {
                array_push($array, $rowArray2);
            }
            $totalpros = mysqli_num_rows($result2);
        }
    } else if ($sort === 'hitolo') {
        $stmnt3 = "SELECT * FROM products WHERE status= 1 AND category_id = 3 ORDER BY price DESC;";
        if ($result3 = $conn->query($stmnt3)) {
            while ($rowArray3 = $result3->fetch_assoc()) {
                array_push($array, $rowArray3);
            }
            $totalpros = mysqli_num_rows($result3);
        }
    } else if ($sort === 'default') {
        $stmnt4 = "SELECT * FROM products WHERE status= 1 AND category_id = 3;";
        if ($result4 = $conn->query($stmnt4)) {
            while ($rowArray4 = $result4->fetch_assoc()) {
                array_push($array, $rowArray4);
            }
            $totalpros = mysqli_num_rows($result4);
        }
    } else if ($sort === 'popularity') {
        $stmnt5 = "SELECT * FROM products WHERE status= 1 AND category_id = 3 ORDER BY stock DESC;";
        if ($result5 = $conn->query($stmnt5)) {
            while ($rowArray5 = $result5->fetch_assoc()) {
                array_push($array, $rowArray5);
            }
            $totalpros = mysqli_num_rows($result5);
        }
    }

    echo json_encode(['sort' => $array, 'totalpros' => $totalpros]);
}

if (isset($_GET['sortWomen'])) {

    $sort = ($_GET['sortWomen']);
    $array = array();

    if ($sort === 'latest') {
        $stmnt1 = "SELECT * FROM products WHERE status= 1 AND category_id = 2 ORDER BY added_on DESC;";
        if ($result1 = $conn->query($stmnt1)) {
            while ($rowArray1 = $result1->fetch_assoc()) {
                array_push($array, $rowArray1);
            }
            $totalpros = mysqli_num_rows($result1);
        }
    } else if ($sort === 'lotohi') {
        $stmnt2 = "SELECT * FROM products WHERE status= 1 AND category_id = 2 ORDER BY price ASC;";
        if ($result2 = $conn->query($stmnt2)) {
            while ($rowArray2 = $result2->fetch_assoc()) {
                array_push($array, $rowArray2);
            }
            $totalpros = mysqli_num_rows($result2);
        }
    } else if ($sort === 'hitolo') {
        $stmnt3 = "SELECT * FROM products WHERE status= 1 AND category_id = 2 ORDER BY price DESC;";
        if ($result3 = $conn->query($stmnt3)) {
            while ($rowArray3 = $result3->fetch_assoc()) {
                array_push($array, $rowArray3);
            }
            $totalpros = mysqli_num_rows($result3);
        }
    } else if ($sort === 'default') {
        $stmnt4 = "SELECT * FROM products WHERE status= 1 AND category_id = 2;";
        if ($result4 = $conn->query($stmnt4)) {
            while ($rowArray4 = $result4->fetch_assoc()) {
                array_push($array, $rowArray4);
            }
            $totalpros = mysqli_num_rows($result4);
        }
    } else if ($sort === 'popularity') {
        $stmnt5 = "SELECT * FROM products WHERE status= 1 AND category_id = 2 ORDER BY stock DESC;";
        if ($result5 = $conn->query($stmnt5)) {
            while ($rowArray5 = $result5->fetch_assoc()) {
                array_push($array, $rowArray5);
            }
            $totalpros = mysqli_num_rows($result5);
        }
    }

    echo json_encode(['sort' => $array, 'totalpros' => $totalpros]);
}


if (isset($_GET['sortMen'])) {

    $sort = ($_GET['sortMen']);
    $array = array();

    if ($sort === 'latest') {
        $stmnt1 = "SELECT * FROM products WHERE status= 1 AND category_id = 1 ORDER BY added_on DESC;";
        if ($result1 = $conn->query($stmnt1)) {
            while ($rowArray1 = $result1->fetch_assoc()) {
                array_push($array, $rowArray1);
            }
            $totalpros = mysqli_num_rows($result1);
        }
    } else if ($sort === 'lotohi') {
        $stmnt2 = "SELECT * FROM products WHERE status= 1 AND category_id = 1 ORDER BY price ASC;";
        if ($result2 = $conn->query($stmnt2)) {
            while ($rowArray2 = $result2->fetch_assoc()) {
                array_push($array, $rowArray2);
            }
            $totalpros = mysqli_num_rows($result2);
        }
    } else if ($sort === 'hitolo') {
        $stmnt3 = "SELECT * FROM products WHERE status= 1 AND category_id = 1 ORDER BY price DESC;";
        if ($result3 = $conn->query($stmnt3)) {
            while ($rowArray3 = $result3->fetch_assoc()) {
                array_push($array, $rowArray3);
            }
            $totalpros = mysqli_num_rows($result3);
        }
    } else if ($sort === 'default') {
        $stmnt4 = "SELECT * FROM products WHERE status= 1 AND category_id = 1;";
        if ($result4 = $conn->query($stmnt4)) {
            while ($rowArray4 = $result4->fetch_assoc()) {
                array_push($array, $rowArray4);
            }
            $totalpros = mysqli_num_rows($result4);
        }
    } else if ($sort === 'popularity') {
        $stmnt5 = "SELECT * FROM products WHERE status= 1 AND category_id = 1 ORDER BY stock DESC;";
        if ($result5 = $conn->query($stmnt5)) {
            while ($rowArray5 = $result5->fetch_assoc()) {
                array_push($array, $rowArray5);
            }
            $totalpros = mysqli_num_rows($result5);
        }
    }

    echo json_encode(['sort' => $array, 'totalpros' => $totalpros]);
}


if (isset($_GET['sortSale'])) {

    $sort = ($_GET['sortSale']);
    $array = array();

    if ($sort === 'latest') {
        $stmnt1 = "SELECT * FROM products WHERE status= 1 AND (prevprice-price)>70 ORDER BY added_on DESC;";
        if ($result1 = $conn->query($stmnt1)) {
            while ($rowArray1 = $result1->fetch_assoc()) {
                array_push($array, $rowArray1);
            }
            $totalpros = mysqli_num_rows($result1);
        }
    } else if ($sort === 'lotohi') {
        $stmnt2 = "SELECT * FROM products WHERE status= 1 AND (prevprice-price)>70 ORDER BY price ASC;";
        if ($result2 = $conn->query($stmnt2)) {
            while ($rowArray2 = $result2->fetch_assoc()) {
                array_push($array, $rowArray2);
            }
            $totalpros = mysqli_num_rows($result2);
        }
    } else if ($sort === 'hitolo') {
        $stmnt3 = "SELECT * FROM products WHERE status= 1 AND (prevprice-price)>70 ORDER BY price DESC;";
        if ($result3 = $conn->query($stmnt3)) {
            while ($rowArray3 = $result3->fetch_assoc()) {
                array_push($array, $rowArray3);
            }
            $totalpros = mysqli_num_rows($result3);
        }
    } else if ($sort === 'default') {
        $stmnt4 = "SELECT * FROM products WHERE status= 1 AND (prevprice-price)>70;";
        if ($result4 = $conn->query($stmnt4)) {
            while ($rowArray4 = $result4->fetch_assoc()) {
                array_push($array, $rowArray4);
            }
            $totalpros = mysqli_num_rows($result4);
        }
    } else if ($sort === 'popularity') {
        $stmnt5 = "SELECT * FROM products WHERE status= 1 AND (prevprice-price)>70 ORDER BY stock DESC;";
        if ($result5 = $conn->query($stmnt5)) {
            while ($rowArray5 = $result5->fetch_assoc()) {
                array_push($array, $rowArray5);
            }
            $totalpros = mysqli_num_rows($result5);
        }
    }

    echo json_encode(['sort' => $array, 'totalpros' => $totalpros]);
}
