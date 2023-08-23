<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library - Login</title>
    <?php
    include 'template/bootstraplinks.html'
        ?>
    <link rel="stylesheet" href="css/navbarcss.css">

    <!-- favicon link -->
    <link rel="icon" href="images/book.png" type="image/png">

    <style>
        .login-btn {
            visibility: hidden;
        }

        .login-form {
            max-width: 30rem;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    include 'template/navbar.php'
        ?>

    <div class="d-flex justify-content-center p-5">
        <form class="p-5 rounded shadow login-form" method="POST" action="php/userlogin.php">
            <h1 class="text-center">LOGIN</h1>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="login-email"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="login-password">
            </div>
            <div class="mb-3">
                <p>Don't have an account? <a href="signup.php">Create Account</a></p>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="js/navbar.js"></script>
</body>

</html>