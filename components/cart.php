<section id="mini-cart-overlay">
    <div id="mini-cart">
        <div class="mini-cart-title">
            <div class="title">
                <h3>CART</h3>
            </div>
        </div>
        <div class="mini-cart-top-products">
            <div class="top-products-title">
                <h3>My Products</h3>
            </div>
            <div class="no-pros-minicart-message">No Products in your cart Yet</div>
        </div>
        <div class="bottom-subtotal">
            <div class="subtotal">
                <h3>SUBTOTAL :</h3>
                <h3 id="mini-cart-total">$0.00</h3>
            </div>
            <div class="checkout">
                <button class="btn-applyfilters" onclick="window.location.href = 'cart.php'">View Cart</button>
                <?php
                if (isset($_SESSION['userid'])) {
                    echo "<a class='btn-clearfilters' href='checkout.php'>Checkout</a>";
                } else {
                    echo "<a class='btn-clearfilters' href='signin.php'>Login to checkout</a>";
                }
                ?>
            </div>
        </div>
    </div>
</section>