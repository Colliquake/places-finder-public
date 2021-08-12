<?php
    $location = $_POST["location"];
    echo $location;

    $contents = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=32.865857,-117.233742&radius=1500&key=???');

    echo $contents;
?>