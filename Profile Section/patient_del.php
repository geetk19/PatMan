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
if(isset($username)){
    $sqli="DELETE from patient where pat_id='$username'";
    mysqli_query($con,$sqli);
    header('location: ../patientlogin.php');
}


?>