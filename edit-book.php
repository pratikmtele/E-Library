<?php
session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
) {

    # database connectivity function
    include 'php/getDBConnection.php';

    # if category id is not set
    if (!isset($_GET['id'])) {
        header("Location: ../admin.php");
        exit;
    }

    $book_id = $_GET['id'];

    #authors helper function
    include 'php/func_books.php';
    $book = get_book($conn, $book_id);

    #authors helper function
    include 'php/func_author.php';
    $authors = getAllAuthor($conn);

    #categories helper function
    include 'php/func_category.php';
    $categories = getAllCategories($conn);

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Library - Edit Book</title>
        <!-- bootstrap CDN links -->
        <?php
        include 'template/bootstraplinks.html';
        ?>
        <!-- favicon link -->
        <link rel="icon" href="images/book.png" type="image/png">
    </head>

    <body>
        <?php
        include 'template/admin-navbar.html';
        ?>
        <div class="container" style="width: 50%; max-width: 50rem; margin: 0px auto;">
            <form action="php/editBook.php" method="POST" class="shadow p-4 rounded mt-5" enctype="multipart/form-data">
                <h4 class="text-center pb-5 display-4 fs-3">Edit Book</h4>

                <!-- display error message -->
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?= htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php } ?>

                <!-- display success message -->
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= htmlspecialchars($_GET['success']); ?>
                    </div>
                <?php } ?>

                <div class="mb-3">
                    <input hidden type="text" class="form-control" id="exampleInputText" name="book_id"
                        value="<?= $book['id'] ?>">

                    <label for="exampleInputEmail1" class="form-label">Book Title</label>
                    <input type="text" class="form-control" id="exampleInputText" name="book_title"
                        value="<?= $book['title'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputSelect" class="form-label">Book Author</label>
                    <select class="form-select" name="book_author">
                        <option value="0" selected>Select Author</option>
                        <?php
                        if ($authors == 0) {
                            # Do nothing
                        } else {
                            foreach ($authors as $author) {
                                if ($book['author_id'] == $author['id']) { ?>
                                    <option selected value="<?= $book['author_id'] ?>"><?= $author['name'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <Label class="form-label" for="floatingTextarea">Book Description</Label>
                    <input type="text" class="form-control" name="book_desc" value="<?= $book['description'] ?>"></input>
                </div>
                <div class="mb-3">
                    <label for="exampleInputSelect" class="form-label">Book Category</label>
                    <select class="form-select" name="book_category" aria-label="Default select example">
                        <option value="0" selected>Select Category</option>
                        <?php
                        if ($categories == 0) {
                            # Do nothing
                        } else {
                            foreach ($categories as $category) {
                                if ($book['category_id'] == $category['id']) { ?>
                                    ?>
                                    <option selected value="<?= $book['category_id'] ?>"><?= $category['name'] ?></option>
                                <?php } else { ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input hidden class="form-control" type="text" id="formFile" name="current_cover"
                        value="<?= $book['cover'] ?>">
                    <label for="formFile" class="form-label">Book Cover</label>
                    <input class="form-control" type="file" id="formFile" name="book_cover">
                    <a href="uploads/cover/<?= $book['cover'] ?>" class="link-dark" target="_blank">Current Cover</a>
                </div>
                <div class="mb-3">
                    <input hidden class="form-control" type="text" id="formFile" name="current_file"
                        value="<?= $book['filename'] ?>">
                    <label for="formFile" class="form-label">File</label>
                    <input class="form-control" type="file" id="formFile" name="book_file">
                    <a href="uploads/files/<?= $book['filename'] ?>" class="link-dark" target="_blank">Current file</a>
                </div>
                <button type="submit" class="btn btn-primary">Edit Book</button>
            </form>
        </div>
    </body>

    </html>
    <?php
} else {
    header("Location: index.php");
} ?>