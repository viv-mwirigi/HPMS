
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/project/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/project/dashboard.css">
    <title>Dashboard</title>
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
                    <img src="/project/hospital.png"alt="hosp"style="height:250px; width:800px;">
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
                                <p style="float:right;">admin / dashboard </p>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-12">
                              <h3>Admin | dashboard</h3>
                            </div>
                            <div class="button-container">
                                <button class="rectangular-button">

                                <a href="/project/managepatients.php"><img src="/project/patient.png" alt="patient" >manage patients</a>
                                    
                                </button>
                           
                            
                                <button class="rectangular-button" >
                                    <a href="/project/managedoctors.php"><img src="/project/doctor.png" alt="doctor" >manage doctors</a>
                                    
                                </button>
                                <button class="rectangular-button" >
                                    <a href="/project/manageappointments.php"><img src="/project/appointment.png" alt="appt" >manage appointmets</a>
                                    
                                </button>
                                <button class="rectangular-button" >
                                    <a href="/project/adddoctor.php"><img src="/project/doctor.png" alt="appt" >Add Doctor account</a>
                                    
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