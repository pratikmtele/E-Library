<?php
session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
) {

    # datbase helper function
    include 'php/getDBConnection.php';

    #books helper function
    include 'php/func_books.php';
    $books = getAllBooks($conn);

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
        <title>E-Library - Admin</title>
        <!-- bootstrap CDN links -->
        <?php
        include 'template/bootstraplinks.html';
        ?>
        <!-- favicon link -->
        <link rel="icon" href="images/book.png" type="image/png">
        <style>
            #book-cover {
                width: 5rem;
                display: block;
                margin: 0px auto;
            }

            .search-btn {
                width: 100%;
                max-width: 30rem;
            }
        </style>
    </head>

    <body>
        <?php
        include 'template/admin-navbar.html';
        ?>
        <!-- main content -->
        <div class="container p-4">

            <form action="search.php" method="get">
                <div class="input-group mb-3 search-btn">
                    <input type="text" class="form-control" placeholder="Search book" aria-label="Search book"
                        aria-describedby="basic-addon2" name="key">
                    <button class="input-group-text btn btn-primary" id="basic-addon2">
                        <img src="images/search.png" alt="Search">
                    </button>
                </div>
            </form>

            <!-- display success message -->
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($_GET['success']); ?>
                </div>
            <?php } ?>

            <!-- List of all books -->
            <h4>All Books</h4>

            <?php if ($books == 0) { ?>
                <div class="alert alert-warning p-4 text-center" role="alert">
                    There is no book in the database.
                </div>
            <?php } else { ?>

                <table class="table table-bordered shadow">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($books as $book) {
                            $i++; ?>
                            <tr>
                                <td>
                                    <?= $i; ?>
                                </td>
                                <td>
                                    <img src="uploads/cover/<?= $book['cover'] ?>" alt="" id="book-cover">
                                    <a class="link-dark d-block text-center" target="_blank" style="display: flex;"
                                        href="uploads/files/<?= $book['filename'] ?>">
                                        <?= $book['title'] ?></a>
                                </td>
                                <td>
                                    <?php if ($authors == 0) {
                                        echo "Undefined";
                                    } else {
                                        foreach ($authors as $author) {
                                            if ($author['id'] == $book['author_id']) {
                                                echo $author['name'];
                                            }
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <?= $book['description'] ?>
                                </td>
                                <td>
                                    <?php if ($categories == 0) {
                                        echo "Undefined";
                                    } else {
                                        foreach ($categories as $category) {
                                            if ($category['id'] == $book['category_id']) {
                                                echo $category['name'];
                                            }
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <a href="edit-book.php?id=<?= $book['id'] ?>" class="btn btn-warning m-1">Edit</a>
                                    <a href="php/delete-book.php?id=<?= $book['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>


            <!-- List of all categories -->
            <h4 class="p-2">All Categories</h4>

            <?php if ($categories == 0) { ?>
                <div class="alert alert-warning p-4" role="alert">
                    There is no category in the database.
                </div>
            <?php } else { ?>
                <table class="table table-bordered shadow">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $j = 0;
                        foreach ($categories as $category) {
                            $j++; ?>
                            <tr>
                                <td>
                                    <?= $j ?>
                                </td>
                                <td>
                                    <?= $category['name'] ?>
                                </td>
                                <td>
                                    <a href="edit-category.php?id=<?= $category['id'] ?>" class="btn btn-warning m-1">Edit</a>
                                    <a href="php/deleteCategory.php?id=<?= $category['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>

            <!-- List of all authors  -->
            <h4 class="p-2">All Authors</h4>

            <?php if ($authors == 0) { ?>
                <div class="alert alert-warning p-4" role="alert">
                    There is no author in the database.
                </div>
            <?php } else { ?>
                <table class="table table-bordered shadow">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Author Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $k = 0;
                        foreach ($authors as $author) {
                            $k++; ?>
                            <tr>
                                <td>
                                    <?= $k ?>
                                </td>
                                <td>
                                    <?= $author['name'] ?>
                                </td>
                                <td>
                                    <a href="edit-author.php?id=<?= $author['id'] ?>" class="btn btn-warning m-1">Edit</a>
                                    <a href="php/deleteAuthor.php?id=<?= $author['id'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
        </div>
    </body>

    </html>

    <?php
} else {
    header("Location: index.php");
} ?>