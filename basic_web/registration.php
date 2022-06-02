<?php
include './database connection.php';

$message = "";

if (isset($_POST['submit'])) {

    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['phone_number']) || empty($_POST['username'])) {
        $message = "please enter all required fields!";
    } else {



        //generate unique identifier for encrypting user password
        $salt = md5(uniqid() . mt_rand() . microtime());

        $username = $_POST["username"];

        //encrypt the user password using sha1 algorith with added salt
        $password = sha1($salt . $_POST['password']);

        $email = $_POST["email"];
        $phone = $_POST["phone_number"];


        $save_user = mysqli_query($conn, "INSERT INTO  `user_data` (id,username,`password`,email,phone_number)   VALUES(NULL,'$username','$password','$email','$phone'); ");
        if (!$save_user) {
            $message = "Error registering user";
        } else {
            $message = "registration successfull!";
        }
    }
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
    <div>
        <h1>Registration Form</h1>
        <?php echo $message; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <label>username</label>
            <input type="text" name="username" placeholder="Username">
            <br />
            <label>password</label>
            <input type="password" name="password" placeholder="Password">
            <br />
            <label>email</label>
            <input type="email" name="email" placeholder="Email">
            <br />
            <label>Phone Number :</label>
            <input type="text" name="phone_number" placeholder="08XXXXXX">
            <br />
            <input type="submit" name="submit">
        </form>
    </div>

    <script src="" async defer></script>
</body>

</html>