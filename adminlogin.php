<?php

require_once "databasecon.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username= $_POST['username'];
    $passwords= $_POST['password'];
    $usernameCount = 0;
    $passwordsCount = 0;

    // echo '<pre>';
    // echo print_r($results);
    // echo '</pre>';
    // exit;

  
        if($username === "admin" && $passwords === "password") {
            $usernameCount = 1;
            $passwordsCount = 1;
        } elseif ($username === "admin" && $passwords != "password") {
          $usernameCount = 1;
          $passwordsCount = 0;
        } elseif($username != "admin" && $passwords != "password") {
            $usernameCount = 0;
            $passwordsCount = 0;
        }
    
    if($usernameCount == 0) {
        $errors[] = 'Username doesn\'t exist.';
    } 

    if($passwordsCount == 0) {
        $errors[] = 'Incorrect password. Try again.';
    }
   
    if($usernameCount === 1 && $passwordsCount === 1)
    {
        header("Location: admin.php");
    }

  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  <link href="/project/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <link href="/project/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="wrapper">
  <?php if($errors): ?>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="alert alert-danger">
                    <?php foreach($errors as $error): ?>
                        <div><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-4"></div>
        </div>  
    <?php endif; ?>
    <section class="form login">
      <header>Admin Login</header>
      <form action="adminlogin.php" method="POST">
        <div class="field input">
          <lable>Name</lable>
          <input type="text" name="username">
        </div>
        <div class="field input">
          <lable>Password</lable>
          <input type="text" name="password">
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="Login">
        </div>
      </form>
    </section>
    <script src="pass-show-hide.js"></script>
  </div>
</body>
</html>