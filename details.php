<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'fb';

$con = mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

if(mysqli_connect_error()){
    exit('Error connecting to the database'.mysqli_connect_error());
}

if(!isset($_POST['firstname'],$_POST['lastname'],$_POST['dob'],$_POST['email'],$_POST['address'],$_POST['message']))
{
    exit('Empty Field(s)');
}

if(empty($_POST['firstname'] )|| empty($_POST['lastname'])||empty($_POST['dob'])||empty($_POST['email'])||empty($_POST['address'])||empty($_POST['message'])){
    exit('Values Empty');
}

if($sql = $con->prepare('SELECT Fn,Ln,dob,Ea,adr,Bio FROM details WHERE Fn = ?')){
    $sql->bind_param('s',$_POST['firstname']);
    $sql->execute();
    $sql->store_result();
    //Username alremaildy exists
    if($sql->num_rows>0){
        echo 'Username alremaildy exists. Try Again!';
    }
    else{
        if($sql = $con->prepare('INSERT INTO details(Fn,Ln,dob,Ea,adr,Bio) VALUES (?,?,?,?,?,?)'))
        {
           // $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
            $sql->bind_param('ssssss',$_POST['firstname'],$_POST['lastname'],$_POST['dob'],$_POST['email'],$_POST['address'],$_POST['message']  );
            $sql->execute();
            echo 'Successfully Registered';
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

