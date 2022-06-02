<?php

class User
{
    public function _construct($name, $password, $email){
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
    }
}

class Employee extends User
{
    public function _construct($name, $password, $email, $user){
        parent::_construct($name, $password, $email);
        
        
    }

}


if(isset($_POST['submit'])){
    $new_user = new User();

   

    echo (json_encode($new_user)); 

    $handler = fopen($new_user->username .".txt","x+");
    fwrite($handler,  json_encode($new_user));
    fclose($handler);
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
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form">
        <div class="">
            <h1 class="">sign up</h1><br />
            <label>username : </label>
            <input type="text" name="username">
            <br />
            <label>password : </label>
            <input type="password" name="password">
            <br />
            <label>email : </label>
            <input type="email" name="email">
            <br />
            <input type="submit" name="submit" value="submit">
        </div>
    </form>
    <script src="" async defer></script>
</body>

</html>