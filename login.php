<?php

$login=0;
$invalid=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];

  /*   $sql="insert into `registerations`(username,password)
    values('$username','$password')";
    $result=mysqli_query($con,$sql);

    if($result){
        echo " Data inserted successfully";
    }else{
        die(mysqli_error($con));
    } */

    $username=mysqli_real_escape_string($con,$username);
    $password=mysqli_real_escape_string($con,$password);
    
    //checking username already exists or not


    $sql="SELECT * FROM `registerations` WHERE 
    username='$username' AND password=$password";

    $result=mysqli_query($con,$sql);

    if($result){
        $num=mysqli_num_rows($result);

        if($num>0){
        //    echo " Login Successful";
              $login=1; 
              session_start();
              $_SESSION['username']=$username;
              header('location:home.php');

        }else{
            // echo " Invalid Data";

           $invalid=1;
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login page</title>
  </head>
  <body>
    <?php
     if($login){  
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong>  You are Successfully Logged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
    ?>

    <?php
      if($invalid){  
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Success</strong> Invalid Credntial.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';
    }
    ?>

    <h1 class="text-center">Login To Our Website</h1>
    <div class="container mt-5">
    <form action="login.php" method="post">
    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control"
    placeholder="Enter your username" name="username">
 
</div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" 
    placeholder="Enter your password" name="password">
  </div>

  <button type="submit" class="btn btn-primary 
  w-100">Login</button>
</form>
    </div>

  </body>
</html>
