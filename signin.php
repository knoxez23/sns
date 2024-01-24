<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./css/signin.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
</head>

<body>
    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <?php include_once('./components/cart.php') ?>

        <section id="signin-section" class="section-p1">
            <div class="background-signin-left">
            </div>
            <div class="background-signin-right">
            </div>
            <div class="signin-form">
                <div class="signin-form-title">Sign In</div>
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "emptyinputs") {
                        echo "<div id='message'>Please fill all the fields</div>";
                    } else if ($_GET['error'] == "stmtfailed") {
                        echo "<div id='message'>Something went wrong; Try again!</div>";
                    } else if ($_GET['error'] == "wronglogin") {
                        echo "<div id='message'>Wrong email or password</div>";
                    }
                }
                ?>
                <form id="actual-form" method="POST" action="./php/login.inc.php">
                    <input type="hidden" id="last-location-input" name="location" value=''>
                    <div class="form-control">
                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-control">
                        <input type="password" name="pwd" placeholder="Password" autocomplete>
                    </div>
                    <button type="submit" id="sign-in-btn-form">Sign In</button>
                </form>
                <div class="signup-option">
                    <span>Don't have an account?</span><a href="signup.php">Create one here</a>
                </div>
            
                
                <div class="copyright-signin-text">
                    Copyright <i class="fa-regular fa-copyright"></i> 2023 - &nbsp;&nbsp; SN
                </div>
            </div>
        </section>

        <?php 
        include_once './components/footer.php';
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/signin.js"></script>
    <script src="./js/minicart.js"></script>
</body>

</html>