<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./css/admin_signup.css">
</head>

<body>
    <div class="wrapper">

        <section id="signup-section">
            <div class="background-signin-left">
            </div>
            <div class="background-signin-right">
            </div>
            <div class="signup-form">
                <div class="signup-form-title">Admin Sign Up</div>
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == "emptyinputs") {
                        echo "<div id='message'>Please fill in all fields</div>";
                    } else if ($_GET['error'] == "stmtfailed") {
                        echo "<div id='message'>Something went wrong; Try again!</div>";
                    } else if ($_GET['error'] == "userexists") {
                        echo "<div id='message'>You are already in the system, <a href = '/html/admin.php'>log in</a> instead</div>";
                    }
                }
                ?>
                <form class="signup-actual-form" action="./php/admin_signup.inc.php" method="POST" id="actual-form">
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
                        <input type="text" id="email" name="email" placeholder="Email">
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
            </div>
        </section>

    </div>
</body>

</html>