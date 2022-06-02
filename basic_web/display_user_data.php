<?php
include './database connection.php';

session_start();


if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {

    header("Location: Login.php");
}


$query = mysqli_query($conn, "SELECT * FROM user_data");

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
        <a class="w3-bar-item w3-button" href="./logout.php">logout</a>
    </div>


    <div class="w3-container w3-teal" style=" margin-left: 10%; display:flex; justify-content:center">
        Users
    </div>
    <div class="w3-container" style="display:flex; justify-content:center; margin-left:10%; margin-top:5%;">
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>id</th>
                <th>username</th>
                <th>password</th>
                <th>email</th>
                <th>phone number</th>
                <th>password salt</th>
            </tr>

            <?php while ($result = mysqli_fetch_assoc($query)) : ?>

                <tr>
                    <td><?php echo $result['id'] ?></td>
                    <td><?php echo $result['username'] ?></td>
                    <td><?php echo $result['password'] ?></td>
                    <td><?php echo $result['email'] ?></td>
                    <td><?php echo $result['phone_number'] ?></td>
                    <td><?php echo $result['password_salt'] ?></td>

                </tr>

            <?php endwhile; ?>

        </table>
    </div>

    <script src="" async defer></script>
</body>

</html>