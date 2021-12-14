<?php
include 'header.php';
require_once "includes/dbh.inc.php";
?>
<main>


    <section>
        <!-- Typical user profile information, everything is shown by useruid for identification -->
        <?php
        if (isset($_SESSION["useruid"])) {
            $ses = $_SESSION["useruid"];
            $sql = "SELECT * FROM users WHERE usersUid = '$ses'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<h2 class="lightGreen">You are logged in as ' . $row["usersType"] . '</h2>';
                    echo '<form action="#" method="post" class="profileForm">';
                    echo '<label>Full Name</label>';
                    echo '<input type="text" name="name" value=' . $row["usersName"] . '>';
                    echo '<label>Email</label>';
                    echo '<input type="text" name="email" value=' . $row["usersEmail"] . '>';
                    echo '<label>Password</label>';
                    echo '<input type="password" name="pwd" value=' . $row["usersPwd"] . '>';
                    echo '<label>Password repeat</label>';
                    echo '<input type="password" name="pwdrepeat" value=' . $row["usersPwd"] . '>';
                    echo '<button type="submit" name="submit">Update</button>';
                    echo '</form>';
// Only show if user is seller (addStore)(createFood)
                    if ($row["usersType"] === "Seller") {
                        echo '<form action="includes/addStore.inc.php" method="post" class="profileForm">';
                        echo "<label>Add Store Name</label>";
                        echo "<input type='text' name='storeName'>";
                        echo "<label>Add CVR</label>";
                        echo "<input type='text' name='cvr'>";
                        echo "<label>Add Store Address</label>";
                        echo "<input type='text' name='storeAddress'>";
                        echo "<button type='submit' name='submit'>Add Store Info</button>";
                        echo '</form>';

                        echo '<form action="includes/createFood.inc.php" method="post" class="profileForm">';
                        echo "<label>Add Food Name</label>";
                        echo "<input type='text' name='foodName'>";
                        echo "<label>Add Food Price</label>";
                        echo "<input type='text' name='foodPrice'>";
                        echo "<label>Add Food Amount</label>";
                        echo "<input type='text' name='foodAmount'>";
                        echo "<button type='submit' name='submit'>Add Food</button>";
                        echo '</form>';
                    }
                }
            }
        }
        ?>
<!-- UPLOAD FILE FORM -->
        <form action="includes/uploadImg.inc.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="submit">Upload Image</button>
        </form>
<!-- DELETE USER FORM -->
        <div class="deleteUser">
            <form action="#" method="POST">
                <input class="red" type="submit" name="deleteUser" value="Delete Profile">
            </form>
        </div>

    </section>
</main>
<!-- UPDATE USER INFO  -->
<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $uid = $_SESSION["useruid"];

    $sql = "UPDATE users SET usersName = '$name', usersEmail = '$email', usersPwd = '$pwd' WHERE usersUid = '$uid'";
    mysqli_query($conn, $sql);
}
?>

<!-- DELETE USER FROM DATABASE USER -->
<?php
if (isset($_POST["deleteUser"])) {
    $ses = $_SESSION["useruid"];
    $sql = "DELETE FROM users WHERE usersUid = '$ses';";

    mysqli_query($conn, $sql) or die($conn->error);
    include "includes/logout.inc.php";
    
}

?>


<?php
include 'footer.php';
?>