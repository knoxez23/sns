<?php
session_start();
if (!isset($_SESSION['adminid'])) {
    header('location: ./admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/products.css">
    <link rel="stylesheet" href="./css/sidebar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="icon" href="../assets/images/SN.png" type="image/png">
    <title>Admin</title>
</head>

<body>

    <div class="wrapper">

        <main id="visible-page-section">

            <?php
                include_once 'sidebar.php';
            ?>

            <section id="products-section" style="position: 'relative';">
                <div class="update-product">Update Successful</div>
                <div class="no-update-product">Update Failed</div>
                <div class="add-products-section">
                    <div class="add-products-title">Add Product</div>
                    <form class="add-products-contents" action="./php/addproduct.php" method="POST" enctype="multipart/form-data">
                        <div class="left-section">
                            <div class="product-name product">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="pro-name" placeholder="Name">
                            </div>
                            <div class="product-name product">
                                <label for="brand">Brand:</label>
                                <input type="text" name="brand" id="pro-brand" placeholder="Brand">
                            </div>
                            <div class="product-category product">
                                <div class="label">Category:</div>
                                <select name="category-name" id="select-category-name">
                                    <option value="men" selected>Men's</option>
                                    <option value="women">Women's</option>
                                    <option value="kids">Kids</option>
                                </select>
                            </div>
                            <div class="product-image product">
                                <label for="image">Main Image:</label>
                                <input type="file" id="pro-mainimg" name="main-image">
                            </div>
                            <div class="product-status product">
                                <div class="label">Status:</div>
                                <select id="select-product-status" name="pro-status">
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="product-price product">
                                <label for="price">Price:</label>
                                <input type="text" name="price" id="pro-price" placeholder="Price">
                            </div>
                            <div class="product-color product">
                                <label for="color">Color:</label>
                                    <input type="text" id="pro-color" name="color" placeholder="Color">
                            </div>
                            <div class="product-stock product">
                                <label for="stock">Stock:</label>
                                    <input type="text" id="pro-stock" name="stock" placeholder="Stock">
                            </div>
                        </div>
                        <div class="right-section">
                            <div class="right-section-prodetails">                                
                                <div class="product-shortDesc product">
                                    <label for="shortDesc">Short Description:</label>
                                    <input type="text" name="shortDesc" id="pro-shortdesc" placeholder="Short description">
                                </div>
                                <div class="product-smallimg product">
                                    <label for="smallimage">Alternate Image:</label>
                                    <input type="file" id="pro-smallimg" name="smallimage">
                                </div>                                
                                <div class="product-fullDesc">
                                    <label for="fullDesc">Full Description:</label>
                                    <textarea name="fullDesc" id="pro-fulldesc" cols="30" rows="10" placeholder="Full description"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="submit-btn">Add Product</button>
                        </div>
                    </form>
                </div>
                <div class="all-products-in-store">
                    <div class="all-products-title">Products in Store (<span id="total-products-no">0</span>)</div>
                    <div class="products-sort">
                        <label for="sort-by">Sort By:</label>
                        <select id="sort-by">
                            <option value="name">Name</option>
                            <option value="brand">Brand</option>
                            <option value="category">Category</option>
                            <option value="price">Price</option>
                            <option value="stock">Stock</option>
                            <option value="status">Status</option>
                            <option value="date">Date Added</option>
                        </select>
                    </div>
                    <div class="all-products-content">
                        <div class="all-products-classes-title">
                            <div class="product-id-title">
                                Id
                            </div>
                            <div class="product-image-title">
                                Image
                            </div>
                            <div class="product-name-title">
                                Name
                            </div>
                            <div class="product-brand-title">
                                Brand
                            </div>
                            <div class="product-category-title">
                                Category
                            </div>
                            <div class="product-price-title">
                                Price
                            </div>
                            <div class="product-stock-title">
                                Stock
                            </div>
                            <div class="product-status-title">
                                Status
                            </div>
                            <div class="product-date-title">
                                Date Added
                            </div>
                        </div>
                        <div class="all-products-classes-content"></div>
                    </div>
                </div>
                <div class="delete-products">
                    <div class="delete-products-title">Delete Product</div>
                    <form action='./php/deleteproduct.php' method='POST' class="delete-products-content">
                        <div class="product-delete-name">
                            <label for="dele-name">Product ID:</label>
                            <input type="number" name="dele-id" id="delete-pro-name" placeholder="Product Id">
                        </div>
                        <button type='submit' class="submit-btn">Delete</button>
                    </form>
                </div>
            </section>

        </main>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
    <script src="./js/products.js"></script>
    <script src="./js/app.js"></script>
</body>

</html>