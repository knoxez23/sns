<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
    <link rel="stylesheet" href="./css/contact.css">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="icon" href="./assets/images/SN.png" type="image/png">
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <!-- End TrustBox script -->
</head>

<body>

    <div class="wrapper">
        <?php include_once('./components/header.php'); ?>

        <?php include_once('./components/cart.php') ?>

        <form id='contact'>
            <div class='intro'>
                <h1>Love to hear from you, Get in touch👋</h1>
            </div>
            <div class='name-email'>
                <div class='name'>
                    <label for="name">Your name</label>
                    <input type="text" name="name" id="name-contact" placeholder='Your name'>
                </div>
                <div class='email'>
                    <label for="email">Your email</label>
                    <input type="email" name="email" id="email-contact" placeholder='Your email'>
                </div>
            </div>
            <div class='message'>
                <label for="message">Message</label>
                <textarea name="message" id="message-contact" cols="30" rows="10" placeholder='Your message'></textarea>
            </div>
            <button type='button' class='send-msg'>Send</button>
        </form>

        <?php 
        include_once './components/footer.php';
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="./js/app.js"></script>
    <script src="./js/contact.js"></script>
</body>

</html>