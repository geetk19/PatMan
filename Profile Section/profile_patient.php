<?php
include '../partial/_dbcon.php';
session_start();
$username=$_SESSION['username'];
$password=$_SESSION['password'];
$passwords=md5($password);
 $sql="SELECT * FROM `patient` where pat_id='$username' and `pat_password`='$passwords'";
 $result=mysqli_query($con,$sql);
$num = mysqli_num_rows($result);

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true || $num==0){
header('location: ../patientlogin.php');
  exit;
 }
 if($_SERVER["REQUEST_METHOD"] == "POST"){
     $name=$_POST['name'];
     $id=$_POST['id'];
     $contact=$_POST['contact'];
     $email=$_POST['email'];
     $gender=$_POST['gender'];
     $bloodgrp=$_POST['bloodgrp'];
     $age=$_POST['age'];
     $sqlu="UPDATE patient SET  pat_name='$name' , pat_contact='$contact', pat_email ='$email' , pat_gender='$gender' , bood_group='$bloodgrp' , age='$age' where pat_id='$username'";
     mysqli_query($con,$sqlu);
     sleep(1);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
    <link rel="stylesheet" href="profile_patient.css">
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
                    <a href="../HTML Pages/patient_1.php">Home</a>
                </li>
                <li>
                    <a href="./patient_del.php" onclick="return confirm('Are you sure you want to delete your account?');">Delete</a>
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

                </nav>
            </div>
            <div class="rightbox">
            <?php 
                    // $username=$_SESSION['username'];

                    $sql="SELECT * FROM patient where pat_id='$username'";
                    $result=mysqli_query($con,$sql);
                    $num = mysqli_num_rows($result);
                    // echo $num.mysqli_fetch_assoc($result);
                if($num==1){
                    while($row=mysqli_fetch_assoc($result)){
                        echo'<form action="profile_patient.php" class="bd" name="myform" method="post">
                <div class="tabShow"><br>
                    <h1>Personal Information</h1><br>
                    <h2>Name</h2>
                    <input type="text" name="name" class="input" value="'.$row['pat_name'].'"><br><br>
                    <h2>Patient ID</h2>
                    <input type="text" name="id" class="input" value="'.$row['pat_id'].'"><br><br>
                    <h2>Contact Number</h2>
                    <input type="text"name="contact" class="input" value="'.$row['pat_contact'].'"><br><br>
                    <h2>Email ID</h2>
                    <input type="text" name="email" class="input" value="'.$row['pat_email'].'"><br><br>
                    <button class="btn" >Edit <i class="fa fa-pencil" aria-hidden="true"></i></button>
                </div>
                <div class="tabShow" style="display:none;"><br>
                    <h1>Other Details</h1><br>
                    <h2>Gender</h2>
                    <input type="text" class="input" name="gender" value="'.$row['pat_gender'].'"><br><br>
                    <h2>Blood Group</h2>
                    <input type="text" class="input" name="bloodgrp" value="'.$row['bood_group'].'"><br><br>
                    <h2>Age</h2>
                    <input type="text" class="input" name="age" value="'.$row['age'].'"><br><br>
                    <button type="submit" class="btn" >Edit <i class="fa fa-pencil" aria-hidden="true"></i></button>
                </div>
                </form>
                ';

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


</body>
</html>
