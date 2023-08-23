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
        $book_id = $_GET['id'];

        #simple validation
        if (empty($book_id)) {
            $em = "Error occured!";
            header("Locattion: ../admin?error=$em");
            exit;
        } else {
            # getting book cover and file from the database
            $sql = "select*  from books where id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$book_id]);

            if ($stmt->rowCount() > 0) {
                $book = $stmt->fetch();
                # deleting the book from the database
                $sql2 = "delete from books where id=?";
                $stmt2 = $conn->prepare($sql2);
                $res = $stmt2->execute([$book_id]);

                # if data is deleted from the database
                if ($res) {
                    # delete book cover and file from  the server
                    $cover = $book['cover'];
                    $file = $book['filename'];

                    $current_cover_path = "../uploads/cover/$cover";
                    $current_file_path = "../uploads/files/$file";

                    unlink($current_cover_path);
                    unlink($current_file_path);

                    $sm = "Book deleted!";
                    header("Location: ../admin.php?success=$sm");
                } else {
                    $em = "Something went wrong!";
                    header("Location: ../admin.php?error=$em");
                }
            } else {
                $em = "Error occured!";
                header("Locattion: ../admin?error=$em");
                exit;
            }
        }
    } else {
        header("Location: ../admin.php");
    }
} else {
    header("Location: ../admin.php");
    exit;
}