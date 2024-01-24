<?php
require 'db.php';

header('Access-Control-Allow-Origin: *');

if (isset($_GET['brand'])) {

    $brand = ($_GET['brand']);
    $arrayb = array();

    if (count($brand) > 0) {
        foreach ($brand as $val) {
            $stbmnt = "SELECT * FROM products WHERE brand = ?;";
            $prep_stbmnt = $conn->prepare($stbmnt);
            $prep_stbmnt->bind_param('s', $val);
            $prep_stbmnt->execute();
            if ($resultb = $prep_stbmnt->get_result()) {
                while ($rowArrayb = $resultb->fetch_assoc()) {
                    array_push($arrayb, $rowArrayb);
                }
            }
        }
        echo json_encode(['filters' => $arrayb]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }

    $prep_stbmnt->close();
    exit();
}

if (isset($_GET['color'])) {

    $color = ($_GET['color']);
    $arrayc = array();

    if (count($color) > 0) {
        foreach ($color as $col) {
            $stcmnt = "SELECT * FROM products WHERE color = ?;";
            $prep_stcmnt = $conn->prepare($stcmnt);
            $prep_stcmnt->bind_param('s', $col);
            $prep_stcmnt->execute();
            if ($resultc = $prep_stcmnt->get_result()) {
                while ($rowArrayc = $resultc->fetch_assoc()) {
                    array_push($arrayc, $rowArrayc);
                }
            }
        }
        echo json_encode(['filters' => $arrayc]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }

    $prep_stcmnt->close();
    exit();
}

if (isset($_GET['stock'])) {

    $stock = ($_GET['stock']);
    $arrays = array();

    if (count($stock) == 1) {
        if ($stock[0] == 'all') {
            $stment = "SELECT * FROM products WHERE status=1";
            if ($results = $conn->query($stment)) {
                while ($rowArrays = $results->fetch_assoc()) {
                    array_push($arrays, $rowArrays);
                }
            }
        } elseif ($stock[0] == 'instock') {
            $query = "SELECT * FROM products WHERE stock > 1;";
            if ($results = $conn->query($query)) {
                while ($rowArrays = $results->fetch_assoc()) {
                    array_push($arrays, $rowArrays);
                }
            }
        } elseif ($stock[0] === 'soldout') {
            $query = "SELECT * FROM products WHERE stock= 0;";
            if ($results = $conn->query($query)) {
                while ($rowArrays = $results->fetch_assoc()) {
                    array_push($arrays, $rowArrays);
                }
            }
        }
        echo json_encode(['filters' => $arrays]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }
    exit();
}

if (isset($_GET['maxvalue']) && isset($_GET['minvalue'])) {

    $minvalue = ($_GET['minvalue']);
    $maxvalue = ($_GET['maxvalue']);
    $arrayp = array();


    $stpmnt = "SELECT * FROM products WHERE price BETWEEN ? AND ?;";
    $prep_stpmnt = $conn->prepare($stpmnt);
    $prep_stpmnt->bind_param('ss', $minvalue, $maxvalue);
    $prep_stpmnt->execute();
    if ($resultp = $prep_stpmnt->get_result()) {
        while ($rowArrayp = $resultp->fetch_assoc()) {
            array_push($arrayp, $rowArrayp);
        }
        echo json_encode(['filters' => $arrayp]);
    } else {
        echo json_encode(['error' => 'Something went wrong. Try again later']);
    }

    $prep_stpmnt->close();
    exit();
}
