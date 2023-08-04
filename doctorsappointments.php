<?php 

require_once "databasecon.php";
$username = '%'.$_GET['name'].'%';

$statement  =$pdo->prepare("SELECT * FROM appointments where doctor like :username");
$statement->bindValue(":username", $username);
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
                            <a href="/project/doctors.php?<?php echo $_SERVER['QUERY_STRING'];?>">
                                <p>
                                    Dashboard
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
                                Appointments |    
                            </h3>
                            <p>
                                Showing list of appoinments.
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
                            <th scope="col">Doctor's name</th>
                            <th scope="col">Scheduled Time</th>
                            <th scope="col">Reschedule</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $i => $user): ?>
                    <tr>
                        <th scope="row"><?php echo $i + 1 ?></th>
                        <td><?php echo $user['username'] ?></td>
                        <td><?php echo $user['firstname'] ?></td>
                        <td><?php echo $user['lastname'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['age'] ?></td>
                        <td><?php echo $user['doctor'] ?></td>
                        <td><?php echo $user['time'] ?></td>
                        <td>
                    <form method="get" action="rescheduleappointments.php" style="display: inline-block">
                        <input type="hidden" name="username" value="<?php echo $user['username'] ?>">
                        <button type="submit" class="btn btn-outline-primary">Reschedule</button>
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