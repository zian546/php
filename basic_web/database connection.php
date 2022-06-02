<?php
$conn = mysqli_connect("localhost","root","","web user");

if($conn->connect_error){
    echo "Error connecting to database";
}
else{
    //connection established
}
?>