<?php
include './database connection.php';

$message = "";

if (isset($_POST['login'])) {

    //salt for password authentication


    $input_username = $_POST['username'];

    //search the user in db based on input username
    $query = mysqli_query($conn, "SELECT * FROM `user_data` WHERE username = '$input_username' ");
    $check_password = mysqli_fetch_assoc($query);

    $check_password_salt = $check_password['password_salt'];

    $real_password = $check_password['password'];
    $input_password = sha1($check_password_salt . $_POST['password']);

    if ($check_password == NULL) {

        $message = "account not registered, please register first!";
    } else if ($real_password != $input_password) {

        $message = "wrong password";
    } else {

        $message = "login successfull";
    }
} else if (isset($_POST['signup'])) {

    header('Location: ./registration.php');
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
    <link rel="stylesheet" href="">
</head>

<body>

    <h1>Login</h1>
    <h1> <?php echo $message; ?></h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Username</label>
        <input type="text" name="username">
        <br />
        <label>Password</label>
        <input type="password" name="password">
        <br />
        <button type="submit" name="login">login</button>
        <button type="submit" name="signup" style="margin: 1rem">signup</button>
    </form>
    <script src="" async defer></script>
</body>

</html>