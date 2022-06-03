<?php
include './database connection.php';

session_start();

$message = "";

if (isset($_POST['login'])) {

    //salt for password authentication


    $input_username = $_POST['username'];

    //search the user in db based on input username
    $query = mysqli_query($conn, "SELECT * FROM `user_data` WHERE username = '$input_username' ");
    $check_password = mysqli_fetch_assoc($query);


    if ($check_password == NULL) {

        $message = "account not registered, please register first!";
    } else {

        $check_password_salt = $check_password['password_salt'];

        $real_password = $check_password['password'];
        $input_password = sha1($check_password_salt . $_POST['password']);

        if ($real_password != $input_password) {

            $message = "wrong password";
        } else {

            $_SESSION['username'] = $input_username;

            if(isset($_POST['remember_me'])){

                setcookie('username', $input_username, time() + 86400);
            }

            $message = "login successfull";

            header('Location: ./pending_user.php');
        }
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

    <h1 style="display: flex; justify-content: center">Login</h1>
    <h2 style="display: flex; justify-content: center"> <?php echo $message; ?></h2>
    <form style="display: flex; align-content:space-between ; align-items: center ; justify-content: center ; flex-direction: column;" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Username</label>
        <input type="text" name="username">
        <br />
        <label>Password</label>
        <input type="password" name="password">
        <br />
        <button type="submit" name="login">login</button>
        <button type="submit" name="signup" style="margin: 1rem">signup</button>
        <br/>
        <input type="checkbox" name="remember_me">remember me(1 day)
    </form>
    <script src="" async defer></script>
</body>

</html>