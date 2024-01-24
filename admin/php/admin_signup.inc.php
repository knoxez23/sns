<?php
include_once 'dbconn.php';

$fname = $lname = $email = $passwd = $rpasswd = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST['Fname']) || empty($_POST['Lname']) || empty($_POST['email']) || empty($_POST['pwd']) || empty($_POST['repeatpwd'])) {
        header("location: ../superadmin.php?error=emptyinputs");
        exit();
    } else {
        $fname = testinput($_POST['Fname']);
        $lname = testinput($_POST['Lname']);
        $email = testinput($_POST['email']);
        $passwd = testinput($_POST['pwd']);
        $rpasswd = testinput($_POST['repeatpwd']);

        $uidExists = userExists($conn, $email);

        if (!preg_match("/^[a-zA-Z-']*$/", $fname)) {
            header("location: ../superadmin.php?error=lettersonlyf");
            exit();
        }

        if (!preg_match("/^[a-zA-Z-']*$/", $lname)) {
            header("location: ../superadmin.php?error=lettersonlyl");
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: ../superadmin.php?error=invalidemail");
            exit();
        }

        if ($passwd != $rpasswd) {
            header("location: ../superadmin.php?error=passwordsdontmatch");
            exit();
        }

        if ($passwd < 5) {
            header("location: ../superadmin.php?error=longerpassword");
            exit();
        }

        if ($uidExists === true) {
            header("location: ../superadmin.php?error=userexists");
            exit();
        } else if ($uidExists === false) {
            createUser($conn, $fname, $lname, $email, $passwd);
        }
    }
} else {
    header("location: ../superadmin.php");
    exit();
}

function userExists($conn, $email)
{
    $sql = "SELECT * FROM admins WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../superadmin.php?error=stmtfailed");
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
    $sql = "INSERT INTO admins(fname, lname, email, pwd) VALUES(?,?,?,? );";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../superadmin.php?error=stmtfailed");
        exit();
    }

    $hashedPasswd = password_hash($passwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $email, $hashedPasswd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../admin.php");
    exit();
}
