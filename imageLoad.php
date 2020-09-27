<?php
    $images = scandir('images');
    if($images == false){
        return;
    }
    array_shift($images);
    array_shift($images);
?>