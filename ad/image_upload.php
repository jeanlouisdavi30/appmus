
<?php
require_once "config.php";


$target_dir = "../imgs/gal/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "<div class='alert alert-primary' role='alert'>File is an image" . $check["mime"] . ".</div>";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "<div class='alert alert-primary' role='alert'>The file". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</div>";
        // Prepare an insert statement
        $filename = "gal/". trim(basename( $_FILES["fileToUpload"]["name"]));
        $id = $_GET['id'];
        $sql = "UPDATE `products` SET `img`='".$filename."' WHERE id = '".$id."' ";

        if (mysqli_query($conn, $sql)) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . mysqli_error($conn);
        }

        mysqli_close($conn);



  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

}

?>


<?=template_header('Image_upload')?>

<div class="container wrapper">
<form action="" method="post" enctype="multipart/form-data">
  Select image to upload:<?php echo $_GET['id'] ;?><p>
  <input type="file" name="fileToUpload" id="fileToUpload"><p>
  <input type="submit" value="Upload Image" name="submit"><p>
</form>
</div>

<SCRIPT>
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 2000);

</SCRIPT>


<?=template_footer()?>
