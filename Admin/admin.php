<?php
    
    require_once('../partial/_dbcon.php');
    session_start();
    $username= $_SESSION['username'];
    $password=$_SESSION['password'];
    $passwords=md5($password);
    $sql="SELECT * FROM `admin` where admin_username='$username' and `admin_password`='$password'";
    $result=mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $num==0){
        header('location: ../adminlogin.php');
        exit;
         }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <header>
        <nav class="navigation">
            <span class="logo">PATMAN</span>
            <ul>
                <li>
                    <a href="#"><?php echo $username;?></a>
                </li>
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="down">
                <path fill="#0099ff" fill-opacity="1" d="M0,192L480,160L960,224L1440,0L1440,320L960,320L480,320L0,320Z"></path>
        </svg>
        <section class="container">
            <?php
                $sql="SELECT hospital_dr.dr_id FROM hospital_dr WHERE hospital_dr.hospital_id=(SELECT hospital_id FROM admin WHERE admin_username='$username')";
                $num=mysqli_query($con,$sql);
                $nums=mysqli_num_rows($num);
            ?>
            <section class="doctor" id="doctor">
                <div class="inner"></div>
                <p class="doc">Doctors List</p>
                <p class="doc_count"><?php echo $nums;?></p>
            </section>
            <?php
                $sqli="SELECT DISTINCT prescription.pat_id FROM prescription INNER JOIN hospital_dr ON hospital_dr.dr_id=prescription.dr_id INNER JOIN hospital ON hospital.hospital_id=hospital_dr.hospital_id INNER JOIN admin ON admin.hospital_id=hospital.hospital_id AND admin.admin_username='$username'";
                $numi=mysqli_query($con,$sqli);
                $numsi=mysqli_num_rows($numi);
            ?>
            <section class="patient" id="patient">
                <div class="inner"></div>
                <p class="pat">Patients List</p>
                <p class="pat_count"><?php echo $numsi;?></p>
            </section>
            <section class="add_doctor" id="add_doctor">
                <div class="inner"></div>
                <p class="add_doc">Add Doctor</p>
                <i class="material-icons">add_circle_outline</i>
            </section>
        </section>
    </main>
</body>
<script>
    document.getElementById("doctor").onclick = function(){
        window.location.href = "admin_doctor.php";
    }
    document.getElementById("patient").onclick = function () {
        window.location.href = "admin_patient.php";
    }
    document.getElementById("add_doctor").onclick = function () {
        window.location.href = "admin_add_doctor.php";
    }
</script>
</html>