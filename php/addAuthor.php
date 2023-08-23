<?php

session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
) {
    # datbase helper function
    include 'getDBConnection.php';

    if (isset($_POST['author_name'])) {
        # validation helper function
        include 'func_validation.php';

        $auhtor_name = $_POST['author_name'];

        #simple form validation 
        $text = "Author name";
        $location = "../add-author.php";
        $ms = "error";
        is_empty($auhtor_name, $text, $location, $ms, "");

        $sql = "insert into author(name) values(?)";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$auhtor_name]);
        if ($res) {
            $sm = "Successfully Added.";
            header("Location: ../add-author.php?success=$sm");
        } else {
            $em = "Unknown error ocurred!";
            header("Location: ../add-author.php?error=$em");
        }

    } else {
        header("Location: ../add-author.php");
    }

} else {
    header("Location: admin.php");
    exit;
}