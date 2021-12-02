<?php
if (isset($_FILES["fileToUpload"])) {
    $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)) {
    echo "This file has been uploaded";
}
}

?>
<!DOCTYPE html>

<html>

<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload"id="fileToUpload">
        <input type="submit" name="Upload Image"id="submit">
        </form>
</body>
</html>