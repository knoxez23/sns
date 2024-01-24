<?php

require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['pwd']) || empty($_POST['email'])) {
        header("location: ../signin.php?error=emptyinputs");
        exit();
    } else {
        $location = $_POST['location'];
        $email = testinput($_POST['email']);
        $password = testinput($_POST['pwd']);
    }

    logInUser($conn, $email, $password, $location);
} else {
    header("location: ../signin.php");
    exit();
}

function testinput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function userExists($conn, $email)
{
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signin.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function logInUser($conn, $email, $password, $location)
{
    $uidExists = userExists($conn, $email);

    if ($uidExists === false) {
        header("location: ../signin.php?error=notthere");
        exit();
    }
    
    $pwdHashed = $uidExists['passwrd'];

    $checkpwd = password_verify($password, $pwdHashed);

    if ($checkpwd === false) {
        header("location: ../signin.php?error=wronglogin");
        exit();
    } else if ($checkpwd === true) {
        session_start();

        $_SESSION['userid'] = $uidExists['id'];
        $_SESSION['username'] = $uidExists['Fname'];
        $_SESSION['userlast'] = $uidExists['Lname'];
        $_SESSION['useremail'] = $uidExists['email'];
        $_SESSION['userdate'] = $uidExists['date'];
        $_SESSION['usercontact'] = $uidExists['phone_number'];
        $_SESSION['usercity'] = $uidExists['city'];
        $_SESSION['userstate'] = $uidExists['state'];
        $_SESSION['usercountry'] = $uidExists['country'];
        $_SESSION['useraddress'] = $uidExists['home_address'];
        $_SESSION['userdob'] = $uidExists['dob'];
        if ($location == '') {
            header("location: ../index.php");
            exit();
        } else {
            header("location: https://snshop.co.ke" . $location);
            exit();
        }
    }
}
