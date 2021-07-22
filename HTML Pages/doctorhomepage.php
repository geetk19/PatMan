<?php
    
    require_once('../partial/_dbcon.php');
    session_start();
    $username= $_SESSION['username'];
    $password=$_SESSION['password'];
    $passwords=md5($password);
    $sql="SELECT * FROM hospital_dr where username='$username' and `password`='$passwords'";
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
    <title>Doctor 1</title>
    <link rel="stylesheet" href="doctorhomepage.css">
	
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
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
                    <a href="../map/about.php">About Us</a>
                </li>
                <li>
                    <a href="../map/contact.php">Contact Us</a>
                </li>
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
        <section class="pat_head">
            <form method="post" class="search" name="search_form">
                <input type="text" id="searchId" placeholder="Search by patient ID"  name="search"
                style="border-radius:30px;padding: 5px 5px;outline: none;margin-bottom: 2.5%;" autocomplete="off" required>
                <button class="search_btn" type="submit" name="search_submit"
                style="border:none;background:transparent;position:absolute;top:7%;right:5%;cursor:pointer;outline:none;">
                    <i class="material-icons" style="font-size: 20px;">search</i></button>
            </form>
            <span class="add_btn">Add Record: </span><button class="add_rec" onclick="addForm()"><i class="material-icons">add_circle_outline</i></button>
		
        </section>
        <div class="note">
            <p class="title">Patient's List</p>
            <p class="doc_note"><span class="doc_note_head">Note: </span>You can only view patients previous records.</p>
        </div>
        <hr>
        <div class="pat_list" id="pat_list">
            <?php 
                if(isset($_POST['search_submit'])):
                    if(isset($_POST['search'])):
                        $search = "SELECT patient.pat_name,patient.pat_id,patient.pat_contact,pat_gender FROM patient WHERE patient.pat_id=?";
                        $search_pre = $conn->prepare($search);
                        $search_pre->bind_param('s',$_POST['search']);
                        $search_pre->execute();
                        $search_get = $search_pre->get_result();
                        $row_no = $search_get->num_rows;
                        if($row_no==0):
            ?>
                <section class="empty">
                    <img src="Assets/empty-white-box.png" alt="empty" height="150px" width="150px">
                    <p class="context">Record is empty.</p>
                </section>
            <?php else:
                        while($search_res=$search_get->fetch_assoc()):
            ?>
                <section class="doc_box" id="<?php echo $search_res['pat_id']; ?>" onclick="test(this.id);">
                    <div class="inner"></div>
                    <p class="pat_name"><?php echo $search_res['pat_name'] ?></p>
                    <p class="pat_id"><?php echo $search_res['pat_id'] ?></p>
                    <p class="contact"><?php echo $search_res['pat_contact'] ?></p>
                    <p class="last_visit">Last Visit: NA</p>
                    <?php 
                    if($search_res['pat_gender']=='male'):
                    ?>
                    <img src="Assets/male_user_icon.png" alt="doctor_icon" height="130" width="130">
                    <?php elseif($search_res['pat_gender']=='female'): ?>
                    <img src="Assets/female_user_icon.png" alt="doctor_icon" height="130" width="130">
                    <?php else: ?>
                    <img src="Assets/user_icon.png" alt="doctor_icon" height="130" width="130">
                    <?php endif; ?>
                </section>
            <?php 
            endwhile;
            endif;
            endif;
            else:
                $sql = "SELECT prescription.dr_id,prescription.pat_id,prescription.prescription_id,hospital_dr.dr_name,hospital.hospital_name,patient.pat_name,patient.pat_gender,patient.pat_contact,MAX(date) date FROM prescription INNER JOIN patient ON patient.pat_id=prescription.pat_id INNER JOIN hospital_dr ON hospital_dr.dr_id=prescription.dr_id INNER JOIN hospital ON hospital.hospital_id = hospital_dr.hospital_id WHERE hospital_dr.username=? GROUP BY prescription.pat_id,prescription.dr_id";
                $sql_prep = $conn->prepare($sql);
                $sql_prep->bind_param('s',$username);
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
                <section class="doc_box" id="<?php echo $row['pat_id']; ?>" onclick="test(this.id);">
                <div class="inner"></div>
                    <p class="pat_name"><?php echo $row['pat_name'] ?></p>
                    <p class="pat_id"><?php echo $row['pat_id'] ?></p>
                    <p class="contact"><?php echo $row['pat_contact'] ?></p>
                    <p class="last_visit">Last Visit: <?php echo $row['date'] ?></p>
                    <?php 
                    if(strtolower($row['pat_gender'])=='male'):
                    ?>
                    <img src="Assets/male_user_icon.png" alt="doctor_icon" height="130" width="130">
                    <?php elseif(strtolower($row['pat_gender'])=='female'): ?>
                    <img src="Assets/female_user_icon.png" alt="doctor_icon" height="130" width="130">
                    <?php else: ?>
                    <img src="Assets/user_icon.png" alt="doctor_icon" height="130" width="130">
                    <?php endif; ?>
                    <input type="hidden"  value="<?php echo $row['pat_id']; ?>" name="pid">
                </section>
            <?php endwhile; ?>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </main>
    <div class="add_pat" id="pop_up">
        <?php 
            $sql_query = "SELECT * from patient;";
            $sql_query_prep = $conn->prepare($sql_query);
            $sql_query_prep->execute();
            $sql_query_get = $sql_query_prep->get_result();
            $num_rows = $sql_query_get->num_rows;
            // $id = strval($no_row) + strval($num_rows);
            $id = (string)$no_row.(string)$num_rows;
            $hex_id = substr(md5($id),1,8);
            // echo $hex_id;
            sleep(1);
            if(isset($_POST['add_form'])){
                if(isset($_POST['name']) && isset($_POST['contact']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['password'])){
                    $add_query = "INSERT INTO `patient`(`pat_id`, `pat_name`, `pat_password`, `pat_contact`, `pat_email`, `pat_gender`) VALUES (?,?,?,?,?,?);";
                    $add_query_pre = $conn->prepare($add_query);
                    $pass=md5($_POST['password']);
                    sleep(0.5);
                    $add_query_pre->bind_param('sssiss',$hex_id,$_POST['name'],$pass,$_POST['contact'],$_POST['email'],$_POST['gender']);
                    $add_query_pre->execute();
                    $conn->commit();
                    $prescr_query = "INSERT INTO `prescription`(`dr_id`, `pat_id`, `heading`, `sub_heading`, `message`, `date`, `time`) VALUES (?,?,?,?,?,?,?);";
                    $prescr_query_pre = $conn->prepare($prescr_query);
                    $date = date("Y-m-d");
                    $time = date("h:i");
                    $heading = 'Prescription Heading';
                    $subhead = 'Prescription SubHeading';
                    $msg = 'Prescription Message';
                    $prescr_query_pre->bind_param('issssss',$dr_id,$hex_id,$heading,$subhead,$msg,$date,$time);
                    $prescr_query_pre->execute();
                    $conn->commit();
                    $_SESSION['ph']=$_POST['contact'];
                    $_SESSION['email']=$_POST['email'];
                    $_SESSION['pat']=$hex_id;
                    $_SESSION['nam']=$_POST['name'];
                    header('Location: doctorhomepage.php');
                }
            }
        ?>
                <?php
                    if(isset($_SESSION['ph'])){
                        $ph=$_SESSION['ph'];
                        $em=$_SESSION['email'];
                        $pat=$_SESSION['pat'];
                        $nam=$_SESSION['nam'];
                        $sms=" $nam Your account has been created successfully with ID: $pat and Email ID: $em .Don't Share your ID with anyone";
                        send_sms($ph,$sms);
                    }
                    function send_sms($ph,$sms){

   
                        unset($_SESSION['ph']);
                        $fields = array(
                            "sender_id" => "FSTSMS",
                            "message" => $sms,
                            "language" => "english",
                            "route" => "p",
                            "numbers" => $ph,
                        );
                        
                        $curl = curl_init();
                        
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_SSL_VERIFYHOST => 0,
                          CURLOPT_SSL_VERIFYPEER => 0,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS => json_encode($fields),
                          CURLOPT_HTTPHEADER => array(
                            "authorization: Uvc5TO0fPgK3t1qAr9b2w4JRQokWleVINDMuYEmdsCXBxhjZL63Bidp6ObyTqgXWUZ8FutkSzV7Cs2YL",
                            "accept: */*",
                            "cache-control: no-cache",
                            "content-type: application/json"
                          ),
                        ));
                        
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        
                        curl_close($curl);
                        
                        if ($err) {
                          echo "cURL Error #:" . $err;
                        } else {
                          echo $response;
                        }
                    
                    
                    
                    }          
                    ?>
                
                
        <p class="pat_id">Patient Id: <span><?php echo $hex_id ?></span></p>
        <form method="post" name="mainForm">
            <input type="text" id="name" name="name" autocomplete="off" required>
            <label for="name" class="name">Name</label><br>
            <input type="number" id="contact" name="contact" autocomplete="off" minlength="10" maxlength="10" title="please enter 10 digit contact number." required>
            <label for="contact" class="contact">Contact No.</label><br>
            <input type="radio" id="male" name="gender" value="male" checked>
            <label for="male">Male</label>
            <input type="radio" id="female" value="female" name="gender">
            <label for="female">Female</label>
            <input type="radio" id="other" value="other" name="gender">
            <label for="other">Other</label><br>
            <input type="email" id="email" name="email" autocomplete="off" required>
            <label for="email" class="email">Email</label><br>
            <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" autocomplete="off" required>
            <label for="password" class="password">Password</label><br>
            <button type="submit" name="add_form" >Add</button>  
            <button type="button" onclick="remove()">Cancel</button>
        </form>
        <img src="Assets/male_user_icon.png" alt="doctor_icon" height="150" width="150" id="icon">
    </div>
