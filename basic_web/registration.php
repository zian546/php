<?php
include './database connection.php';



$allowed_ext = ['jpg','JPG'];
$message = "";

if (isset($_POST['submit'])) {


    if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['phone_number']) || empty($_POST['username']) || empty($_FILES['photo']['name'])) {
        $message = "please enter all required fields!";
    } else {


        $file_name = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'] / 1e+6;
        $file_data = mysqli_real_escape_string($conn, file_get_contents($_FILES['photo']['tmp_name']));

        //split the extension and the actual filename
        $file_ext = explode('.', $file_name);

        //discard the filename and only take the extension
        $file_ext = strtolower(end($file_ext));

        if (in_array($file_ext, $allowed_ext)) {

            if ($file_size > (2 * 1e+6)) {

                $message = "file is too large";
            } else {

                //generate unique identifier for encrypting user password
                $salt = md5(uniqid() . mt_rand() . microtime());

                $username = htmlspecialchars($_POST["username"]);

                //encrypt the user password using sha1 algorith with added salt
                $password = sha1($salt . $_POST['password']);

                $email = htmlspecialchars($_POST["email"]);
                $phone = htmlspecialchars($_POST["phone_number"]);
                $activation_status_default = 'Pending';
                $Date = date("Y D d M  h:i:s:e P ");

                $search_username = mysqli_query($conn, "SELECT * FROM `user_data` WHERE username='$username' ");

                //print_r($search_username);

                if ($search_username->num_rows == 0) {

                    $search_email = mysqli_query($conn, "SELECT * FROM `user_data` WHERE email='$email' ");

                    if ($search_email->num_rows == 0) {

                        $search_phone = mysqli_query($conn, "SELECT * FROM `user_data` WHERE phone_number='$phone' ");

                        if ($search_phone->num_rows == 0) {

                            $save_user = mysqli_query($conn, "INSERT INTO `user_data` (id,username,`password`,email,phone_number,`Photo`,`Admin Activation Status`,`Email Activation Status` ,password_salt, `role`, CreatedAt)   
                    VALUES(NULL,'$username','$password','$email','$phone', '$file_data','$activation_status_default' , '$activation_status_default' ,'$salt', 'user','$Date');");
                            if (!$save_user) {
                                $message = "Error registering user";
                            } else {
                                $message = "registration successfull!\nPlease wait for verification";
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
        } else {
            $message = "invalid file type";
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
            <label for="username">username : </label>
            <input i="usename" type="text" name="username" placeholder="Username">
            <br />
            <label for="password">password : </label>
            <input id="password" type="password" name="password" placeholder="Password">
            <br />
            <label for="email">email : </label>
            <input id="email" type="email" name="email" placeholder="Email">
            <br />
            <label for="phone">Phone : </label>
            <input id="phone" type="text" name="phone_number" placeholder="08XXXXXX">
            <br />
            <label for="photo">Photo : </label>
            <input id="photo" type="file" name="photo">
            <br />
            <input type="submit" name="submit" style="margin:1rem">
            <button type="submit" name="to_login">login</button>
        </form>
    </div>

    <script src="" async defer></script>
</body>

</html>