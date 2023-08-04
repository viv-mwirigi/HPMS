<?php

require_once "databasecon.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username= $_POST['username'];
    $passwords= $_POST['passwords'];


    $checkAccounts = $pdo->prepare("SELECT * FROM patients where name = :username");
    $checkAccounts->bindValue(':username', $username);
    $checkAccounts->execute();
    $results = $checkAccounts->fetchAll();
    $usernameCount = 0;
    $passwordsCount = 0;

    // echo '<pre>';
    // echo print_r($results);
    // echo '</pre>';

    foreach($results as $i => $result){
        if($result['name'] === $username && $result['password'] === $passwords) {
            $usernameCount = 1;
            $passwordsCount = 1;
        } elseif ($result['name'] === $username && $result['password'] != $passwords) {
          $usernameCount = 1;
          $passwordsCount = 0;
        } elseif($result['name'] != $username && $result['password'] != $passwords) {
            $usernameCount = 0;
            $passwordsCount = 0;
        }
    }
    
    if($usernameCount == 0) {
        $errors[] = 'Username doesn\'t exist.';
    } 

    if($passwordsCount == 0) {
        $errors[] = 'Incorrect password. Try again.';
    }

   
   
    if($usernameCount === 1 && $passwordsCount === 1)
    {
        header("Location: patients.php?name=$username");
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
      <header>Patient Login</header>
      <form action="patientlogin.php" method="POST">
        <div class="field input">
          <lable>Name</lable>
          <input type="text" name="username">
        </div>
        <div class="field input">
          <lable>Password</lable>
          <input type="password" name="passwords">
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="Login">
        </div>
      </form>
      <div class="link">
        Not yet a user? <a href="signup.php">Signup now</a>
      </div>
    </section>
    <script src="pass-show-hide.js"></script>
  </div>
</body>
</html>