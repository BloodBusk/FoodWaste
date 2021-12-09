<?php
include 'header.php';
?>

<section>
    <h2>Login</h2>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="uid" placeholder="Username / Email...">
        <input type="password" name="pwd" placeholder="Password...">
        <button type="submit" name="submit">Login</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>You forgot to fill in all fields</p>";
        } else if ($_GET["error"] == "wronglogin") {
            echo "<p>Username and password dont match</p>";
        }
    }
    ?>
</section>


<?php
include 'footer.php';
?>