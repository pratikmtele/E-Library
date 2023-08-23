<?php
session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
    && isset($_GET['key'])
    && !empty($_GET['key'])
) {

    $key = $_GET['key'];

    # datbase helper function
    include 'php/getDBConnection.php';

    #books helper function
    include 'php/func_books.php';
    $books = search_books($conn, $key);

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
        <link rel="stylesheet" href="css/style.css">
        <!-- favicon link -->
        <link rel="icon" href="images/book.png" type="image/png">
        <style>

            .container-fluid .search-btn {
                margin-top: 20px;
                margin-left: 20px;
                width: 100%;
                max-width: 30rem;
            }

            .d-flex {
                flex-direction: row;
                place-content: flex-start;
            }

            .all_books {
                width: 75%;
                margin-left: 10px;
            }

            #book-cover {
                width: 5rem;
                display: block;
                margin: 0px auto;
            }

            .aside {
                width: 23%;
                margin-top: 15%;
                margin-bottom: 10px;
            }

            .aside .list-group .list-item-action:hover {
                cursor: pointer;
            }

            .aside .author-list {
                margin-top: 20%;
            }

            .card-desc {
                height: 78px;
                overflow: hidden;
            }
        </style>
        <!-- bootstrap CDN links -->
        <?php
        include 'template/bootstraplinks.html';
        ?>
    </head>

    <body>
        <?php
        include 'template/admin-navbar.html';
        ?>

        <div class="d-flex m-2">
            <?php if ($books == 0) { ?>
                <div class="alert alert-warning p-4 text-center pdf-list" role="alert">
                    <img src="images/no-results.png" alt="No Results">
                    <p>The key <b>"
                            <?= $key ?>"
                        </b> didn't match to any record.</p>
                </div>
            <?php } else { ?>
                <div class="pdf-list d-flex flex-wrap">
                    <?php foreach ($books as $book) { ?>
                        <div class="card m-2">
                            <img src="uploads\cover\<?= $book['cover'] ?>" class="img-top">
                            <p class="card-title text-center">
                                <?= $book['title'] ?>
                            </p>
                            <p class="card-text p-1 card-desc">
                                <?= $book['description'] ?>
                            </p>
                            <div class="d-flex buttons m-1">
                                <a href="uploads\files\<?= $book['filename'] ?>" target="_blank" class="btn btn-success">Open</a>
                                <a href="uploads\files\<?= $book['filename'] ?>" class="btn btn-primary"
                                    download="<?= $book['title'] ?>">Download</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>

    </body>

    </html>

    <?php
} else {
    header("Location: admin.php");
    exit;
} ?>