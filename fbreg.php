<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'fb';

$con = mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

if(mysqli_connect_error()){
    exit('Error connecting to the database'.mysqli_connect_error());
}

if(!isset($_POST['name'],$_POST['email'],$_POST['password']))
{
    exit('Empty Field(s)');
}

if(empty($_POST['name'] || empty($_POST['email'])||empty($_POST['password']))){
    exit('Values Empty');
}

if($sql = $con->prepare('SELECT Name,Email,Password FROM fb WHERE name = ?')){
    $sql->bind_param('s',$_POST['name']);
    $sql->execute();
    $sql->store_result();
    if($sql->num_rows>0)
    {
        echo 'Username already exists. Try Again!';
    }
    else
    {
        if($sql = $con->prepare('INSERT INTO fb(Name,Email,Password) VALUES (?,?,?)'))
        {
            $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
            $sql->bind_param('sss',$_POST['name'],$_POST['email'],$_POST['password']);
            $sql->execute();
            echo 'Successfully Registered';
            header("Location:details.html");
        }
        else
        {
            echo 'Error Occurred';
        }
    }
    $sql->close();
}
else{
    echo 'Error Occurred';
}
$con->close();
?>