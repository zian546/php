<?php


if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $age = htmlspecialchars($_POST['age']);

    echo(
        "my name is $name and age is $age"
    );
}


?>

<html>

<head>
    <meta name="viewport" content="width=device-width">
    <meta charset="UTF-8" />
</head>

<body>



    <form action="<?php echo $_SERVER['PHP_SELF']; ?> " method="POST">
        <div>
            <label for="name">Name : </label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="age">Age : </label>
            <input type="number" name="age">
        </div>
        <input type="submit" name="submit">
    </form>

    <h1><?php var_dump(isset($_POST['submit'])); ?></h1>


</body>

</html>