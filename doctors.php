<?php

// echo '<pre>';
//     echo print_r($_GET);
//     echo '</pre>';
//     exit;
$username = $_GET['name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/project/dashboard.css">
    <title>Doctor's dashboard</title>
</head>
<body>
   <div class="container">
    
        <div class="row"style="border:1px solid black;">
            <div class="col-2"style="border:1px solid black;">HPMS</div>
            <div class="col-10"><p style="float:right;">HOSPITAL PATIENT MANAGEMENT SYSTEM</p></div>
        </div>
        <div class="row">
            
             <div class="col-2"style="border:1px solid black;">
                <div class="row">
                    <img src="hospital.png"alt="hosp"style="height:250px; width:800px;">
                </div>

                    <!--<div class="row"style="border:1px solid black;">main navigation</div>
                    <div class="row"style="border:1px solid black;">Dashboard</div>
                    <div class="row"style="border:1px solid black;">Doctor</div>
                    <div class="row"style="border:1px solid black;">Patient</div>
                    <div class="row"style="border:1px solid black;">Appointment history</div>-->
               
                
            </div>
            
                <div class="col-10">
                    <div class="row"style="border:1px solid black;" >
                        <div class="row" >
                            <div class="col-12">
                                <p style="float:right;">Doctor / dashboard </p>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-12">
                              <h3>Doctor | dashboard</h3>
                            </div>
                            <div class="button-container">
                                <button class="rectangular-button" >
                                    <a href="/project/doctorsappointments.php?<?php echo $_SERVER['QUERY_STRING'];?>">View Appointments</a>
                                    
                                </button>
                                <button class="rectangular-button" >
                                    <a href="/project/diagnosis.php?<?php echo $_SERVER['QUERY_STRING'];?>">Update Diagnosis</a>
                                    
                                </button>

                              </div>
                            
                         </div>
                         
                    </div>
                    
                    
                </div>
                
                </div>
                
                
                       
                    
                </div>
    
    
    
            </div>
        </div>
        
   </div>
</body>
</html>