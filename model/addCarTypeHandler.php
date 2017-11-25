<?php

include_once "database.php";

if ( 0 < $_FILES['fileToUpload']['error'] ) {
    echo 'Error: ' . $_FILES['fileToUpload']['error'];
}else{
    $target_dir = "~/../../img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $comp  = input("make");
    $model = input("model");
    $price = input("price");


    $uploadOk = 1;

    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "<br> - File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "<br> - File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "<br> - File already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "<br> - Your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if($imageFileType != "jpg") {
        echo "<br> - Only JPG files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<br>[Your file was not uploaded]<br>";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $fileName = pathinfo($target_file, PATHINFO_FILENAME);
            insertCarType(strtoupper($comp), $model,$price,$fileName.".jpg");
            echo "Success";
        } else {
            echo "<br>Sorry, there was an error uploading your file<br>";
        }
    }
}


