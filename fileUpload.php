<?php


$message = "select file to upload";

if (isset($_POST['submit'])) {


    $allowed_ext = ['pptx', 'php', 'docs', 'jpg', 'png', 'jpeg'];


    if (!empty($_FILES['image']['name'])) {

        $file_name = $_FILES['image']['name'];
        $file_path = $_FILES['image']['full_path'];
        $file_type = $_FILES['image']['type'];
        $file_size = $_FILES['image']['size'] / 1e+6;
        $file_tmp =  $_FILES['image']['tmp_name'];
        $target_dir = "uploads/$file_name";

        //split the extension and the actual filename
        $file_ext = explode('.', $file_name);

        //discard the filename and only take the extension
        $file_ext = strtolower(end($file_ext));

        
        var_dump($file_tmp);

        if (in_array($file_ext, $allowed_ext)) {

            if ($file_size > (2 * 1e+6)) {

                $message = "file is too large";
            } else {

                $move = move_uploaded_file($file_tmp, $target_dir);

                switch ($move) {
                    case true:
                        $message = "file uploaded successfully";
                        break;

                    case false:
                        $message = "Error uploading file " . var_dump($move);
                        break;
                }
            }
        } else {
            $message = "invalid file type";
        }
    } else {

        $message = "please choose a file!";
    }
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>file upload practice</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <h1><?php echo $message;  ?></h1>>
    <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="POST" enctype="multipart/form-data">


        <input type="file" name="image">
        <input type="submit" value="Submit" name="submit">


    </form>
</body>

</html>