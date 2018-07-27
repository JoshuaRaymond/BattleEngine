<?php

function WriteData($fileName, $data){
    $file = fopen($fileName, "w") or die("Unable to open file!");
    fwrite($file, $data);
    fclose($file);
}

function ReadData($fileName){
    $file = fopen($fileName, "r") or die("Unable to open file!");
    $fileData = fgets($file);
    fclose($file);
    Return $fileData;
}
?>