</body>
<script>
    document.body.onload = function (e) {
        var form = document.getElementById("pop_up");
        form.classList.add('disp_none');
        form.classList.remove('disp_block');
    }

    document.mainForm.onclick = function () {
        var gender = document.querySelector('input[name = gender]:checked').value;
        console.log(gender);
        if (gender=='male') {
            document.getElementById("icon").src = "Assets/male_user_icon.png";
        }

        if (gender=='female') {
            document.getElementById("icon").src = "Assets/female_user_icon.png";
        }

        if (gender=='other') {
            document.getElementById("icon").src = "Assets/user.png";
        }
    }
    
    function test(id){
        window.location.href = 'doctor_2.php?pid='+id;
    }

    function addForm() {
        var form = document.getElementById("pop_up");
        form.style.display = "block";
        setTimeout(work, 100);
        function work() {
            var form = document.getElementById("pop_up");
            form.classList.add('disp_block');
            form.classList.remove('disp_none');
            document.querySelector("main").style.display = "none";
        }
    }
    function remove() {
        var form = document.getElementById("pop_up");
        form.classList.add('disp_none');
        form.classList.remove('disp_block');
        setTimeout(work, 300);
        function work() {
            form.style.display = "none";
            document.querySelector("main").style.display = "block";
        }
    }
    document.forms("mainForm").onsubmit = function() {
        var form = document.getElementById("pop_up");
        form.style.display = "block";
        setTimeout(work, 100);
        function work() {
            form.classList.add('disp_none');
            form.classList.remove('disp_block');
            document.querySelector("main").style.display = "block";
        }
    }
</script>
</html>
