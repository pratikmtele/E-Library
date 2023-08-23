<?php

session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
) {
    # datbase helper function
    include 'getDBConnection.php';

    # validation helper function
    include 'func_validation.php';

    # file upload helper function
    include 'func_file_upload.php';

    if (
        isset($_POST['book_id'])
        && isset($_POST['book_title'])
        && isset($_POST['book_author'])
        && isset($_POST['book_desc'])
        && isset($_POST['book_category'])
        && isset($_POST['current_cover'])
        && isset($_POST['current_file'])
    ) {
        # retrieving the data from the html form
        $book_id = $_POST['book_id'];
        $book_title = $_POST['book_title'];
        $book_author = $_POST['book_author'];
        $book_desc = $_POST['book_desc'];
        $book_category = $_POST['book_category'];

        # get the current book cover and file from the html form
        $current_cover = $_POST['current_cover'];
        $current_file = $_POST['current_file'];

        #simple form validation 
        $text = "book title";
        $location = "../edit-book.php";
        $ms = "id=$book_id&error";
        is_empty($book_title, $text, $location, $ms, "");

        $text = "book author";
        $location = "../edit-book.php";
        $ms = "id=$book_id&error";
        is_empty($book_author, $text, $location, $ms, "");

        $text = "book description";
        $location = "../edit-book.php";
        $ms = "id=$book_id&error";
        is_empty($book_desc, $text, $location, $ms, "");

        $text = "book category";
        $location = "../edit-book.php";
        $ms = "id=$book_id&error";
        is_empty($book_category, $text, $location, $ms, "");


        if (!empty($_FILES['book_cover']['name'])) {
            # if admin try to update both
            if (!empty($_FILES['book_file']['name'])) {
                # update both here

                # book cover uploading
                $allowed_image_exs = array("jpg", "jpeg", "png");
                $path = "cover";
                $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

                # book file uploading
                $allowed_file_exs = array("pdf", "docx", "pptx");
                $file_path = "files";
                $book_file = upload_file($_FILES['book_file'], $allowed_file_exs, $file_path);

                # if error occured while uploading the book cover
                if (
                    $book_cover['status'] == 'error' ||
                    $book_file['status'] == 'error'
                ) {
                    $em = $book_cover['data'];
                    header("Location: ..edit-book.php?error=$em&id=$book_id");
                } else {
                    # current path of the cover
                    $current_cover_path = "../uploads/cover/$current_cover";

                    # current path of the file
                    $current_file_path = "../uploads/files/$current_file";

                    # deleting the book cover and file from the server.
                    unlink($current_cover_path);
                    unlink($current_file_path);

                    # getting the new file name and book cover name
                    $file_URL = $book_file['data'];
                    $book_cover_URL = $book_cover['data'];

                    # updating both file and book cover
                    $sql = "update books set cover=?, filename=?
                     where id=?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$book_cover_URL, $file_URL, $book_id]);

                    if ($res) {
                        # success message
                        $sm = "Successfully updated!";
                        header("Location: ../edit-book.php?success=$sm&id=$book_id");
                    } else {
                        # error message
                        $em = "Something went wrong!";
                        header("Location: ../edit-book.php?success=$em&id=$book_id");
                    }
                }
            } else {
                # update just book cover 

                # book cover uploading
                $allowed_image_exs = array("jpg", "jpeg", "png");
                $path = "cover";
                $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

                # if error occured while uploading the book cover
                if (
                    $book_cover['status'] == 'error'
                ) {
                    $em = $book_cover['data'];
                    header("Location: ..edit-book.php?error=$em&id=$book_id");
                } else {
                    # current path of the cover
                    $current_cover_path = "../uploads/cover/$current_cover";

                    # deleting the book cover and file from the server.
                    unlink($current_cover_path);
                    unlink($current_file_path);

                    # getting the new file name and book cover name
                    $book_cover_URL = $book_cover['data'];

                    # updating book cover
                    $sql = "update books set cover=?
                     where id=?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$book_cover_URL, $book_id]);

                    if ($res) {
                        # success message
                        $sm = "Successfully updated!";
                        header("Location: ../edit-book.php?success=$sm&id=$book_id");
                    } else {
                        # error message
                        $em = "Something went wrong!";
                        header("Location: ../edit-book.php?success=$em&id=$book_id");
                    }
                }
            }
        }
        if (!empty($_FILES['book_file']['name'])) {
            #updating file

            # book file uploading
            $allowed_file_exs = array("pdf", "docx", "pptx");
            $file_path = "files";
            $book_file = upload_file($_FILES['book_file'], $allowed_file_exs, $file_path);

            # if error occured while uploading the book cover
            if (
                $book_cover['status'] == 'error' ||
                $book_file['status'] == 'error'
            ) {
                $em = $book_cover['data'];
                header("Location: ..edit-book.php?error=$em&id=$book_id");
            } else {
                # current path of the file
                $current_file_path = "../uploads/files/$current_file";

                # deleting the file from the server.
                unlink($current_file_path);

                # getting the new file name and book cover name
                $file_URL = $book_file['data'];

                # updating both file and book cover
                $sql = "update books set filename=?
                 where id=?";
                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$file_URL, $book_id]);

                if ($res) {
                    # success message
                    $sm = "Successfully updated!";
                    header("Location: ../edit-book.php?success=$sm&id=$book_id");
                } else {
                    # error message
                    $em = "Something went wrong!";
                    header("Location: ../edit-book.php?success=$em&id=$book_id");
                }
            }
        } else {
            # update just the data
            $sql = "update books set title=?, author_id=?, description=?, category_id=?
                    where id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$book_title, $book_author, $book_desc, $book_category, $book_id]);

            if ($res) {
                # success message
                $sm = "Successfully updated!";
                header("Location: ../edit-book.php?success=$sm&id=$book_id");
            } else {
                # error message
                $em = "Something went wrong!";
                header("Location: ../edit-book.php?success=$em&id=$book_id");
            }
        }
    } else {
        header("Location: ../edit-book.php");
    }
} else {
    header("Location: ../admin.php");
    exit;
}