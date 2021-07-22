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
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // include '../partial/_dbcon.php';

    $name=$_POST['name'];
    // $address=$_POST['address'];
    // $cn=$_POST['ClinicName'];
    $eid=$_POST['EmailId'];
    $phno=$_POST['Cont'];
    $_SESSION['ph']=$phno;
    $uid=$_POST['username'];
    $password=$_POST['password'];

        $existSql=false;
        $num=0;

        // Check whether this username exists
        $existSql = "SELECT * FROM `hospital_dr` WHERE username = '$uid';";
        $result = mysqli_query($con, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            // $exists = true;
            $showError1 = "Username Already Exists";
        }
        else{
            // $exists = false;
            if($password!=""){
                $hash = md5($password);

                sleep(2);
                $fetch1="SELECT hospital_id from `admin` WHERE admin_username = '$username'";
                $hi=mysqli_query($con,$fetch1);
                while($row=mysqli_fetch_assoc($hi)){
                    $hid=$row['hospital_id'];
                }
                $gender=$_POST['gender'];
                $sp=$_POST['sp'];
                $age=$_POST['age'];
                $des=$_POST['desg'];
                $exp=$_POST['exp'];
                $sql="INSERT INTO `hospital_dr` (`dr_name`,`gender`,`specialization`,`password`,`hospital_id`,`username`, `email`, `contact_no`,`age`,`designation`,`exp`) VALUES ('$name','$gender','$sp','$hash',$hid,'$uid', '$eid', '$phno','$age','$des','$exp');";
                $result = mysqli_query($con, $sql);
                if ($result){
                    $showAlert1 = true;
                    $showError1 = false;
                    
                    if(isset($_SESSION['ph'])){
                        $ph=$_SESSION['ph'];
                        $em=$eid;
                        $pat=$uid;
                        $nam=$name;
                        $sms=" Dr. $nam Your account has been created successfully with ID: $pat and Email ID: $em .Don't Share your ID with anyone";
                        

   
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
                    header('location: ./admin.php');          

                }
            }
        }


    $con->close();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <link rel="stylesheet" href="admin_add_doctor.css">
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
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="down">
            <path fill="#0099ff" fill-opacity="1" d="M0,192L480,160L960,224L1440,0L1440,320L960,320L480,320L0,320Z"></path>
        </svg>
        <div class="inner"></div>
            <section class="form">
                <form action="admin_add_doctor.php" method="post" >
                    <input type="text" name="name" id="name" autocomplete="off" required>
                    <label for="name" class="name">Dr. Name</label><br>
                    <input type="text" name="username"id="username" autocomplete="off" required>
                    <label for="username" class="username">Dr. Username</label><br>
                    <input type="text" name="password" id="pass" autocomplete="off" required>
                    <label for="pass" class="pass">Dr. Password</label><br>
                    <input type="text" name="EmailId" id="email" autocomplete="off" required>
                    <label for="email" class="email">Dr. Email Id</label><br>
                    <input type="text" name="Cont" id="contact" autocomplete="off" required>
                    <label for="contact" class="contact">Dr. Contact No.</label><br>
                    <input type="text" name="sp" id="specialization" autocomplete="off" required>
                    <label for="specialization" class="specialization">Dr. Specialization</label><br>
                    <input type="text" name="desg" id="designation" autocomplete="off" required>
                    <label for="designation" class="designation">Dr. Designation</label><br>
                    <input type="text" name="exp" id="exp" autocomplete="off" required>
                    <label for="exp" class="exp">Dr. Experience</label><br>
                    <input type="text" name="age" id="age" autocomplete="off" required>
                    <label for="age" class="age">Dr. Age</label><br>
                    <input type="text" name="gender" id="gender" autocomplete="off" required>
                    <label for="gender" class="gender">Dr. Gender</label><br>
                    <button type="submit">Add</button>
                </form>
            </section>
    </main>
</body>
</html>