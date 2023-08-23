<?php

session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['user_email'])
) {
    # datbase helper function
    include 'getDBConnection.php';

    if (isset($_POST['category_name'])) {
        
        # validation helper function
        include 'func_validation.php';

        $category_name = $_POST['category_name'];

        #simple form validation 
        $text = "Category name";
        $location = "../add-category.php";
        $ms = "error";
        is_empty($category_name, $text, $location, $ms, "");

        $sql = "insert into categories(name) values(?)";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$category_name]);
        if ($res) {
            $sm = "Successfully Added.";
            header("Location: ../add-category.php?success=$sm");
        } else {
            $em = "Unknown error ocurred!";
            header("Location: ../add-category.php?error=$em");
        }

    } else {
        header("Location: ../add-category.php");
    }

} else {
    header("Location: admin.php");
    exit;
}