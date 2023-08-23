<?php

session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
) {
    # datbase helper function
    include 'getDBConnection.php';

    if (isset($_GET['id'])) {

        # get data from GET Method
        $category_id = $_GET['id'];

        #simple validation
        if (empty($category_id)) {
            $em = "Error occured!";
            header("Locattion: ../admin?error=$em");
            exit;
        } else {
                # deleting the book from the database
                $sql = "delete from categories where id=?";
                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$category_id]);

                if ($res) {
                    $sm = "Category deleted!";
                    header("Location: ../admin.php?success=$sm");
                } else {
                    $em = "Something went wrong!";
                    header("Location: ../admin.php?error=$em");
                }
        }
    } else {
        header("Location: ../admin.php");
    }
} else {
    header("Location: ../admin.php");
    exit;
}