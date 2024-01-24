<section id="header">
    <div id="elogo"><a href="index.php" title="Home">SNS</a></div>
    <div class="nav-categories">
        <ul>
            <li>
                <a href="mens.php">Men's</a>            
            </li>
            <li>
                <a href="womens.php">Women's</a>            
            </li>
            <li>
                <a href="kids.php">Kids</a>            
            </li>
            <li>
                <a href="contact.php">Contact</a>            
            </li>
        </ul> 
    </div>
    <div id="search-container">
        <input type="search" id="search-input" placeholder="Search for shoe">
        <button id="search" class="btn-submit">Search</button>
    </div>
    <div id="right-links">
        <div class="trustpilot">
            <!-- TrustBox widget - Review Collector -->
            <div class="trustpilot-widget" data-locale="en-US" data-template-id="56278e9abfbbba0bdcd568bc" data-businessunit-id="6583538b22c458172f594bcb" data-style-height="52px" data-style-width="100%">
                <a href="https://www.trustpilot.com/review/snshop.co.ke" target="_blank" rel="noopener">Trustpilot</a>
            </div>
            <!-- End TrustBox widget -->
        </div>
        <div class="right-links">
            <a href="wishlist.php" id="wishlist">
                <iconify-icon icon="bi:bag-heart" width="25"></iconify-icon>
                <div class="wishlist-qty">0</div>
            </a>
            <a href="cart.php" id="cart">
                <iconify-icon icon="game-icons:shopping-cart" width="30"></iconify-icon>
                <div class="cart-qty">0</div>
            </a>
            <?php
            if (isset($_SESSION['userid'])) {
                echo "<div class='logged-in' onclick='goToAccountPage()'><iconify-icon icon='healthicons:ui-user-profile-outline' width='30'></iconify-icon><h4>" . $_SESSION['username'] . "</h4></div>";
            } else {
                echo "<a id='signin' href='signin.php'><h5>Sign in</h5></a>";
            }
            ?>
        </div>
    </div>
</section>