<?php
include 'header.php';
?>
<main>
    <section class="loginContainer">
        <!-- login form  -->
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username / Email...">
            <input type="password" name="pwd" placeholder="Password...">
            <button type="submit" name="submit">Login</button>
        </form>
        <!-- error handlers for login -->
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p class='lightGreen'>You forgot to fill in all fields</p>";
            } else if ($_GET["error"] == "wronglogin") {
                echo "<p class='lightGreen'>Username and password dont match</p>";
            }
        }
        ?>
    </section>
        <!-- signup button -->
    <section class="signupContainer">
        <div class="loginDivider"></div>
        <a href="signup.php">Sign Up</a>
    </section>
</main>

<?php
include 'footer.php';
?>