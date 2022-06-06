<?php
include './database connection.php';
include './sidebar.php';



if (!isset($_SESSION['role'])  || $_SESSION['role'] != 'admin') {

    header("Location: Login.php");
}

if (isset($_POST['approve'])) {

    $id =  $_POST["user_id"];
    $Date = date("Y D d M  h:i:s:e P ");

    $update = mysqli_query($conn, "UPDATE `user_data` SET `Admin Activation Status` = 'Approved', `ApprovedAt` = '$Date'  WHERE `id` = '$id'  ");
}

if (isset($_POST['reject'])) {
    $id =  $_POST["user_id"];
    $Date = date("Y D d M  h:i:s:e P ");

    $update = mysqli_query($conn, "UPDATE `user_data` SET `Admin Activation Status` = 'Rejected', `RejectedAt` = '$Date'  WHERE `id` = '$id'  ");
}


$query = mysqli_query($conn, "SELECT * FROM user_data WHERE `Admin Activation Status` = 'Pending'");

?>


<!DOCTYPE html>


<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>

<body>

    <div class="w3-container w3-teal" style=" margin-left: 10%; display:flex; justify-content:center">
        Pending Users
    </div>

    <div class="w3-container" style="display:flex; justify-content:center; margin-left: 10%; margin-top: 5%;overflow-y: scroll; font-size: 0.7rem; ">
        <table style="width:10%" border="1" cellspacing="0" cellpadding="10">
            <thead>
                <th>id</th>
                <th>username</th>
                <th>password</th>
                <th>email</th>
                <th>phone number</th>
                <th>password salt</th>
                <th>Admin Activation Status</th>
                <th>Email Activation Status</th>
                <th>Role</th>
                <th>CreatedAt</th>
                <th>Approve</th>
                <th>Reject</th>

            </thead>
            <tbody>
                <?php while ($result = mysqli_fetch_assoc($query)) : ?>

                    <tr style="overflow-y:scroll;">
                        <td><?php echo $result['id'] ?></td>
                        <td><?php echo $result['username'] ?></td>
                        <td><?php echo $result['password'] ?></td>
                        <td><?php echo $result['email'] ?></td>
                        <td><?php echo $result['phone_number'] ?></td>
                        <td><?php echo $result['password_salt'] ?></td>
                        <td><?php echo $result['Admin Activation Status'] ?></td>
                        <td><?php echo $result['Email Activation Status'] ?></td>
                        <td><?php echo $result['role'] ?></td>
                        <td style="overflow-y:scroll;"><?php echo $result['CreatedAt'] ?></td>

                        <td>

                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value=" <?php echo $result['id'] ?>"></input>
                                <input type="submit" name="approve" style="margin: 0.2rem" placeholder="approve"></input>
                        <td>

                            <input type="submit" name="reject"></input>
                        </td>
                        </form>
                        </td>

                    </tr>

                <?php endwhile; ?>


            </tbody>
        </table>
    </div>

    <script src="" async defer></script>
</body>

</html>

<?php
//todo : *user verification with admin* and email, role grant, *read_only with user*, live search user, upload photo to verify


?>