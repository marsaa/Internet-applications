<?php
session_start();

$servername = "localhost";
$root = "root";
$pw = "root";
$dbname = "users";

$conn = new mysqli($servername, $root, $pw, $dbname);

if($conn->connect_error){
    die("connection failed: " . $conn->connect_error);
}

if(isset($_POST['username'])){
    $sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "'";
    $result = $conn->query($sql);
    $conn->close();

    $data = $result->fetch_array();
    $username = $data['1'];
    $password = $data['2'];
}
if(isset($_POST['logout'])){
    session_destroy();
}
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header('Location: index.php');
}
if(isset($_POST['username']) && isset($_POST['password'])){
    if($_POST['username'] == $username && $_POST['password'] == $password){
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $_POST['username'];

        header('Location: index.php');
    }
    else{
        echo "<div id='loginError'><a>Wrong username or password</a></div>";
    }
}

?>
<html>
<head>
    <title>Login | Tasty Recipes</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>

<h1>Tasty Recipes</h1>

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
</ul>


<div id="loginPage">
    <div class="loginbutton">
        <form method="post" action="login.php">
            Username: <br/>
            <input type="text" name="username"><br/>
            Password: <br/>
            <input type="password" name="password"><br/>
            <input type="submit" value="Login">
        </form>
    </div>
</div>

</body>

</html>