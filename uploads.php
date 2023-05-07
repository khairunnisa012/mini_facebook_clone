<?php
/*session_start();
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$fn = $_FILES["fileToUpload"]["name"];
$user=
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}


if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}


if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}


if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    $con = mysqli_connect("localhost","root","","fb");
    $st1 = "insert into uploads values('".$fn.","$_SESSION["name_"]"')";
    $res1 = mysqli_query($con,$st1);
    if($res1)
    {
        echo "inserted file into database";
    }
  
}
 else {
    echo "Sorry, there was an error uploading your file.";
  }
}*/
?>
<?php
session_start();

   if(isset($_POST["submit"]) && !empty($_FILES["fileToUpload"]["name"])){
      $errors= array();
      $file_name = $_FILES["fileToUpload"]["name"];
      $file_size = $_FILES["fileToUpload"]["size"];
      $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
      $file_type = $_FILES["fileToUpload"]["type"];
      $dedir="uploads/".$file_name;
      $ty=time();
      $id=$_SESSION['name_'];
     
      
      
         if(move_uploaded_file($file_tmp,$dedir)){
         $con = mysqli_connect("localhost","root","","fb");
	 if($con){
	
	$sql_q="INSERT into uploads (id,path,po_time) values ('$id','$dedir','$ty');";
	if(mysqli_query($con,$sql_q)){
	echo "uploaded successfully";
  header("location:fdash.php");
}
}
      }
mysqli_close($con);
   }
else
echo "error";
?>