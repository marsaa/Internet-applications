<?php
session_start();
if(isset($_POST['logout'])){
    session_destroy();
}
?>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Calendar | Tasty Recipes</title>
    <meta name="description" content="Tasty Recipes">
    <meta name="Marcus Saastamoinen" content="">

    <link rel="stylesheet" type="text/css" href="reset.css">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">

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
        echo '<li><form method="post" action="calendar.php">
                    <input id="login" type="submit" value="Log Out" name="logout">
                    </form>
                   </li>';
    }
    ?>
</ul>


<div class="month">
    <ul class="month">
        <li>
            November
        </li>
    </ul>
</div>

<ul class="weekdays">
    <li>Mo</li>
    <li>Tu</li>
    <li>We</li>
    <li>Th</li>
    <li>Fr</li>
    <li>Sa</li>
    <li>Su</li>
</ul>

<ul class="days">
    <li></li>
    <li></li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>5</li>
    <li>6</li>
    <li>7</li>
    <li><a href="recipes/meatballs.php"><img class="calenderImg"  src="recipes/images/meatballs.jpg" alt="meatballs"></a></li>
    <li>9</li>
    <li>10</li>
    <li>11</li>
    <li>12</li>
    <li>13</li>
    <li>14</li>
    <li>15</li>
    <li>16</li>
    <li><a href="recipes/pancake.php"><img class="calenderImg" src="recipes/images/pancakes.jpg" alt="pancakes"></a></li>
    <li>18</li>
    <li>19</li>
    <li>20</li>
    <li>21</li>
    <li>22</li>
    <li>23</li>
    <li>24</li>
    <li>25</li>
    <li>26</li>
    <li>27</li>
    <li>28</li>
    <li>29</li>
    <li>30</li>
</ul>

</body>
</html>