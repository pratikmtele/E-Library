<?php
session_start();
if (
    isset($_SESSION['admin_id'])
    && isset($_SESSION['admin_email'])
) {
    # datbase helper function
    include 'php/getDBConnection.php';

    #categories helper function
    include 'php/func_category.php';

    # if category id is not set
    if (!isset($_GET['id'])) {
        header("Location: ../admin.php");
        exit;
    }

    $category_id = $_GET['id'];

    # get category by ID
    $category = get_Category($category_id, $conn)


        ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-Library - Edit Category</title>
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
            <form action="php/editCategory.php" method="POST" class="shadow p-4 rounded mt-5">
                <h4 class="text-center pb-5 display-4 fs-3">Edit Category</h4>

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
                    <label for="exampleInputEmail1" class="form-label">Category name</label>
                    <input hidden type="text" name="category_id" value="<?= $category['id'] ?>">
                    <input type="text" class="form-control" id="exampleInputText" name="category_name"
                        value="<?= $category['name'] ?>">
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