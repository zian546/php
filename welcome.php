<?php
session_start();

$username = $_SESSION['username'];



?>


<h1><?php echo "welcome $username"; ?></h1>
<a href="logout.php">Logout</a>