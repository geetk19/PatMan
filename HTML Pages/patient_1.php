<?php
    require_once('../partial/_dbcon.php');
    session_start();
    $username=$_SESSION['username'];
    $password=$_SESSION['password'];
    $passwords=md5($password);
    $sql="SELECT * FROM patient where pat_id='$username' and `pat_password`='$passwords'";
    $result=mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $num==0){
        header('location: ../patientlogin.php');
        exit;
         }
    else{
     require_once('dbconnect.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient 1</title>
    <link rel="stylesheet" href="patient_1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <header>
        <nav class="navigation">
            <span class="logo">PATMAN</span>
            <ul>
                <li>
                    <a href="../Profile Section/profile_patient.php"><?php echo $username; ?></a>
                </li>
                <!-- <li>
                    <a href="">About Us</a>
                </li>
                <li>
                    <a href="#">Contact Us</a>
                </li> -->
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <?php 
            $patient_query = "SELECT pat_name from patient where pat_id=?";
            $patient_query_pre = $conn->prepare($patient_query);
            $patient_query_pre->bind_param('s',$username);
            $patient_query_pre->execute();
            $pat_name = $patient_query_pre->get_result();
            while($name = $pat_name->fetch_assoc()):
        ?>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="down">
        <path fill="#0099ff" fill-opacity="1" d="M0,32L80,74.7C160,117,320,203,480,202.7C640,203,800,117,960,90.7C1120,64,1280,96,1360,112L1440,128L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
    </svg>
        <section class="pat_head">
            <p class="pat_name"><?php echo $name['pat_name']; ?></p>
            <p class="pat_id"><?php echo "ID: ".$username; ?></p><br>
        </section> 
        <?php endwhile; ?>
        <section class="search_head">
            <p class="dropdown">Select Hospital</p>
            <ul class="dropdown_element">
                <?php 
                    $hospital = "SELECT DISTINCT hospital.hospital_name from hospital INNER JOIN hospital_dr ON hospital_dr.hospital_id = hospital.hospital_id INNER JOIN prescription ON hospital_dr.dr_id = prescription.dr_id AND prescription.pat_id = ?";
                    $hospital_pre = $conn->prepare($hospital);
                    $hospital_pre->bind_param('s',$username);
                    $hospital_pre->execute();
                    $hospital_get = $hospital_pre->get_result();
                    while($hospital_name = $hospital_get->fetch_assoc()):
                ?>
                <li><a href="#<?php echo $hospital_name['hospital_name']; ?>"><?php echo $hospital_name['hospital_name']; ?></a></li>
                    <?php endwhile; ?>
            </ul>
        </section>
        <div class="note">
            <!-- <p class="title">Patient details</p> -->
            <p class="title">Doctors List</p>
            <!-- <p class="doc_note"><span class="doc_note_head">Note: </span>You can only view patients previous records.</p> -->
        </div>
        <hr>
        <div class="pat_list">
            <!-- <section class="empty">
                <img src="Assets/empty-white-box.png" alt="empty" height="150px" width="150px">
                <p class="context">Record is empty.</p>
            </section> -->
            <?php
                $drop ="SELECT hospital_dr.specialization, prescription.dr_id,prescription.pat_id,prescription.prescription_id,hospital_dr.dr_name,hospital.hospital_name,patient.pat_name,hospital_dr.gender,patient.pat_contact,MAX(date) date FROM prescription INNER JOIN patient ON patient.pat_id=prescription.pat_id INNER JOIN hospital_dr ON hospital_dr.dr_id=prescription.dr_id INNER JOIN hospital ON hospital.hospital_id = hospital_dr.hospital_id WHERE patient.pat_id=? GROUP BY prescription.pat_id,prescription.dr_id";
                $drop_pre = $conn->prepare($drop);
                $drop_pre->bind_param('s',$username);
                $drop_pre->execute();
                $drop_get = $drop_pre->get_result();
                while($doctor = $drop_get->fetch_assoc()):
            ?>
                <section class="doc_box" id="<?php echo $doctor['hospital_name']; ?>" data-doctor="<?php echo $doctor['dr_name']; ?>" onclick="test(this.id,this.getAttribute('data-doctor'));">
                <div class="inner"></div>
                <p class="visited_hos_name"><?php echo $doctor['hospital_name']; ?></p>
                <p class="ass_doc_name"><?php echo 'Dr. '.$doctor['dr_name']; ?></p>
                <p class="specialization"><?php echo $doctor['specialization']; ?></p>
                <p class="last_visit">Last Visit: <?php echo $doctor['date']; ?></p>
                <?php if(strtolower($doctor['gender'])=='male'): ?>
                <img src="Assets/doctor_icon.png" alt="doctor_icon" height="130" width="130">
                <?php elseif(strtolower($doctor['gender'])=='female'): ?>
                <img src="Assets/female_doctor_icon.png" alt="doctor_icon" height="130" width="130">
                <?php endif; ?>
            </section>
            <?php endwhile; ?>
        </div>
    </main>
</body>
<script>
    function test(id,name){
        window.location.href = 'patient_2.php?hospital name='+id+'&doctor='+name;
    }
</script>
</html>
