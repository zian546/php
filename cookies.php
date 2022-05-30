<?php
 $user = "zian";
setcookie("user", $user,time() + 3600);

if(isset($_COOKIE["user"])){
    echo $_COOKIE["user"];
}

?>