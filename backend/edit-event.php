<?php
session_start();

if($_SESSION["user"]==null){
  header("location: login.php");
}
include_once('connection.php'); 



if(isset($_POST["submit"])) {

  $target_dir = "../events/slider-images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
   // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    $image = test_input($_FILES["fileToUpload"]["name"]);
    $id = test_input($_GET["id"]);
    $sql = "Update events set image='$image' where id=$id";
    $result = $mysqli->query($sql); 
    header("location: event-listings.php");
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}



}



$id=-1;
if(isset($_GET['id'])){
$id = $_GET['id'];
}

$sql = " SELECT * FROM events where id=$id";
$result = $mysqli->query($sql);
$mysqli->close();
include_once('header.php');
?>
<div class="main-container">
<div id="page-body">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="container-box">
            <h1>Update Event</h1>
            <table class="edit-table" cellpadding="4" cellspacing="4">
            <?php 
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td>&nbsp;</td>  
                <td colspan="2"><label class="label"><?php echo $rows['title'];?></label></td>
            </tr>
            <tr>
                <td>&nbsp;</td>    
                <td colspan="2"><input type="file" name="fileToUpload" id="fileToUpload" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2"><img src="../events/slider-images/<?php echo $rows['image'];?>" width="25%"/></td>
            </tr>
            <?php
                }
            ?>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2"><input class="button" type="submit"
                     name="submit" value="Update"></td>
          </tr>
              </table>
        </div>
    </form>
    </div>

</div>
</body>

</html>
