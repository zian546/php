<?php
include './database connection.php';

$query = mysqli_query($conn,"SELECT * FROM user_data");

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
    <h1>
        Users
    </h1>
    <div>
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <th>id</th>
                <th>username</th>
                <th>password</th>
                <th>email</th>
                <th>phone number</th>
            </tr>

            <?php while($result = mysqli_fetch_assoc($query)): ?>

            <tr>
                <td><?php echo $result['id'] ?></td>
                <td><?php echo $result['username']?></td>
                <td><?php echo $result['password']?></td>
                <td><?php echo $result['email']?></td>
                <td><?php echo $result['phone_number']?></td>
                
            </tr>

            <?php endwhile; ?>

        </table>
    </div>

    <script src="" async defer></script>
</body>

</html>