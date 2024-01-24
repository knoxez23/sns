<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="stylesheet" href="./css/catalog.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
    <script src="https://kit.fontawesome.com/2affe6feb2.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <!-- End TrustBox script -->
</head>

<body>
    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <?php include_once('./components/cart.php') ?>

        <section id="catalog">
            <aside class="left-section">
                <div class="sidebar-section">
                    <div class="top-section">
                        <a href="index.php">Main Page</a>
                    </div>
                    <div class="bottom-section">
                        <div class="top-filter-section">
                            <div class="filter-section-title">
                                <iconify-icon icon="bi:filter-left" width="28"></iconify-icon>
                                <h3>FILTERS</h3>
                            </div>
                            <button type="button" id="apply-filter-btn">Apply</button>
                        </div>
                        <div class="filters">
                            <div class="filter-category">
                                <div class="filters-filter-title">
                                    <h3>Filter by price</h3>
                                </div>
                                <div class="filter-content price-fil-range">
                                    <div class="inputs-fields">
                                        <div class="small-price">
                                            $<input type="number" class="input-min" value="0" id="min-price">
                                        </div>
                                        <div class="separator" style="font-family: Sawah;">-</div>
                                        <div class="big-price">
                                            $<input type="number" value="1000" id="max-price">
                                        </div>
                                    </div>
                                    <div class="price-slider">
                                        <div class="progress"></div>
                                    </div>
                                    <div class="range-input">
                                        <input type="range" class="range-min" min="0" max="1000" value="0">
                                        <input type="range" class="range-max" min="0" max="1000" value="1000">
                                    </div>
                                </div>
                            </div>
                            <div class="filter-category">
                                <div class="filters-filter-title">
                                    <h3>Filter by brand</h3>
                                </div>
                                <div class="filter-content content-fil">
                                    <div class="filter-crite">
                                        <input type="checkbox" name="brand[]" value="asos">Asos
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="brand[]" value="bulgari">Bulgari
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="brand[]" value="gucci">Gucci
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="brand[]" value="david yurman">David Yurman
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="brand[]" value="cartier">Cartier
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="brand[]" value="tiffany & co">Tiffany & co
                                    </div>
                                </div>
                            </div>
                            <div class="filter-category">
                                <div class="filters-filter-title">
                                    <h3>Filter by stock availability</h3>
                                </div>
                                <div class="filter-content content-fil">
                                    <div class="filter-crite">
                                        <input type="checkbox" name="stock[]" value="all">
                                        <label for="all-stock">All</label>
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="stock[]" value="instock">
                                        <label for="instock">In Stock</label>
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="stock[]" value="soldout">
                                        <label for="soldout">Out of Stock</label>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-category">
                                <div class="filters-filter-title">
                                    <h3>Filter by color</h3>
                                </div>
                                <div class="filter-content content-fil">
                                    <div class="filter-crite">
                                        <input type="checkbox" name="color[]" value="white">White
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="color[]" value="blue">Blue
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="color[]" value="black">Black
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="color[]" value="red">Red
                                    </div>
                                    <div class="filter-crite">
                                        <input type="checkbox" name="color[]" value="pink">Pink
                                    </div>
                                </div>
                            </div>
                            <div class="apply-clear-filters">
                                <div class="clear-filters">
                                    <button class="btn-clearfilters" onclick="window.location.reload()">Clear Filters</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="right-section">
                <div class="top-catalog-title-section">
                    <h2 id="catalog-full-title"></h2>
                    <div class="filters-sort">
                        <div class="grid-list-styling">
                            <h4 id="result-number-pros"></h4>
                        </div>
                        <div class="sorting-styling">
                            <h4>Sort By: </h4>
                            <div class="dropdown">
                                <select name="sorting" id="sortByMen">
                                    <option value="default">Default Sorting</option>
                                    <option value="latest">Sort By Latest</option>
                                    <option value="lotohi">Sort By Price: Low to High</option>
                                    <option value="hitolo">Sort By Price: High to Low</option>
                                    <option value="popularity">Sort By Popularity</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-catalog-section"></div>
            </div>
        </section>

        <div class="pagination"></div>

        <?php 
        include_once './components/topproducts.php';
        ?>

        <?php 
        include_once './components/footer.php';
        ?>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/filter.js"></script>
    <script src="./js/search.js"></script>
    <script src="./js/minicart.js"></script>
</body>

</html>