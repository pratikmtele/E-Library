<?php

session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
) {
    # datbase helper function
    include 'getDBConnection.php';

    # file upload helper function
    include 'func_file_upload.php';

    # validation helper function
    include 'func_validation.php';

    // checking the all variables are set or not
    if (
        isset($_POST['book_title']) &&
        isset($_POST['book_author']) &&
        isset($_POST['book_desc']) &&
        isset($_POST['book_category']) &&
        isset($_FILES['book_cover']) &&
        isset($_FILES['book_file'])
    ) {

        $book_title = $_POST['book_title'];
        $book_author = $_POST['book_author'];
        $book_desc = $_POST['book_desc'];
        $book_category = $_POST['book_category'];

        #making URL data format
        $user_input = 'title='.$book_title.'&category='.$book_category.'&desc='.$book_desc.
                        '&author='.$book_author;

        #simple form validation 
        $text = "book title";
        $location = "../add-book.php";
        $ms = "error";
        is_empty($book_title, $text, $location, $ms, $user_input);

        $text = "book author";
        $location = "../add-book.php";
        $ms = "error";
        is_empty($book_author, $text, $location, $ms, $user_input);

        $text = "book description";
        $location = "../add-book.php";
        $ms = "error";
        is_empty($book_desc, $text, $location, $ms, $user_input);

        $text = "book category";
        $location = "../add-book.php";
        $ms = "error";
        is_empty($book_category, $text, $location, $ms, $user_input);

        # book cover uploading

        $allowed_image_exs = array("jpg", "jpeg", "png");
        $path = "cover";
        $book_cover = upload_file($_FILES['book_cover'], $allowed_image_exs, $path);

        if ($book_cover['status'] == "error") {
            $em = $book_cover['data'];
            header("Location: ../add-book.php?error=$em&$user_input");
        } else {
            # book file uploading
            $allowed_file_exs = array("pdf", "docx", "pptx");
            $file_path = "files";
            $book_file = upload_file($_FILES['book_file'], $allowed_file_exs, $file_path);

            if ($book_file['status'] == "error") {
                $em = $book_file['data'];
                header("Location: ../add-book.php?error=$em&$user_input");
            } else {
                # getting the new file name and book cover name
                $file_URL = $book_file['data'];
                $book_cover_URL = $book_cover['data'];

                # insert the data into database
                $sql = "INSERT INTO books(title, author_id, description, category_id, cover, filename)
                        VALUES(?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$book_title, $book_author, $book_desc, $book_category, $book_cover_URL, $file_URL]);
                if ($res) {
                    $sm = "Successfully Added.";
                    header("Location: ../add-book.php?success=$sm&$user_input");
                } else {
                    $em = "Unknown error ocurred!";
                    header("Location: ../add-book.php?error=$em&$user_input");
                }
            }

        }

    } else {
        $em = "Fill all required fields.";
        header("Location: ../add-book.php?error=$em");
    }

} else {
    header("Location: admin.php");
    exit;
}