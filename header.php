<?php
    session_start();
?>

<header>
    <h1><a href="index.php">IntDating</a></h1>
    <?php
    if (isset($_SESSION["useruid"])) {
        echo '<a href="includes/logout.inc.php">Logout</a>';
    } else {
        echo '<a href="signup.php">Signup</a>';
        echo '<a href="login.php">Login</a>';
    }
    ?>

</header>