<?php
if (
    isset($_POST['full_name'])
    && isset($_POST['email'])
    && isset($_POST['password'])
) {
    # database connection file
    include 'getDBConnection.php';

    # validation helper function
    include 'func_validation.php';

    $name = $_POST['full_name'];
    $singupEmail = $_POST['email'];
    $signupPassword = $_POST['password'];

    #simple form validation 
    $text = "Name";
    $location = "../signup.php";
    $ms = "error";
    is_empty($name, $text, $location, $ms, "");

    $text = "Email";
    $location = "../signup.php";
    $ms = "error";
    is_empty($singupEmail, $text, $location, $ms, "");

    $text = "Password";
    $location = "../signup.php";
    $ms = "error";
    is_empty($signupPassword, $text, $location, $ms, "");

    # insert user data into user table
    $sql = "insert into user(full_name, email, password) values(:full_name, :email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':full_name', $name);
    $stmt->bindParam(':email', $singupEmail);
    $stmt->bindParam(':password', $signupPassword);
    $stmt->execute();

    $sm = "Signup Successfully";
    header("Location: ../signup.php?success=$sm");

} else {
    #redirect to the login page
    header("Location: ../login.php");
}

?>