<div class="navbar">
    <h2 id="heading"><a href="index.php">E-Library</a></h2>
    <ul class="menu">
        <li class="menu-items item-hover"><a href="index.php">Home</a></li>
        <li class="menu-items item-hover"><a href="about.php">About</a></li>
        <li class="menu-items item-hover"><a href="contact-us.php">Contact Us</a></li>
    </ul>
    <?php if(!isset($_SESSION['user_id'])&& 
             !isset($_SESSION['user_email'])){ ?>
    <button type="button" class="login-btn" name="login" onclick="location.href='login.php'" >Login</button>
    <?php }else{?>
    <button type="button" class="login-btn" onclick="location.href='user-logout.php'" >Logout</button>
    <?php }?>
    <img src="images/bars-solid.svg" alt="" class="menu-bar">
</div>