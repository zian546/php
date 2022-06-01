<?php
$conn = mysqli_connect("localhost","root","","web user");

if(!$conn){
    echo "Error connecting to database";
}
else{
    echo mysqli_error($conn);
}
?>