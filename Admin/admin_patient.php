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
    <title>Doctor List</title>
    <link rel="stylesheet" href="admin_patient.css">
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
                    <a href="./admin.php">Home</a>
                </li>
                <li>
                    <a href="#">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="down">
            <path fill="#0099ff" fill-opacity="1" d="M0,192L480,160L960,224L1440,0L1440,320L960,320L480,320L0,320Z">
            </path>
        </svg>
        <?php  
                $sqli="SELECT DISTINCT prescription.pat_id,patient.pat_name FROM prescription  INNER JOIN patient ON patient.pat_id=prescription.pat_id INNER JOIN hospital_dr ON hospital_dr.dr_id=prescription.dr_id INNER JOIN hospital ON hospital.hospital_id=hospital_dr.hospital_id INNER JOIN admin ON admin.hospital_id=hospital.hospital_id AND admin.admin_username='$username'";
                $numi=mysqli_query($con,$sqli);
        ?>
        <section class="pat_list">
            <section class="note">
                <p class="list">Patients List</p>
            </section>
            <?php
                if(mysqli_num_rows($numi)>0):
                while($row=mysqli_fetch_assoc($numi)):
            ?>
            <section class="pat_row">
                <div class="inner"></div>
                <p class="pat_name"><?php echo $row['pat_name'];?></p>
                <span class="pat_userid">UserId: <?php echo $row['pat_id'];?></p></span>
            </section>
            <?php
                endwhile;
            endif;
            ?>
        </section>
    </main>
</body>

</html>