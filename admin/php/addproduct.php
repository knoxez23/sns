<?php
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        $name = $_POST['name'];
        if(!empty($_POST['brand'])){
            $brand = $_POST['brand'];
        }else{
            $brand = null;
        }
        $cateName = $_POST['category-name'];
        $mainImage = 'https://www.shoesnstrides.com/assets/images/' . $_FILES['main-image']['name'];
        $mainImageLoc = '../../assets/images/' . basename($_FILES['main-image']['name']);
        $status = $_POST['pro-status'];
        $price = $_POST['price'];
        $shortDesc = $_POST['shortDesc'];
        $color = $_POST['color'];
        if(!empty($_FILES['smallimage']['name'])){
            $smallImage = 'https://www.shoesnstrides.com/assets/images/' . basename($_FILES['smallimage']['name']);
            $smallImageLoc = '../../assets/images/' . basename($_FILES['smallimage']['name']);
        } else {
            $smallImage = null;
        }
        $stock = $_POST['stock'];
        $fullDesc = $_POST['fullDesc'];


        move_uploaded_file($_FILES['main-image']['tmp_name'], $mainImageLoc);
        if(!empty($_FILES['smallimage']['name'])){
            move_uploaded_file($_FILES['smallimage']['tmp_name'], $smallImageLoc);
        }


        if ($cateName === 'men') {
            $actualCate = 1;
        } elseif ($cateName === 'women') {
            $actualCate = 2;
        } elseif ($cateName === 'kids') {
            $actualCate = 3;
        }

        if ($status === 'active') {
            $actualStatus = 1;
        } elseif ($status === 'inactive') {
            $actualStatus = 0;
        }

        $stmt = "INSERT INTO products(category_id, name, image, price, brand, status, fulldesc, shortdesc, smallimg1, color, stock) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $prep_stmt = $conn->prepare($stmt);
        $prep_stmt->bind_param('issdsissssi', $actualCate, $name, $mainImage, $price, $brand, $actualStatus, $fullDesc, $shortDesc, $smallImage1, $color, $stock);
        $prep_stmt->execute();
        $prep_stmt->close();

        header('location: ../../products.php');
        exit();
    } else {
        header('location: ../../products.php?error=emptyinput');
        exit();
    }
