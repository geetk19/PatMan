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
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['name'])){
            $did=$_GET['did'];
            $name=$_POST['name'];
            $age=$_POST['age'];
            $gender=$_POST['gender'];
            $sp=$_POST['sp'];
            $cont=$_POST['cont'];
            $em=$_POST['email'];
            $des=$_POST['desg'];
            $exp=$_POST['exp'];
            $sqli="UPDATE `hospital_dr` SET `dr_name`='$name',`age`='$age',`gender`='$gender',`specialization`='$sp',`contact_no`='$cont',`email`='$em',`exp`='$exp',`designation`='$des' WHERE dr_id='$did'";
            mysqli_query($con,$sqli);
            header("Location: admin_doctor.php");
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link rel="stylesheet" href="profile_doctor.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="jQuery.js">
    
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
        <div class="container">
            <div class="leftbox">
                <nav>
                    <a href="#" onclick="tabs(0)" class="tab" active>
                        <i class="fa fa-user-o" ></i>
                    </a>
                    <a href="#" onclick="tabs(1)" class="tab">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>

                
                    </a>
                    <a href="#" onclick="tabs(2)" class="tab">
                        <i class="fa fa-hospital-o" aria-hidden="true"></i>

                    </a>
                    
                </nav>
            </div>
            <div class="rightbox">

                    <?php 
                    // $username=$_SESSION['username'];
                    // $sql="SELECT * FROM hospital_dr where username='$username'";
                    if(isset($_GET['did'])){
                    $did=$_GET['did'];
                
                    $sql="SELECT * FROM hospital,hospital_dr where hospital.hospital_id=hospital_dr.hospital_id AND hospital_dr.dr_id='$did'";
                    $result=mysqli_query($con,$sql);
                    $num = mysqli_num_rows($result);
                    // echo $num.mysqli_fetch_assoc($result);
                if($num==1){
                    while($row=mysqli_fetch_assoc($result)){
                        echo '<form name="docp" method="post">
                        <div class="tabShow"><br>
                        <h1>Personal Information</h1><br>
                        <h2>Name</h2>
                        <input type="text" name="name" class="input" value="'.$row['dr_name'].'" required><br><br>
                        <h2>Gender</h2>
                        <input type="text" name="gender" class="input" value="'.$row['gender'].'" required><br><br>
                        <h2>Contact Number</h2>
                        <input type="text" name="cont" class="input" value="'.$row['contact_no'].'" required><br><br>
                        <h2>Email ID</h2>
                        <input type="text" name="email" class="input" value="'.$row['email'].'" required><br><br>
                        <!-- <button  type="submit"  class="btn" >Edit <i class="fa fa-pencil" aria-hidden="true"></i></button>-->
                        </div> 
                        ';
                        echo'<div class="tabShow" style="display:none;"><br>
                        <h1>Other Details</h1><br>
                        <h2>Age</h2>
                        <input type="text" name="age" class="input" value="'.$row['age'].'" required><br><br>
                        <h2>Specialization</h2>
                        <input type="text" name="sp" class="input" value="'.$row['specialization'].'" required><br><br>
                        <h2>Designation</h2>
                        <input type="text" name="desg" class="input" value="'.$row['designation'].'" required><br><br>
                        <button  type="submit"  class="btn" >Edit <i class="fa fa-pencil" aria-hidden="true"></i></button>
                        </div>';
                    echo'<div class="tabShow" style="display:none;"><br>
                    <h1>Hospital Details</h1><br>
                    <h2>Hospital Name</h2>
                    <input type="text" name="hosname" class="input" value="'.$row['hospital_name'].'" disabled><br><br>
                    <h2>Doctor Experience</h2>
                    <input type="text" name="exp" class="input" value="'.$row['exp'].'" required><br><br>
                    <h2>Hospital Address</h2>
                    <input type="text" name="address" class="input" value="'.$row['address'].'" disabled><br><br>
                    <h2>Pincode</h2>
                    <input type="text" name="pincode" class="input" value="'.$row['pincode'].'" disabled><br><br>
                    <button  type="submit"  class="btn" >Edit <i class="fa fa-pencil" aria-hidden="true"></i></button>
                </div></form>';
                    }
                }
            }

            ?>
            </div>
        </div>

        <script src="jQuery.js"></script>
        <script>
            const tabBtn= document.querySelectorAll(".tab");
            const tab= document.querySelectorAll(".tabShow");

            function tabs(panelIndex) {
                tab.forEach(x=>x.style.display="none");
                debugger;
                tab[panelIndex].style.display = "block";
            }
            //tabs(0);

        </script>
        <script>
            $(".tab").click(function(){
                $(this).addClass("active").siblings().removeClass("active");
            })
         </script>
         <script>

            document.forms("docp").onsubmit=function(e){

                alert("Updated Successfully");
        };

         </script>


</body>
</html>
