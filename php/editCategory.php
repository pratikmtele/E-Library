<?php

session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
) {
    # datbase helper function
    include 'getDBConnection.php';

    if (isset($_POST['category_name'])
        && isset($_POST['category_id'])) {
        
        # validation helper function
        include 'func_validation.php';

        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];

        #simple form validation 
        $text = "Category name";
        $location = "../add-category.php";
        $ms = "error";
        is_empty($category_name, $text, $location, $ms, "");

        $sql = "update categories set name=? where id=?";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$category_name, $category_id]);
        if ($res) {
            $sm = "Category updated.";
            header("Location: ../admin.php?success=$sm");
        } else {
            $em = "Unknown error ocurred!";
            header("Location: ../add-category.php?error=$em");
        }

    } else {
        header("Location: ../edit-category.php");
    }

} else {
    header("Location: ../admin.php");
    exit;
}