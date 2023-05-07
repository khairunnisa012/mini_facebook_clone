
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uname = $_POST["email"];
        $psd=$_POST["password"];
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'fb';

        $conn = mysqli_connect($host, $username, $password, $dbname);

        if ($conn) {
            echo "Connection successful.";
        }
        else{
            echo "Connection Failed.";
            die("Connection Failed:".mysqli_connect_error());
        }
        $sql = "select * from fb where Email= '$uname' and Password='$psd'";
        $res = mysqli_query($conn,$sql);
       $fname="select Name from fb where Email= '$uname' and Password='$psd'";
        $s=mysqli_query($conn,$fname);
        if(mysqli_num_rows($res)>0 && mysqli_num_rows($s)>0){
           $_SESSION['email']=$uname;
           while($Data = mysqli_fetch_array($s)){
           $_SESSION['name_']=$Data["Name"];}
           header('Location:fdash.php');
        }
        else{
            echo "Invalid Login!";
            header('Location:fblogin.php');
        }
}
?>