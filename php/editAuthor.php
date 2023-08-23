<?php

session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
) {
    # datbase helper function
    include 'getDBConnection.php';

    if (isset($_POST['author_name'])
        && isset($_POST['author_id'])) {
        
        # validation helper function
        include 'func_validation.php';

        $author_id = $_POST['author_id'];
        $author_name = $_POST['author_name'];

        #simple form validation 
        $text = "author name";
        $location = "../edit-author.php";
        $ms = "error";
        is_empty($author_name, $text, $location, $ms, "");

        $sql = "update author set name=? where id=?";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute([$author_name, $author_id]);
        if ($res) {
            $sm = "Author name updated.";
            header("Location: ../admin.php?success=$sm");
        } else {
            $em = "Unknown error ocurred!";
            header("Location: ../add-category.php?error=$em");
        }

    } else {
        header("Location: ../edit-author.php");
    }

} else {
    header("Location: ../admin.php");
    exit;
}