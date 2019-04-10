<?php
//upload.php
  $target_dir = "../uploads/" ;

  $file_name = $target_dir . basename($_FILES["toUpload"]["name"]);

  echo $file_name;

  $uploadOK = True;

  $file_type = pathinfo($file_name, PATHINFO_EXTENSION);

  // is the file an image?
  $file_verif = getimagesize($_FILES["toUpload"]["tmp_name"]);

  if ($file_verif == False) {
    $uploadOK = False;
    die("Please upload an image file.");
  }


  // limit file size
  if ($_FILES["toUpload"]["size"] > 500000) {
    //create an alert?
    $uploadOK = False;
    die("Your file is too large. Your file must be under 500KB.");

  }



  // Only allow jpg, jpeg, and png files
  $file_type = strtolower($file_type) ;
  if ($file_type != "jpg" && $file_type != "jpeg" && $file_type != "png") {
    $uploadOK = False ;
    die("Only .jpg, .jpeg, and .png files are accepted. Please try again.");
  }

  // if uploadOK is true, upload file.
  echo $uploadOK ;
if ($uploadOK) {

  echo $_FILES["toUpload"]["tmp_name"];

  if (move_uploaded_file($_FILES["toUpload"]["tmp_name"], $file_name)) {
    echo "Success!" ;
  }
  else {
    echo "Failed :(";
  }

  if (isset($_GET["id"])) {
    $id = $_GET["id"] ;

    //header("Location: ../caseinfo.php?id=$id");
  }
}









?>
