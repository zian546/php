<?php
include './database connection.php';
include './sidebar.php';




if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {

    header("Location: Login.php");
}


$query_default = mysqli_query($conn, "SELECT * FROM user_data WHERE `Admin Activation Status` = 'Approved'");
$search_result = null;



if(isset($_GET['search_submit'])) {
    $value_to_search = $_GET['search'];

    $query_search = mysqli_query($conn, "SELECT * FROM user_data WHERE `username` = '$value_to_search'  AND `Admin Activation Status` = 'Approved' ");

    if($query_search->num_rows == 0) {

        $query_search = mysqli_query($conn,"SELECT * FROM user_data WHERE `id` = '$value_to_search' AND `Admin Activation Status` = 'Approved'");    

        if($query_search->num_rows == 0) {
            $query_search = mysqli_query($conn,"SELECT * FROM user_data WHERE `email` = '$value_to_search' AND `Admin Activation Status` = 'Approved'");

            if($query_search->num_rows == 0) {
                $query_search = mysqli_query($conn,"SELECT * FROM user_data WHERE `phone_number` = '$value_to_search' AND `Admin Activation Status` = 'Approved'");

                if($query_search->num_rows == 0) {

                    $search_result = false;
                }else{
                    $search_result = $query_search;
                }

            }else {
                $search_result = $query_search;
            }

        }else{
            $search_result = $query_search;

        }

    }else{
        $search_result = $query_search;
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>

<body>
    
    
    <div class="w3-container w3-teal" style=" margin-left: 10%; display:flex; justify-content:center">
        Approved Users
    </div>

    <div class="w3-container" style="display:flex; justify-content:center; margin-left: 10%; margin-top: 5%; font-size: 0.7rem; ">
        <form action="" method="get">
            <label for="search">search user:</label>
            <input type="text" name="search">

            <button type="submit" name="search_submit">search</button>

        </form>
    </div>
    <div class="w3-container" style="display:flex; justify-content:center; margin-left: 10%; margin-top: 5%;overflow-y: scroll; font-size: 0.7rem; ">
        
        <?php if ($search_result == false) : ?>
            <?php echo "no approved user found" ?>
        <?php endif ?>
        <?php if ($search_result !== null && $search_result !== false) : ?>
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
                    <th>Photo</th>
                    <th>CreatedAt</th>
                    <th>ApprovedAt</th>
                </thead>
                <tbody>


                    <?php while ($data = mysqli_fetch_assoc($search_result) ) : ?>

                        <tr style="overflow-y:scroll;">
                            <td><?php echo $data['id'] ?></td>
                            <td><?php echo $data['username'] ?></td>
                            <td><?php echo $data['password'] ?></td>
                            <td><?php echo $data['email'] ?></td>
                            <td><?php echo $data['phone_number'] ?></td>
                            <td><?php echo $data['password_salt'] ?></td>
                            <td><?php echo $data['Admin Activation Status'] ?></td>
                            <td><?php echo $data['Email Activation Status'] ?></td>
                            <td><?php echo $data['role'] ?></td>
                            <td><img src="<?php echo "data:image/{$data['photo type']};base64," . base64_encode($data['Photo']) ?>" width="300px">
                            <td style="overflow-y:scroll;"><?php echo $data['CreatedAt'] ?></td>
                            <td><?php echo $data['ApprovedAt'] ?></td>
                            






                        </tr>

                    <?php endwhile; ?>



                </tbody>
            </table>



        <?php endif ?>
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
                <th>Photo</th>
                <th>CreatedAt</th>
                <th>ApprovedAt</th>
            </thead>
            <tbody>
                <?php while ($result = mysqli_fetch_assoc($query_default)) : ?>

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
                        <td><img src="<?php echo "data:image/{$result['photo type']};base64," . base64_encode($result['Photo']) ?>" width="300px">
                        <td style="overflow-y:scroll;"><?php echo $result['CreatedAt'] ?></td>
                        <td><?php echo $result['ApprovedAt'] ?></td>






                    </tr>

                <?php endwhile; ?>


            </tbody>
        </table>
    </div>

    <script src="" async defer></script>
</body>

</html>

<?php
//todo : user verification with admin and email, role grant, read_only with user, live search user


?>