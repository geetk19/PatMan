<?php
require './partial/nav2.php';
?>
<?php
$login=false;
$showerror=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include './partial/_dbcon.php';

    $username=$_POST['username'];
    $passwords=$_POST['password1'];
    $password=md5($passwords);
    $mail=$_POST['mail'];
    // and password='$password'"
    $sql="SELECT * from hospital_dr where username='$username' and email='$mail'";
    $result=mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);
    
    if($num==1){
        $sqlu="UPDATE hospital_dr SET `password`='$password' where username='$username'";
        mysqli_query($con,$sqlu);
        // $showerror=false;
        $login=true;

    }
else{
    $sql="SELECT * from patient where pat_id='$username' and pat_email='$mail'";
    $result=mysqli_query($con,$sql);
    $num = mysqli_num_rows($result);
    if($num==1){
        $sqlu="UPDATE patient SET `pat_password`='$password' where pat_id='$username'";
        mysqli_query($con,$sqlu);
        // $showerror=false;
        $login=true;
        }
        else{
            $showerror=true;
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
	<title>Patient Login</title>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<!-- <header>
        <a class="logo" href="/">PATMAN</a>
            <nav>
                <ul class="nav__links">
                    <li><a href="#"><i class="fa fa-info-circle"style=" margin: 0 5px;"></i>About</a></li>
                    <li><a href="#"><i class="fa fa-phone"style=" margin: 0 5px;"></i>Contact</a></li>
                    <li><a href="#"><i class="fa fa-user-plus"style=" margin: 0 5px;"></i>Register</a></li>
                    <li><a href="#"><i class="fa fa-user"style=" margin: 0 5px;"></i>Admin</a></li>
                </ul>
            </nav>
        <p class="menu cta">Menu</p>
        </header> -->
        <?php
        if($showerror){
            echo '<script>alert("Invalid Crdentials!")</script>';
        }
        if($login){
            echo '<script>alert("You`ve successfully changed password!")</script>';
        }
    ?>
        <!-- <div id="mobile__menu" class="overlay">
            <a class="close">&times;</a>
            <div class="overlay__content">
                <a href="#"><i class="fa fa-info-circle"style=" margin: 0 5px;"></i>About</a>
                <a href="#"><i class="fa fa-phone"style=" margin: 0 5px;"></i>Contact</a>
                <a href="#"><i class="fa fa-user-plus"style=" margin: 0 5px;"></i>Register</a>
                <a href="#"><i class="fa fa-user"style=" margin: 0 5px;"></i>Admin</a>
            </div>
        </div> -->
		<div class="center">
			<h1>Change Password</h1>
			<!-- <h5>As Patient</h5> -->
			<form method="post">
				<div class="txt_field">
					<input name="username" type="text" autocomplete="off" required>
					<span></span>
					<label>Id</label>
				</div>
				<div class="txt_field">
					<input type="email" name="mail" autocomplete="off" required>
					<span></span>
					<label>Email ID</label>
				</div>
				<div class="txt_field">
					<input type="password" minlength="8" maxlength="10" name="password1" required>
					<span></span>
					<label>New Password</label>
				</div>
				<input type="submit" value="reset">

			</form>
		</div>
		<!-- <script type="text/javascript" src="js/mobile.js"></script> -->
</body>
</html>