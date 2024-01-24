<footer id="footer">
    <div class="footer-bg">
        <div class="top-links">
            <div class="explore">
                <div class="explore-title">
                    <h3>Explore</h3>
                </div>
                <div class="explore-links">
                    <div class="explore-links-id"><a href="mens.php">Men's</a></div>
                    <div class="explore-links-id"><a href="womens.php">Women's</a></div>
                    <div class="explore-links-id"><a href="kids.php">Kids</a></div>
                </div>
            </div>
            <div class="explore">
                <div class="explore-title">
                    <h3>Account</h3>
                </div>
                <div class="explore-links">
                    <div class="explore-links-id"><a href="signin.php">Sign in</a></div>
                    <div class="explore-links-id"><a href="signup.php">Sign up</a></div>
                    <?php
                    if (isset($_SESSION['userid'])) {
                        echo "<div class='account-links-id'><a href='account.php'>Profile</a></div>";
                    } else {
                        echo "";
                    }
                    ?>
                </div>
            </div>
            <div class="explore">
                <div class="explore-title">
                    <h3>Store</h3>
                </div>
                <div class="explore-links">
                    <div class="explore-links-id"><a href="contact.php">Contact Us</a></div>
                    <div class="explore-links-id"><a href="womens.php">Women's</a></div>
                </div>
            </div>
            <div class="explore">
                <?php 
                    include_once './components/newsletter.php';
                ?>
            </div>
            <div class="trustpilot">
                <!-- TrustBox widget - Review Collector -->
                <div class="trustpilot-widget" data-locale="en-US" data-template-id="56278e9abfbbba0bdcd568bc" data-businessunit-id="6583538b22c458172f594bcb" data-style-height="52px" data-style-width="100%">
                    <a href="https://www.trustpilot.com/review/snshop.co.ke" target="_blank" rel="noopener">Trustpilot</a>
                </div>
                <!-- End TrustBox widget -->
            </div>
            <div class="main-logo">
                <h2>SNS</h2>
            </div>
        </div>
        
        <div class="copyright">
            <div class="copyright-text">
                <h3>Copyright <i class="fa-regular fa-copyright"></i> 2023 - &nbsp;<span>SN Shop</span> &nbsp All Rights Reserved</h3>
            </div>
            <div class="copyright-text">
                <h3>Designed by <a href="#">VL Studios</a></h3>
            </div>
            <div class="social-links">
                <div class="social-links-title">
                    <h3>Socials</h3>
                </div>
                <div class="social-links-icons">
                    <a href="https://www.facebook.com/sn.shop.ke?mibextid=ZbWKwL" target="_blank" rel="noopener noreferrer">
                        <iconify-icon icon="akar-icons:facebook-fill" width="20"></iconify-icon>
                    </a>
                    <a href="https://www.instagram.com/sn_shop_ke?igshid=YTQwZjQ0NmI0OA==" target="blank" rel="noopener noreferrer">
                        <iconify-icon icon="akar-icons:instagram-fill" width="20"></iconify-icon>
                    </a>
                    <a href="https://x.com/snshopke?t=2-2aVUjso7WQ83p8gYS_9Q&s=08" target="blank" rel="noopener noreferrer">
                        <iconify-icon icon="akar-icons:twitter-fill" width="20"></iconify-icon>
                    </a>
                    <a href="https://pin.it/4oAzS1C" target="blank" rel="noopener noreferrer">
                        <iconify-icon icon="akar-icons:pinterest-fill" width="20"></iconify-icon>
                    </a>
                    <a href="https://wa.me/254731313123" target="blank" rel="noopener noreferrer">
                        <iconify-icon icon="akar-icons:whatsapp-fill" width="20"></iconify-icon>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>