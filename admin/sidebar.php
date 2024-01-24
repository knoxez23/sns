<section id="left-controls-section">
    <div class="left-section-top-part">
        <div class="admin-panel-logo">
            <div class="logo-picture">
                <h2>SN</h2>
            </div>
            <h4>Admin Panel</h4>
        </div>
        <div class="dashboard-btn <?php if (basename($_SERVER['PHP_SELF']) == 'dashboard.php'){echo 'active-left-btn';} ?> btns" onclick="window.location.href = 'dashboard.php'">
            <div class="dashboard btn-logo">
                <iconify-icon icon="clarity:home-line"></iconify-icon>
                <h4>Dashboard</h4>
            </div>
            <h5>D</h5>
        </div>
        <div class="products-btn <?php if (basename($_SERVER['PHP_SELF']) == 'products.php'){echo 'active-left-btn';} ?> btns" onclick="window.location.href = 'products.php'">
            <div class="products btn-logo">
                <iconify-icon icon="fluent-mdl2:product-variant"></iconify-icon>
                <h4>Products</h4>
            </div>
            <h5>P</h5>
        </div>
        <div class="audience-btn <?php if (basename($_SERVER['PHP_SELF']) == 'audience.php'){echo 'active-left-btn';} ?> btns" onclick="window.location.href = 'audience.php'">
            <div class="audience btn-logo">
                <iconify-icon icon="bi:people"></iconify-icon>
                <h4>Audience</h4>
            </div>
            <h5>A</h5>
        </div>
        <div class="orders-btn <?php if (basename($_SERVER['PHP_SELF']) == 'orders.php'){echo 'active-left-btn';} ?> btns" onclick="window.location.href = 'orders.php'">
            <div class="orders btn-logo">
                <iconify-icon icon="carbon:order-details"></iconify-icon>
                <h4>Orders</h4>
            </div>
            <h5>O</h5>
        </div>
        <div class="discounts-btn <?php if (basename($_SERVER['PHP_SELF']) == 'discounts.php'){echo 'active-left-btn';} ?> btns" onclick="window.location.href = 'discounts.php'">
            <div class="discounts btn-logo">
                <iconify-icon icon="la:shipping-fast"></iconify-icon>
                <h4>Discounts and Shipping</h4>
            </div>
            <h5>D</h5>
        </div>
        <div class="transaction-btn <?php if (basename($_SERVER['PHP_SELF']) == 'transactions.php'){echo 'active-left-btn';} ?> btns" onclick="window.location.href = 'transactions.php'">
            <div class="transaction btn-logo">
                <iconify-icon icon="icon-park-outline:transaction"></iconify-icon>
                <h4>Transactions</h4>
            </div>
            <h5>T</h5>
        </div>
    </div>
    <div class="left-section-bottom-part">
        <?php
        if (isset($_SESSION['adminid'])) {
            echo '<div class="logged-in-user-details">
            <div class="user_image">
                <iconify-icon icon="healthicons:ui-user-profile-outline" width="60"></iconify-icon>
            </div>
            <div class="name-and-email">
                <h4 id="user-name">' . $_SESSION['adminfname'] . ' ' . $_SESSION['adminlname'] . '</h4>
                <h4 id="user-email">' . $_SESSION['adminemail'] . '</h4>
            </div>
            <div class="logout-btn">
                <form action="./php/admin_logout.inc.php" method="POST">
                    <button>Logout</button>
                </form>
            </div>
        </div>';
        }
        ?>
    </div>
</section>