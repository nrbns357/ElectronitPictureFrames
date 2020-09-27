<?php
    $imageName = $_GET['imageName'];
    $image = file_get_contents("images/".$imageName);
    header("Content-type: image/jpeg");
    echo $image;
?>