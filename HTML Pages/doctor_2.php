<?php
    require_once('../partial/_dbcon.php');
    session_start();
    $username= $_SESSION['username'];
    $password=$_SESSION['password'];
    $passwords=md5($password);
    $sql="SELECT * FROM `hospital_dr` where username='$username' and `password`='$passwords'";
    $result=mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $num==0){
    header('location: ../doctorlogin.php');
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
    <title>Doctor 2</title>
    <link rel="stylesheet" href="doctor_2.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <header>
        <nav class="navigation">
            <span class="logo">PATMAN</span>
            <ul>
                <li>
                    <a href="../Profile Section/profile_doctor.php"><?php echo $username ?></a>
                </li>
                <li>
                    <a href="../HTML Pages/doctorhomepage.php">Home</a>
                </li>
                <!-- <li>
                    <a href="../map/contact.php">Contact Us</a>
                </li> -->
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="down">
        <path fill="#0099ff" fill-opacity="1" d="M0,32L80,74.7C160,117,320,203,480,202.7C640,203,800,117,960,90.7C1120,64,1280,96,1360,112L1440,128L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
    </svg>
        <section class="doc_head">
            <?php 
                $cont_sql = "SELECT hospital_dr.dr_name,hospital_dr.dr_id,hospital.hospital_name FROM hospital_dr INNER JOIN hospital ON hospital_dr.hospital_id = hospital.hospital_id AND hospital_dr.username = ?";
                $cont_sql_pre = $conn->prepare($cont_sql);
                $cont_sql_pre->bind_param('s',$username);
                $cont_sql_pre->execute();
                $cont_sql_get = $cont_sql_pre->get_result();
                while($row_fetch=$cont_sql_get->fetch_assoc()):
                    $dr_id = $row_fetch['dr_id'];
            ?>
            <p class="hos_name"><?php echo $row_fetch['hospital_name']; ?></p>
            <p class="doc_name"><?php echo 'Dr. '.$row_fetch['dr_name']; ?></p><br>
            <?php endwhile; ?>
        </section>
        <?php 
            $patient_query = "SELECT pat_name from patient where pat_id=?";
            $patient_query_pre = $conn->prepare($patient_query);
            $patient_query_pre->bind_param('s',$_GET['pid']);
            $patient_query_pre->execute();
            $pat_name = $patient_query_pre->get_result();
            while($name = $pat_name->fetch_assoc()):
        ?>
        <section class="pat_head">
            <p class="pat_name"><?php echo $name['pat_name']; ?></p>
            <p class="pat_id">Patient Id: <?php echo $_GET['pid']; ?></p>
            <form method="post" id="prescr" name="prescr">
                <span class="add_btn">Add Record: </span><button type="submit" name="presc" class="add_rec"><i class="material-icons" onclick="add_prescr();">add_circle_outline</i></button>
            </form>
        </section>
        <?php endwhile; ?>
        <?php
         if(isset($_POST['presc'])){
            $check = "SELECT dr_id from prescription where pat_id=? and dr_id=?";
            $check_pre = $conn->prepare($check);
            $check_pre->bind_param("ss",$_GET['pid'],$dr_id);
            $check_pre->execute();
            $check_get = $check_pre->get_result();
            $row_count = $check_get->num_rows;
            if($row_count==0){
                $prescr_query = "INSERT INTO `prescription`(`dr_id`, `pat_id`, `heading`, `sub_heading`, `message`, `date`, `time`) VALUES (?,?,?,?,?,?,?);";
                $prescr_query_pre = $conn->prepare($prescr_query);
                $date = date("Y-m-d");
                $time = date("h:i");
                $heading = 'Prescription Heading';
                $subhead = 'Prescription SubHeading';
                $msg = 'Prescription Message';
                $prescr_query_pre->bind_param('issssss',$dr_id,$_GET['pid'],$heading,$subhead,$msg,$date,$time);
                $prescr_query_pre->execute();
                $conn->commit();
            }
            header('Location: doctor_3.php?did='.$dr_id.'&patid='.$_GET['pid']);
        }
        ?>
        <div class="note">
            <!-- <p class="title">Patient details</p> -->
            <p class="title">Visited doctors</p>
            <p class="doc_note"><span class="doc_note_head">Note: </span>You can only view patients previous records.</p>
        </div>
        <hr>
        <div class="pat_list">
            <?php 
                // $sql = "SELECT DISTINCT hospital.hospital_name,hospital_dr.dr_name,hospital_dr.dr_id,prescription.date FROM hospital_dr INNER JOIN prescription ON hospital_dr.dr_id = prescription.dr_id AND prescription.pat_id=? AND prescription.date = (SELECT max(prescr.date) FROM prescription prescr where prescr.pat_id=? ) INNER JOIN hospital ON hospital.hospital_id=hospital_dr.hospital_id";
                $sql = "SELECT prescription.dr_id,prescription.pat_id,prescription.prescription_id,hospital_dr.dr_name,hospital.hospital_name,patient.pat_name,patient.pat_contact,MAX(date) date FROM prescription INNER JOIN patient ON patient.pat_id=prescription.pat_id INNER JOIN hospital_dr ON hospital_dr.dr_id=prescription.dr_id INNER JOIN hospital ON hospital.hospital_id = hospital_dr.hospital_id WHERE patient.pat_id=? GROUP BY prescription.pat_id,prescription.dr_id";
                $sql_prep = $conn->prepare($sql);
                $sql_prep->bind_param('s',$_GET['pid']);
                $sql_prep->execute();
                $sql_get = $sql_prep->get_result();
                $no_row = $sql_get->num_rows;
                if($no_row==0):
            ?>
             <section class="empty">
                <img src="Assets/empty-white-box.png" alt="empty" height="150px" width="150px">
                <p class="context">Record is empty.</p>
            </section>
            <?php else: 
                while($row=$sql_get->fetch_assoc()):    
            ?>
            <section class="doc_box" id="<?php echo $row['dr_id']; ?>" onclick="test(this.id);">
                <div class="inner"></div>
                <p class="visited_hos_name"><?php echo $row['hospital_name']; ?></p>
                <p class="ass_doc_name"><?php echo 'Dr. '.$row['dr_name']; ?></p>
                <p class="last_visit">Last Visit: <?php echo $row['date']; ?></p>
                <img src="Assets/doctor_icon.png" alt="doctor_icon" height="130" width="130">
            </section>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </main>
</body>
<script>
    function test(id){
        var pid = "<?php echo $_GET['pid']; ?>";
        window.location.href = 'doctor_3.php?did='+id+'&patid='+pid;
    }
    function add_prescr(){
        document.getElementById("prescr").submit();
    }
</script>
</html>