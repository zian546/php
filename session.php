<?php
session_start();




if(isset($_POST['submit'])){
    $username = htmlspecialchars( $_POST['username']);
    $password = htmlspecialchars( $_POST['password'] );
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];

    header("location: welcome.php"); 
}
?>

<html>

<head>
    <meta name="viewport" content="width=device-width">
    <meta charset="UTF-8" />
</head>

<body>
    <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username"></input>
</br>
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password"></input>
</br>
            <button type="submit" name="submit">submit</button>

        </div>
    </form>

</body>

</html>