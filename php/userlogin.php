<?php
session_start();
if (
    isset($_POST['login-email'])
    && isset($_POST['login-password'])
) {
    # database connection file
    include 'getDBConnection.php';

    # validation helper function
    include 'func_validation.php';

    $loginEmail = $_POST['login-email'];
    $loginPassword = $_POST['login-password'];

    #simple form validation 
    $text = "Email";
    $location = "../login.php";
    $ms = "error";
    is_empty($loginEmail, $text, $location, $ms, "");

    $text = "Password";
    $location = "../login.php";
    $ms = "error";
    is_empty($loginPassword, $text, $location, $ms, "");

    #search for email
    $sql = "select * from user where email=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$loginEmail]);

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();
        $user_id = $user['id'];
        $user_email = $user['email'];
        $user_password = $user['password'];

        if ($loginEmail === $user_email) {
            if ($loginPassword === $user_password) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $user_email;
                header("Location: ../index.php");
            }else {
                $em = "Incorrect username or password.";
                header("Location: ../login.php?error=$em");
            }
        }
    } else {
        $em = "Incorrect username or password.";
        header("Location: ../login.php?error=$em");
    }


} else {
    #redirect to the login page
    header("Location: ../login.php");
}

?>