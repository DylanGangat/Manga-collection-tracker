<?php 
    $connect = mysqli_connect("localhost", "dylan", "test1234", "manga_collection");

    if(!$connect) {
        echo "Connection Error: " . mysqli_connect_error();
    }

?>