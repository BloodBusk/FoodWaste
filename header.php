<?php
require_once "includes/dbh.inc.php";
require_once "class/foodDatabase.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reduce Food Waste</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header>
        <article class="headerTop">
            <h1 class="logo"><a href="index.php">Reduce Food Waste</a></h1>
            <div class="profileIcons">
                <?php
                if (isset($_SESSION["useruid"])) {
                    $ses = $_SESSION['useruid'];
                    $sql = "SELECT * FROM users WHERE usersUid = '$ses'";
                    $result = $conn->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imgId = $row["usersUid"];
                            $sqlImg = "SELECT * FROM profileimg WHERE userid = '$imgId'";
                            $resultImg = $conn->query($sqlImg);
                            while ($rowImg = mysqli_fetch_assoc($resultImg)) {
                                if ($rowImg["statusBool"] == 0 && $rowImg["userid"] = $imgId) {
                                    echo "<a href='profile.php' class='profileImg'><img src='img/uploads'" . $rowImg['userid'] . ".png></a>";
                                } else {
                                    echo "<a href='profile.php' class='profileImg'><img src='img/silhouette.png'></a>";
                                }
                            }
                        }
                    }
                } else {
                    echo "<a href='login.php'><i class='fas fa-user'></i></a>";
                }
                ?>
                <a href="shoppingCart.php"><i class="fas fa-shopping-cart"><span id="shoppingCartNum"></span></i></a>
            </div>
        </article>
        <article class="headerBot">
            <div class="headerSearch">
                <a href="index.php"><i class="fas fa-search" id="searchIcon"></i></a>
            </div>
            <div>
                <i class="fas fa-bars" id="hamburgerMenuIcon"></i>
                <div class="hamburgerMenu displayMenu" id="toggleMenu">
                    <i class="fas fa-times" id="closeMenu"></i>
                    <a href="index.php">Home</a>
                    <a href="">Search</a>
                    <a href="">Contact</a>
                    <?php
                    if (isset($_SESSION["useruid"])) {
                        echo '<a href="profile.php">Profile</a>';
                        echo '<a href="includes/logout.inc.php">Logout</a>';
                    } else {
                        echo '<a href="login.php">Login</a>';
                    }
                    ?>
                </div>
            </div>
        </article>
    </header>