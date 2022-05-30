<?php

$filename = "test.txt";
$data = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.";

function open_file($file){

    return fopen($file,"a+");
}

function close_file($file){

    return fclose($file);
}

function read_file($file){

    $stream = open_file($file);
    $read = fread($stream,filesize($file));
    close_file($stream);

    return $read;

}

function write_file($file,$data){
    try{
        $stream=open_file($file);
        $write = fwrite($stream,$data);
        close_file($stream);
        return true;
    }catch(Exception $e){echo $e;}

}
write_file($filename,$data);
$res = read_file($filename);

echo "<h1> ".$res."</h1>";


?>