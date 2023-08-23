<?php
session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
) {
    # datbase helper function
    include 'php/getDBConnection.php';

    #categories helper function
    include 'php/func_author.php';

    # if category id is not set
    if (!isset($_GET['id'])) {
        header("Location: ../admin.php");
        exit;
    }

    $author_id = $_GET['id'];

    # get author by ID
    $author = get_author($author_id, $conn);

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Library - Edit Author</title>
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
            <form action="php/editAuthor.php" method="POST" class="shadow p-4 rounded mt-5">
                <h4 class="text-center pb-5 display-4 fs-3">Edit Author</h4>

                <!-- display error message -->
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?= htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php } ?>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Author name</label>
                    <input hidden type="text" name="author_id" value="<?= $author['id'] ?>">
                    <input type="text" class="form-control" id="exampleInputText" name="author_name"
                        value="<?= $author['name'] ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </body>

    </html>
    <?php
} else {
    header("Location: index.php");
} ?>