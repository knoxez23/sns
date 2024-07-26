<?php $current_page = basename( $_SERVER["PHP_SELF"] ); ?>
<section id="catalog">
    <aside class="left-section">
        <div class="sidebar-section">
            <div class="bottom-section">
                <div class="top-filter-section">
                    <button type="button" id="apply-filter-btn">Apply</button>
                </div>
                <div class="filters">
                    <div class="filter-category">
                        <div class="filters-filter-title">
                            <h3>By price</h3>
                        </div>
                        <div class="filter-content price-fil-range">
                            <div class="inputs-fields">
                                <div class="small-price">
                                    <input type="number" class="input-min" value="0" id="min-price">
                                </div>
                                <div class="separator" style="font-family: Sawah;">-</div>
                                <div class="big-price">
                                    <input type="number" value="1000" id="max-price">
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
                            <h3>By brand</h3>
                        </div>
                        <div class="filter-content content-fil">
                            <div class="filter-crite">
                                <input type="checkbox" name="brand[]" value="nike">Nike
                            </div>
                            <div class="filter-crite">
                                <input type="checkbox" name="brand[]" value="adidas">Adidas
                            </div>
                            <div class="filter-crite">
                                <input type="checkbox" name="brand[]" value="puma">Puma
                            </div>
                            <div class="filter-crite">
                                <input type="checkbox" name="brand[]" value="vans">Vans
                            </div>
                            <div class="filter-crite">
                                <input type="checkbox" name="brand[]" value="converse">Converse
                            </div>
                            <div class="filter-crite">
                                <input type="checkbox" name="brand[]" value="new balance">New Balance
                            </div>
                        </div>
                    </div>
                    <div class="filter-category">
                        <div class="filters-filter-title">
                            <h3>By stock availability</h3>
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
                            <h3>By color</h3>
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
                    <button class="btn-clearfilters" onclick="window.location.reload()">Clear Filters</button> 
                </div>
            </div>
        </div>
    </aside>
    <div class="right-section">
        <div class="top-section">
            <div class="page_dir">
                <a href="index.php">Main Page</a>
                <iconify-icon class="path-arrow" icon="material-symbols-light:arrow-right" width="20"></iconify-icon>
                <div>
                    <a id="catalog-cate-path" href="#"><?php if($current_page == "mens.php") {
                    echo "Men";
                    } else if( $current_page == "womens.php") {
                        echo "Women";
                    } else if($current_page == "kids.php") {
                        echo "Kids";
                    }
                    ?></a>
                </div>
            </div>
            <div class="filter-section-title">
                <h3>FILTERS</h3>
                <iconify-icon id="filter-icon" icon="bi:filter-left" width="28"></iconify-icon>
            </div>
        </div>
        <div class="top-catalog-title-section">
            <div class="filters-sort">
                <h2 id="catalog-full-title">
                <?php if($current_page == "mens.php") {
                    echo "Men's";
                } else if($current_page == "womens.php") {
                    echo "Women's";
                } else if($current_page == "kids.php") {
                    echo "Kid's";
                }
                ?>
                </h2>
                <div class="grid-list-styling">
                    <h4 id="result-number-pros"></h4>
                </div>
                <div class="sorting-styling">
                    <h4>Sort By: </h4>
                    <div class="dropdown">
                        <select name="sorting" id="sort">
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