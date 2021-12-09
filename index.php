<?php
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login test</title>
</head>

<body>
    <p>this is the index page</p>

    <?php
    if (isset($_SESSION["useruid"])) {
        echo '<p>Hello there ' . $_SESSION["useruid"] . ' </p>';
    }
    ?>

</body>

</html>

<?php
include 'footer.php';
?>