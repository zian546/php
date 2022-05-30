<?php
session_start();

$username = $_SESSION['username'];

if(isset($_GET["logout"])){
    session_destroy();
    header('Location: session.php');
}

?>


<h1><?php echo "welcome $username"; ?></h1>
<a href="name=logout">Logout</a>