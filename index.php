<?php
session_start();

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
    <title>E-Library</title>

    <!-- Boostrap =5 CDN Links -->
    <?php
    include 'template/bootstraplinks.html'
        ?>

    <!-- css links -->
    <link rel="stylesheet" href="css/navbarcss.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- favicon link -->
    <link rel="icon" href="images/book.png" type="image/png">

    <style>
        .container-fluid {
            display: flex;
            flex-direction: column;
        }

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

        .card {
            height: 60vh;
        }
    </style>
</head>

<body>
    <?php
    include 'template/navbar.php'
        ?>

    <div class="container-fluid m-0 p-0">
        <!-- search Books -->
        <form action="user-search.php" method="get" class="search-btn">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search book" aria-label="Search book"
                    aria-describedby="basic-addon2" name="key">
                <button class="input-group-text btn btn-primary" id="basic-addon2">
                    <img src="images/search.png" alt="Search">
                </button>
            </div>
        </form>

        <div class="d-flex">
            <div class="all_books">
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
                                    <p class="card-text p-1 card-desc" style="padding: 2px 10px !important;">
                                        <?= $book['description'] ?>
                                    </p>
                                    <?php if (
                                        isset($_SESSION['user_id'])
                                        && isset($_SESSION['user_email'])
                                    ) { ?>
                                        <div class="d-flex buttons m-1">
                                            <a href="uploads\files\<?= $book['filename'] ?>" target="_blank" title="<?= $book['title']?>"
                                                 class="btn btn-success">Open</a>
                                            <a href="uploads\files\<?= $book['filename'] ?>" class="btn btn-primary"
                                                download="<?= $book['title']?>">Download</a>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

            </div>
            <div class="aside">
                <ul class="list-group">
                    <li class="list-group-item group-item-action active">Category</li>
                    <?php foreach ($categories as $category) { ?>
                        <a href="category_books.php?id=<?= $category['id'] ?>"
                            class=" list-items list-group-item group-item-action" value="<?= $category['id'] ?>"><?= $category['name'] ?></a>
                    <?php } ?>
                </ul>

                <ul class="list-group author-list">
                    <li class="list-group-item group-item-action active">Author</li>
                    <?php foreach ($authors as $author) { ?>
                        <a href="author_book.php?id=<?= $author['id'] ?>"
                            class="list-items list-group-item group-item-action" value="<?= $author['id'] ?>"><?= $author['name'] ?></a>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-- footer section -->
        <?php include 'template/footer.php' ?>
    </div>
    <!-- Navbar javascript file path -->
    <script src="js/navbar.js"></script>
</body>

</html>