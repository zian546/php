<?php

if (isset($_POST['submit'])){
    if(!empty($_FILES['image']['name'])){

        print_r($_FILES);
        echo 'uploaded successfully';

    }else{
        print_r($_FILES);
        echo "please choose a file!";
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
    <form method="POST" action=<?php echo $_SERVER["PHP_SELF"]; ?> enctype="multipart/form-data">
        <div>
            <label>selecet file to upload</label><br />
            <input type="file" name="image"><br />
            <input type="submit" name="submit">
            
        </div>

    </form>


    <script src="" async defer></script>
</body>

</html>