<?php
$existSql=false;
$showAlert1 = false;
$showError1 = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '../partial/_dbcon.php';

    $name=$_POST['drname'];
    $address=$_POST['address'];
    $cn=$_POST['ClinicName'];
    $eid=$_POST['EmailId'];
    $phno=$_POST['Cont'];
    $_SESSION['ph']=$phno;
    $uid=$_POST['username'];
    $password=$_POST['password'];

    $num=0;
    $existSql = "SELECT * FROM `hospital` WHERE hospital_name = '$cn';";
    $result = mysqli_query($con, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        
    }
    else{
        // $exists = false;

        $sqlt="INSERT INTO `hospital` (`hospital_name`,`address`) VALUES (?,?);";
        // mysqli_query($con, $sqlt);
        $qry=mysqli_prepare($con, $sqlt);
        mysqli_stmt_bind_param($qry, 'ss',$cn,$address);
        mysqli_stmt_execute($qry);
        sleep(2);
        }
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
                $fetch1="SELECT hospital_id from `hospital` WHERE hospital_name = '$cn';";
                $hi=mysqli_query($con,$fetch1);
                while($row=mysqli_fetch_assoc($hi)){
                    $hid=$row['hospital_id'];
                }
                $gender=$_POST['gender'];
                $sp=$_POST['sp'];
                $sql="INSERT INTO `hospital_dr` (`dr_name`,`gender`,`specialization`,`password`,`hospital_id`,`username`, `email`, `contact_no`) VALUES ('$name','$gender','$sp','$hash',$hid,'$uid', '$eid', '$phno');";
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
    <title>Registration page</title>
    <link rel="stylesheet" href="./regstyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans:wght@700&display=swap" rel="stylesheet">
</head>
<body>
<?php
    require '../partial/nav.php';
    if($showAlert1){
    // echo '<script>alert("Your account has successfully created")</script>';
    header('Location: ../doctorlogin.php?ac=truedd' );
    }
    if($showError1){
        echo "<script>alert('$showError1')</script>";
    }
    ?>
    <div id="home">
    <form action="registration_page.php" class="bd" name="myform" method="post">
        <h1 style="margin-top:20px;">Register as Clinic Dr</h1>

        <div class="form" style="overflow:hidden;">
            <input type="text" id="drname" name="drname" onblur="validatename()" autocomplete="off" required />
            <label for="drname" class="label-name">
                <span class="content-name">Dr.Name</span><br><p id="drname1"></p>
            </label>

        </div>

        <div class="form" style="overflow:hidden;">
            <input type="text" name="ClinicName" autocomplete="off" required />
            <label for="ClinicName" class="label-name">
                <span class="content-name">Clinic Name</span>
            </label>
        </div>
        <div class="form" style="overflow:hidden;">
            <input type="text" name="address" autocomplete="off" required />
            <label for="pincode" class="label-name">
                <span class="content-name">Address</span>
            </label>
        </div>
        <div class="form"style="overflow:hidden;">
            <input type="text" id="email" onblur="emailalert()" name="EmailId" autocomplete="off" required />
            <label for="EmailId" class="label-name">
                <span class="content-name">EmailId</span><br><p id="al"></p>
            </label>
            <!-- <p id="al"></p> -->
        </div>
        <div class="form" style="overflow:hidden;">
            <input type="text" maxlength="10" name="Cont" autocomplete="off" required />
            <label for="Cont" class="label-name">
                <span class="content-name">Contact No.</span>
            </label>
        </div>
        <div class="form" style="overflow:hidden;">
            <input type="text" name="gender" autocomplete="off" required />
            <label for="gender" class="label-name">
                <span class="content-name">Gender</span>
            </label>
        </div>
        <div class="form" style="overflow:hidden;">
            <input type="text" name="sp" autocomplete="off" required />
            <label for="sp" class="label-name">
                <span class="content-name">Specialization</span>
            </label>
        </div>
        
        <div class="form" style="overflow:hidden;">
            <input type="text" name="username" maxlength="8" autocomplete="off" required />
            <label for="username" class="label-name">
                <span class="content-name">Create Username</span>
            </label>
        </div>
        <div class="form" style="overflow:hidden;">
            <input type="password"  id="ps" onblur="checkpassword()" name="password" autocomplete="off" required />
            <label for="password" class="label-name">
                <span class="content-name">Create Password</span><p id="ps1"></p>
            </label>
        </div>
        <!-- <div class="form">
            <input type="text" minlength="8" maxlength="16" name="cpassword1" autocomplete="off" required />
            <label for="cpassword1" class="label-name">
                <span class="content-name">Confirm Password</span>
            </label>
        </div> -->
        <div class="form">
                <button class="btn" name="Submit" id="" value="Validate" onclick="validateform();">Submit</button>
        </div>

    </form>
    </div>
    <script>

        function emailalert(){
    var emailval = document.getElementById("email").value;
    var at = emailval.indexOf("@");
    var dot = emailval.lastIndexOf(".");
    var len = emailval.length;
    if(at<1 || dot<1 || (emailval.slice(at+1,dot) != "gmail" && emailval.slice(at+1,dot) != "yahoo") || emailval.slice(dot+1,len) != "com"){
        document.getElementById("al").innerHTML = "Inavlid Email.";
    }
    else{
      document.getElementById("al").innerHTML = "";
    }
  }
  function validatename(){
    var a = document.getElementById("drname").value;
    if(a=="")
    {
    document.getElementById("drname1").innerHTML = "Please Enter Your Name.";
    }
    if(!isNaN(a))
    {
    document.getElementById("drname1").innerHTML = "Please Enter Only Characters.";
    }
    else{
        document.getElementById("drname1").innerHTML = "";
    }
}

    function checkpassword(){

    var str=document.getElementById("ps").value;
    //check required fields
    //password should be minimum 4 chars but not greater than 8
    if ((str.length < 8) || (str.length > 18)) {

        document.getElementById("ps1").innerHTML = "Password should be minimum 8 chars";

    //check required fields

    //password should be minimum 4 chars but not greater than 8

    }
    else{
        document.getElementById("ps1").innerHTML = "";
    }

}


    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>