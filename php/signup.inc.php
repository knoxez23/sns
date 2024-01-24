<?php

require_once "db.php";


$fname = $lname = $email = $passwd = $rpasswd = '';
$fnameErr = $lnameErr = $emailErr = $passwdErr = $rpasswdErr = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST['Fname']) || empty($_POST['Lname']) || empty($_POST['email']) || empty($_POST['pwd']) || empty($_POST['repeatpwd'])) {
        header("location: ../signup.php?error=emptyinputs");
        exit();
    } else {
        $fname = testinput($_POST['Fname']);
        $lname = testinput($_POST['Lname']);
        $email = testinput($_POST['email']);
        $passwd = testinput($_POST['pwd']);
        $rpasswd = testinput($_POST['repeatpwd']);

        $uidExists = userExists($conn, $email);

        if (!preg_match("/^[a-zA-Z-']*$/", $fname)) {
            header("location: ../signup.php?error=lettersonlyf");
            exit();
        }

        if (!preg_match("/^[a-zA-Z-']*$/", $lname)) {
            header("location: ../signup.php?error=lettersonlyl");
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: ../signup.php?error=invalidemail");
            exit();
        }

        if ($passwd != $rpasswd) {
            header("location: ../signup.php?error=passwordsdontmatch");
            exit();
        }

        if ($passwd < 5) {
            header("location: ../signup.php?error=longerpassword");
            exit();
        }

        if ($uidExists === true) {
            header("location: ../signup.php?error=userexists");
            exit();
        } else if ($uidExists === false) {
            createUser($conn, $fname, $lname, $email, $passwd);
        }
    }
} else {
    header("location: ../signup.php");
    exit();
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
        return true;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function testinput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function createUser($conn, $fname, $lname, $email, $passwd)
{
    $sql = "INSERT INTO users(fname, lname, email, passwrd) VALUES(?,?,?,? );";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPasswd = password_hash($passwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $email, $hashedPasswd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signin.php");
    exit();
}
