<?php 
session_start();

$link;

if($_SESSION['role'] == 'admin'){

    $link = './pending_user_admin.php';

}
else{
    $link = './pending_user.php';
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="w3-sidebar w3-light-grey w3-bar-block" id="sidebar">
        <h3 class="w3-bar-item">Menu</h3>
        <a class="w3-bar-item w3-button" href="./approved_user.php">approved</a>
        <a class="w3-bar-item w3-button" href='<?php echo $link;?>'>pending</a>
        <a class="w3-bar-item w3-button" href="./rejected_user.php">rejected</a>
        <a class="w3-bar-item w3-button" href="./logout.php">logout</a>
    </div>
            <script src="" async defer></script>
</body>

</html>