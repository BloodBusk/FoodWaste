<?php
include 'header.php';
$food = new FoodDatabase();
$food->insertJsonFileIntoDatabase();
?>


<main>
    <section class="homeTop">
        <p>This web app allows the connection <br> between customers and grocery store. You <br> can buy food that is close to the expiration <br>date at a reduced price. And pick it up <br>at you local supermarket</p>
    </section>

    <!-- search form for product lists -->
    <form id="searchForm" class="searchForm" action="includes/updateSearch.inc.php" method="GET">
        <input type="submit" value="" class="searchFormBtn">
        <i class="fas fa-search"></i>
        <input class="searchFormInput" type="search" name="searchInput">
        <input type="hidden" name="action" value="search">
    </form>
    <section class="foodCardContainer">
        <!-- displays searched food and slices it into an array of 6 items -->
        <?php
        if (isset($_SESSION['foodObjects'])) {
            $foodObjects = $_SESSION['foodObjects'];

            // echo "Total results " . count($foodObjects);

            $sliceArr = array_slice($foodObjects, 0, 6);

            for ($i = 0; $i < count($sliceArr); $i++) {
                echo $sliceArr[$i]->DisplayFood();
            }
        }
        ?>
    </section>
</main>

<?php
include 'footer.php';
?>