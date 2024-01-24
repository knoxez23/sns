<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./css/signup.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
</head>

<body>
    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <?php include_once('./components/cart.php') ?>

        <section id="signup-section" class="section-p1">
            <div class="background-signin-left">
            </div>
            <div class="background-signin-right">
            </div>
            <div class="signup-form">
                <div class="signup-form-title">Sign Up</div>
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "emptyinputs") {
                        echo "<div id='message'>Please fill in all fields</div>";
                    } else if ($_GET['error'] == "stmtfailed") {
                        echo "<div id='message'>Something went wrong; Try again!</div>";
                    } else if ($_GET['error'] == "userexists") {
                        echo "<div id='message'>You are already a customer, <a href = 'signin.php'>log in</a> instead</div>";
                    }
                }
                ?>
                <form class="signup-actual-form" action="./php/signup.inc.php" method="POST" id="actual-form">
                    <div class="names-signup">
                        <div class="form-control">
                            <input type="text" id="Fname" name="Fname" placeholder="First Name">
                            <?php
                            if (isset($_GET['error'])) {
                                if ($_GET['error'] == "lettersonlyf") {
                                    echo "<i class='fa-solid fa-circle-exclamation'></i>";
                                    echo "<small>Alphabets only</small>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-control">
                            <input type="text" id="Lname" name="Lname" placeholder="Last Name">
                            <?php
                            if (isset($_GET['error'])) {
                                if ($_GET['error'] == "lettersonlyl") {
                                    echo "<i class='fa-solid fa-circle-exclamation'></i>";
                                    echo "<small>Alphabets only</small>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-control">
                        <input type="email" id="email" name="email" placeholder="Email">
                        <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == "invalidemail") {
                                echo "<i class='fa-solid fa-circle-exclamation'></i>";
                                echo "<small>Invalid Email</small>";
                            }
                        }
                        ?>
                    </div>
                    <div class="form-control">
                        <input type="password" id="pwd" name="pwd" placeholder="Password">
                        <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == "longerpassword") {
                                echo "<i class='fa-solid fa-circle-exclamation'></i>";
                                echo "<small>Please add a longer password</small>";
                            }
                        }
                        ?>
                    </div>
                    <div class="form-control">
                        <input type="password" id="repeatpwd" name="repeatpwd" placeholder="Repeat Password">
                        <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error'] == "passwordsdontmatch") {
                                echo "<i class='fa-solid fa-circle-exclamation'></i>";
                                echo "<small>Passwords do not match</small>";
                            }
                        }
                        ?>
                    </div>
                    <button type="submit" id="sign-up-btn-form">Sign Up</button>
                </form>
                
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
    <script src="./js/minicart.js"></script>
</body>

</html>