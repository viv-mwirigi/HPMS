<?php

require_once "databasecon.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username= $_POST['username'];
    $email= $_POST['email'];
    $password= $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $specialty = $_POST['specialty'];
    $isAdmin = "false";
    

    $statement = $pdo->prepare("INSERT INTO doctor(username, firstname, lastname, email, password, age, specialty, isAdmin) 
                            VALUES(:username, :firstname, :lastname, :email, :password, :age, :specialty, :isAdmin)");
    $statement->bindValue(':username', $username);
    $statement->bindValue(':firstname', $firstname);
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':age', $age);
    $statement->bindValue(':specialty', $specialty);
    $statement->bindValue(':isAdmin', $isAdmin);
    
    $checkAccounts = $pdo->prepare("SELECT * FROM patients");
    $checkAccounts->execute();
    $results = $checkAccounts->fetchAll();
    $usernameCount = 0;
    $emailCount = 0;

    // echo '<pre>';
    // echo print_r($results);
    // echo '</pre>';

    foreach($results as $i => $result){
        if($result['name'] === $username) {
            $usernameCount = 1;
            
        }

        if($result['email'] === $email) {
            $emailCount = 1;
            
        }
    }
    
    if($usernameCount === 1) {
        $errors[] = 'Username already exists.';
    } 

    if($emailCount === 1) {
        $errors[] = 'Email already exists';
    }

   
   
    if($usernameCount === 0 && $emailCount === 0)
    {
        $statement->execute();
        header("Location: managedoctors.php");
    }

    
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hospital Patient Management System</title>
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
    <section class="form signup">
      <header>Create Doctors account</header>
      <form action="adddoctor.php" method="POST">
        <div class="name-details">
          <div class="field input">
            <lable>Username</lable>
            <input type="text" name="username">
          </div>
        </div>
        <div class="field input">
          <lable>First Name</lable>
          <input type="text" name="firstname">
        </div>
        <div class="field input">
          <lable>Last Name</lable>
          <input type="text" name="lastname">
        </div>
        <div class="field input">
          <lable>Email</lable>
          <input type="email" name="email">
        </div>
        <div class="field input">
          <lable>Age</lable>
          <input type="text" name="age">
        </div>
        <div class="field input">
          <lable>Specialty</lable>
          <input type="text" name="specialty">
        </div>
        <div class="field input">
          <lable>Password</lable>
          <input type="password"name="password">
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="Create Account">
        </div>
      </form>
    </section>

    <script src="pass-show-hide.js"></script>

  </div>
</body>
</html>