<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library - About</title>

    <!-- Boostrap =5 CDN Links -->
    <?php
    include 'template/bootstraplinks.html'
        ?>
    <!-- favicon link -->
    <link rel="icon" href="images/book.png" type="image/png">

    <!-- css links -->
    <link rel="stylesheet" href="css/navbarcss.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/footer.css">

    <style>
        .footer{
            height: 50px;
        }

        .about_us{
            margin-bottom: 300px;
        }
    </style>

</head>

<body>
    <!-- nav section -->
    <?php
    include 'template/navbar.php'
        ?>

    <!-- main section -->
    <div class="container-fluid p-0 m-0">
        <div class="about_us">
        <h2 id="about-heading">About</h2>
        <p class="paragraph-1"><a href="index.php"
                class="hyperlink">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E-Book Store</a> provides
            free PDF books for all departments of all subjects easy one click download without registration. We provide
            open and download book feature without ads just one click download, click the button get the file. E-Book
            store is a free pdf provider website started by students to help other students by providing pdf free books
            website is daily updated with new books you can contact us by given email you can also connect and share
            books with us, and also demand a book which is not available we will post that book free in 24 hours. Note:
            All information provided for educational purposes only.</p>

        <p class="paragraph-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please Note: – We are not the
            owner of these books/notes. We provide books which are already available on the internet. For any further
            queries please contact us. We never SUPPORT PIRACY. These books were provided for students who are
            financially troubled but want to study to learn.</p>

        <p class="paragraph-1">Contact us using <a class="hyperlink" href="contact-us.php">contact page</a> or Email us
            <a class="hyperlink" href="mailto:pratiktele4@gmail.com">pratiktele4@gmail.com</a>
        </p>
        </div>
        <!-- footer section -->
    <?php include 'template/footer.php' ?>
    </div>
    <!-- Navbar javascript file path -->
    <script src="js/navbar.js"></script>
</body>

</html>