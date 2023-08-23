<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library - Sign up</title>
    <?php
    include 'template/bootstraplinks.html';
    ?>
    <link rel="stylesheet" href="css/navbarcss.css">

    <!-- favicon link -->
    <link rel="icon" href="images/book.png" type="image/png">

    <style>
        .signup-form {
            max-width: 30rem;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    include 'template/navbar.php';
    ?>

    <div class="d-flex justify-content-center p-5">
        <form class="p-5 rounded shadow signup-form" method="POST" action="php/usersignup.php">
            <h1 class="text-center">SIGNUP</h1>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($_GET['success']); ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="exampleInputname" class="form-label">Enter your name</label>
                <input type="text" class="form-control" id="exampleInputname" name="full_name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Signup</button>
        </form>
    </div>


    <script src="js/navbar.js"></script>
</body>

</html>