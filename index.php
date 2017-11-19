<?php
    session_start();
    if(isset($_POST['logout'])){
        session_destroy();
    }
?>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Tasty Recipes</title>
    <meta name="description" content="Tasty Recipes">
    <meta name="Marcus Saastamoinen" content="">

    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <h1>Tasty Recipes</h1>

    <?php
        if(isset($_SESSION['logged_in'])){
            echo "<a id='user'>Logged in as " . $_SESSION['username'] . "</a>";
        }
    ?>

<ul class="headbar">
    <li><a href="index.php">Home</a></li>
    <li class="dropdown">
        <a class="dropbtn">Recipes</a>
        <div class="dropdown-content">
            <a href="recipes/meatballs.php">Meatballs</a>
            <a href="recipes/pancake.php">Pancake</a>
        </div>
    </li>
    <li><a href="calendar.php">Calendar</a></li>
    <?php
        if(!isset($_SESSION['logged_in'])){
            echo '<li><a id=\'login\' href=\'login.php\'>Login</a></li>';
        }
        else{
            echo '<li><form method="post" action="index.php">
                    <input id="login" type="submit" value="Log Out" name="logout">
                    </form>
                   </li>';
        }
    ?>

</ul>

<div class="mainPageInfo">
    <p>Welcome to Tasty Recipes!</p>
    <p>Here you can find a lot of tasty recipes.</p>
    <p>Check out the <a href="calendar.php">Calendar</a> by pressing the link!</p>
</div>

</body>
</html>