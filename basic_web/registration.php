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
        $activation_status_default = 'Pending';
        $Date = date("Y D d M  h:i:s:e P ");

        $search_username = mysqli_query($conn, "SELECT * FROM `user_data` WHERE username='$username' ");

        if (!$search_username) {

            $search_email = mysqli_query($conn, "SELECT * FROM `user_data` WHERE email='$email' ");

            if (!$search_email) {

                $search_phone = mysqli_query($conn, "SELECT * FROM `user_data` WHERE phone='$phone' ");

                if (!$search_phone) {

                    $save_user = mysqli_query($conn, "INSERT INTO  `user_data` (id,username,`password`,email,phone_number,`Admin Activation Status`,`Email Activation Status` ,password_salt, `role`, CreatedAt)   
                    VALUES(NULL,'$username','$password','$email','$phone', '$activation_status_default' , '$activation_status_default' ,'$salt', 'user','$Date'); ");
                    if (!$save_user) {
                        $message = "Error registering user";
                    } else {
                        $message = "registration successfull!";
                        header("Location: ./Login.php");
                    }
                } else {

                    $message = "Phone number is already registered";
                }
            } else {

                $message = "Email already registered";
            }
        } else {
            $message = "Username not available!";
        }
    }
} else if (isset($_POST['to_login'])) {

    header("Location: ./Login.php");
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
    <div style="display: flex ; flex-direction: column ; align-content:space-between ; align-items: center  ; justify-content: center">
        <h1>Registration Form</h1>
        <?php echo $message; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <label>username : </label>
            <input type="text" name="username" placeholder="Username">
            <br />
            <label>password : </label>
            <input type="password" name="password" placeholder="Password">
            <br />
            <label>email : </label>
            <input type="email" name="email" placeholder="Email">
            <br />
            <label>Phone : </label>
            <input type="text" name="phone_number" placeholder="08XXXXXX">
            <br />
            <input type="submit" name="submit" style="margin:1rem">
            <button type="submit" name="to_login">login</button>

        </form>
    </div>

    <script src="" async defer></script>
</body>

</html>