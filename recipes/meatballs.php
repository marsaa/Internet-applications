<?php
session_start();
if(isset($_POST['logout'])){
    session_destroy();
}
$servername = "localhost";
$root = "root";
$pw = "root";
$dbname = "comments";

// Create connection
$conn = new mysqli($servername, $root, $pw, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['comments'])){
    $comment = $_POST['comments'];
    $user = $_SESSION['username'];
    $page = "meatballs";
    $sql = "INSERT INTO comments (comment, user, page)
            VALUES ('" . $comment . "', '" . $user . "', '" . $page . "')";
    $conn->query($sql);
}
if(isset($_POST['id'])){
    $id = $_POST['id'];
    echo $id;
    $sql = "DELETE FROM comments WHERE id = '" . $id . "'";
    echo $sql;
    $conn->query($sql);
}
$conn->close();

?>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Meatballs | Tasty Recipes</title>
    <meta name="Marcus Saastamoinen" content="Tasty Recipes">

    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="../stylesheet.css">
</head>

<body>
<h1>Tasty Recipes</h1>

<?php
if(isset($_SESSION['logged_in'])){
    echo "<a id='user'>Logged in as " . $_SESSION['username'] . "</a>";
}
?>

<ul class="headbar">
    <li><a href="../index.php">Home</a></li>
    <li class="dropdown">
        <a class="dropbtn">Recipes</a>
        <div class="dropdown-content">
            <a href="meatballs.php">Meatballs</a>
            <a href="pancake.php">Pancake</a>
        </div>
    </li>
    <li><a href="../calendar.php">Calendar</a></li>
    <?php
    if(!isset($_SESSION['logged_in'])){
        echo '<li><a id=\'login\' href=\'../login.php\'>Login</a></li>';
    }
    else{
        echo '<li><form method="post" action="meatballs.php">
                    <input id="login" type="submit" value="Log Out" name="logout">
                    </form>
                   </li>';
    }
    ?>
</ul>

<div class="recipe">
<p>Recipe for meatballs</p>
<img class="food" src="images/meatballs.jpg" alt="meatballs">

<div class="ingredients">
    <a>Ingredients</a>
    <ul>
        <li>500g minced meat</li>
        <li>&frac12; dl of breadcrumbs</li>
        <li>1 dl of cream</li>
        <li>2 tablespoons of chopped onions</li>
        <li>1 teaspoon of salt</li>
        <li>1ml of black pepper</li>
        <li>2 tablespoons of butter</li>
    </ul>
</div>

<div class="steps">
    <a>Steps</a>
    <ul>
        <li>Mix the breadcrumbs and cream. Let it swell for 10min.</li>
        <li>Add minced meat, onion, egg, salt and pepper.</li>
        <li>Shape the mix into round shapes and fry them in a pan for 3-5 minutes</li>
    </ul>
</div>
</div>

<div class="comments">
    <h2>Comments</h2>

    <?php

    $servername = "localhost";
    $root = "root";
    $pw = "root";
    $dbname = "comments";
    $page = "meatballs";

    // Create connection
    $conn = new mysqli($servername, $root, $pw, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT *
            FROM comments
            WHERE page = '" . $page . "' ";
    $result = $conn->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);

    echo '<ul>';

    for($i = 0; $i < $result->num_rows; $i++){
        echo '<li><img src="images/user.png" alt="user"><a id=user1>'. $data[$i]['user'] . '</a><a>' . $data[$i]['comment'] .'</a></li>';
        if(isset($_SESSION['logged_in'])){
            if($data[$i]['user'] == $_SESSION['username']){
                echo '<form action="meatballs.php" method="post">
                    <textarea name="id" style="display: none">' . $data[$i]['id'] .'</textarea>
                    <input id="deletebtn" type="submit", value="delete"></form>';
            }
        }
    }
    echo '</ul>';

    if(isset($_SESSION['logged_in'])){
        echo "<form action=\"meatballs.php\" method=\"post\">
        <div>
            <textarea name=\"comments\" id=\"comments\"></textarea>
        </div>
        <input type=\"submit\" value=\"Comment!\">
    </form>";
    }
    ?>
</div>


</body>
</html>
