<?php
include_once 'header.php';
?>

<section class="signupForm">
    <h2>Sign Up</h2>
    <form action="includes/signup.inc.php" method="post">
        <label>Buyer / Seller</label>
        <select name="usertype">
            <option value="Buyer">Buyer</option>
            <option value="Seller">Seller</option>
        </select>
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Full Name...">
        <label>Email</label>
        <input type="text" name="email" placeholder="Email...">
        <label>Username</label>
        <input type="text" name="uid" placeholder="Username...">
        <label>Password</label>
        <input type="password" name="pwd" placeholder="Password...">
        <label>Repeat password</label>
        <input type="password" name="pwdrepeat" placeholder="Repeat Password...">
        <button type="submit" name="submit">Sign Up</button>
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>You forgot to fill in all fields</p>";
        } else if ($_GET["error"] == "invalidUid") {
            echo "<p>Username is not valid</p>";
        } else if ($_GET["error"] == "invalidEmail") {
            echo "<p>email is not valid</p>";
        } else if ($_GET["error"] == "passwordsdontmatch") {
            echo "<p>passwords dont match</p>";
        } else if ($_GET["error"] == "usernametaken") {
            echo "<p>Username is taken</p>";
        } else if ($_GET["error"] == "none") {
            echo "<p>Succesfully signed up</p>";
        }
    }
    ?>
</section>



<?php
include_once 'footer.php';
?>