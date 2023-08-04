<?php 

require_once "databasecon.php";


$statement  =$pdo->prepare('SELECT * FROM patients');
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/project/managedoctors.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row title-space">
            <div class="col-3">
                <div class="style-col-2-head">
                    <div>
                        <h1>
                            HMS
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="style-col-10-head">
                    <div>
                        <h1 class="title-style">
                            Hospital patient management system
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row main-space">
            <div class="col-3">
                <div class="row nav-text">
                    <div class="style-col-2-body">
                        <div>
                            <p>
                                Main navigation
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="style-col-2-body">
                        <div>
                            <a href="/project/admin.php">
                                <p>
                                    Dashboard
                                </p>
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="style-col-2-body">
                        <div>
                            <a href="/project/managedoctors.php">
                                <p>
                                    Doctors
                                </p>
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="style-col-2-body">
                        <div>
                            <a href="/project/managepatients.php">
                                <p>
                                    Patients
                                </p>
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                
                <div class="row body-over">
                    <div class="style-col-10-body-over">
                        <div>
                            <h3 class="title-style-body">
                                Patients |    
                            </h3>
                            <p>
                                Showing list of patients.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="push-in">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            
                            <th scope="col">Username</th>
                            <th scope="col">First name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Age</th>
                            <th scope="col">Password</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $i => $user): ?>
                    <tr>
                        <th scope="row"><?php echo $i + 1 ?></th>
                        <td><?php echo $user['name'] ?></td>
                        <td><?php echo $user['firstname'] ?></td>
                        <td><?php echo $user['lastname'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['age'] ?></td>
                        <td><?php echo $user['password'] ?></td>
                        <td>
                    <form method="post" action="admindeletepatients.php" style="display: inline-block">
                        <input type="hidden" name="username" value="<?php echo $user['name'] ?>">
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
                </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>  
                </table>
                    </div>
               </div>
                
            </div>
        </div>
    </div>
</body>
</html>