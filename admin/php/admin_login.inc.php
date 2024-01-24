<?php

include_once 'dbconn.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['pwd']) || empty($_POST['email'])) {
        header("location: ../admin.php?error=emptyinputs");
        exit();
    } else {
        $email = testinput($_POST['email']);
        $password = testinput($_POST['pwd']);
    }

    logInUser($conn, $email, $password);
} else {
    header("location: ../admin.php");
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
    $sql = "SELECT * FROM admins WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../admin.php?error=stmtfailed");
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

function logInUser($conn, $email, $passwd)
{
    $uidExists = userExists($conn, $email);

    if ($uidExists === false) {
        header("location: ../admin.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists['pwd'];
    $checkpwd = password_verify($passwd, $pwdHashed);

    if ($checkpwd === false) {
        header("location: ../admin.php?error=wronglogin");
        exit();
    } else if ($checkpwd === true) {
        session_start();

        $_SESSION['adminid'] = $uidExists['id'];
        $_SESSION['adminfname'] = $uidExists['fname'];
        $_SESSION['adminemail'] = $uidExists['email'];
        $_SESSION['adminlname'] = $uidExists['lname'];
        header("location: ../dashboard.php");
        exit();
    }
}
