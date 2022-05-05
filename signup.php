<?php

$showAlert=false;
  $show_Error = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
  
  include 'partial/db_connect.php';
   
  $username = $_POST["username"];

  $password =$_POST["password"];
  $cpass =$_POST["cPassword"];
  $exists = false;

  //check whether particular user exist or not
  $existsql = "SELECT * FROM `users` WHERE username = '$username'";
  $result = mysqli_query($conn,$existsql);
  $numexistrows = mysqli_num_rows($result);
  if($numexistrows>0){
    $show_Error ="Username Already Exist";
  }
  else{
    if(($password== $cpass) && $exists==false)
    {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users` ( `Username`, `Password`, `DOE`) VALUES ('$username', '$hash', current_timestamp())";
    $result = mysqli_query( $conn ,$sql);
    if($result){
      $showAlert =true;
    }
    }
    else{
      $show_Error = 'Password do not match';
    
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
    <link rel="stylesheet" href="style.css">
    <title>Sign up</title>
  </head>
  <body>
     <?php
     
     require 'partial/nav.php';
      ?>
<!-----alert section-->
<?php
if($showAlert){
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your Account has been created and you can login to the page.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> ';
}
if($show_Error){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>'.$show_Error.'.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div> ';
  }
?>


     <div class="container my-4">
     <h1 class= "text-center"> Signup to our Website</h1>


     <form class="hello"  action= "/login sys/signup.php" method ="post">
     <div class="mb-3 form-group">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name ="username" >
    
  </div>
  
  
  <div class="mb-3 form-group ">
  <label for="Password" class="form-label">Password</label>
    <input type="password" class="form-control"name ="password" id="Password">
  </div>
  <div class="mb-3 form-group ">
    <label for="cPassword" class="form-label"> Confirm Password</label>
    <input type="password" class="form-control" id="cPassword" name="cPassword">
    <p>Make sure to type the same password</p>
  </div>
  
  <button type="submit" class="btn btn-primary ">SignUp</button>
</form>

     </div>

    



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>