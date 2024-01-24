<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign In</title>
    <link rel="stylesheet" href="./css/admin_signin.css">
</head>

<body>
    <div class="wrapper">

        <section id="signin-section" class="section-p1">
            <div class="background-signin-left">
            </div>
            <div class="background-signin-right">
            </div>
            <div class="signin-form">
                <div class="signin-form-title">Admin Sign In</div>
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
                <form id="actual-form" method="POST" action="./php/admin_login.inc.php">
                    <input type="hidden" id="last-location-input" name="location" value=''>
                    <div class="form-control">
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-control">
                        <input type="password" name="pwd" id="pwd" placeholder="Password" autocomplete>
                    </div>
                    <button type="submit" id="sign-in-btn-form">Sign In</button>
                </form>
            </div>
        </section>

    </div>

</body>

</html>