<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library - Contact Us</title>
    <!-- Boostrap5 CDN Links -->
    <?php
    include 'template/bootstraplinks.html'
        ?>
    <!-- css links -->
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbarcss.css">

    <!-- favicon link -->
    <link rel="icon" href="images/book.png" type="image/png">

    <style>
        .container {
            width: 60%;
        }

        .footer {
            height: 45px;
        }
    </style>
</head>

<body>
    <!-- navbar section -->
    <?php
    include 'template/navbar.php'
        ?>
    <div class="container p-5">
        <form class="p-5 rounded shadow signup-form" method="POST" action="php/contactUs.php">
            <h1 class="text-center">Contact Us</h1>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success text-center" role="alert">
                    <?= htmlspecialchars($_GET['success']); ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="exampleInputname" class="form-label">Your name</label>
                <input type="text" class="form-control" id="exampleInputname" name="name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                    aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Subject</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="subject">
            </div>
            <div class="mb-3">
                <label for="floatingTextarea" class="form-label">Your Message (Optional)</label>
                <textarea class="form-control" id="floatingTextarea" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- footer section -->
    <?php include 'template/footer.php' ?>

    <!-- Navbar javascript file path -->
    <script src="js/navbar.js"></script>

</body>

</html>