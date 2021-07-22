<?php
session_start();
session_unset();
session_destroy();
?>
<?php
    include '../partial/_dbcon.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['message'])){
        $name=$_POST['name'];
        $email=$_POST['mail'];
        $msgs=$_POST['message'];
        // echo"$name,$email,$msgs";
        $sqlt="INSERT INTO `feedback`(`name`, `email`, `message`) VALUES (?,?,?)";
        $qry=mysqli_prepare($con, $sqlt);
        mysqli_stmt_bind_param($qry,'sss',$name,$email,$msgs);
        mysqli_stmt_execute($qry);

    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="styleco.css">
</head>
<body>
    <?php require '../partial/nav.php';?>
    <section class="contact">
        <div class="content">
            <h2>Contact Us</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi provident omnis obcaecati illo voluptate sit,
             natus corporis. Fuga quibusdam totam asperiores facilis iste, suscipit aspernatur accusamus provident nesciunt.</p>
        </div>
        <div class="container">
            <div class="contactInfo">
                <div class="box">
                <a href="./map.html" target="_blank" rel="noopener noreferrer">
                    <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                </a>
                    <div class="text">
                        <h3>Address</h3>
                        <p>Dr. K. M. Vasudevan Pillai Campus,<br> Plot No. 10, Sector 16, New Panvel East,<br> Navi Mumbai, Maharashtra 410206</p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Phone</h3>
                        <p>022 - 2748 2400 </p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                    <div class="text">
                        <h3>Email</h3>
                        <p>asdfgh@mes.ac.in</p>
                    </div>
                </div>
            </div>
            <div class="contactForm">
                <form action="" method="post">
                    <h2>Contact</h2>
                    <div class="inputBox">
                        <input type="text" minlength="3" maxlength="50" name="name" required>
                        <span>Full Name</span>
                    </div>
                    <div class="inputBox">
                        <input type="email" minlength="8" maxlength="50" name="mail" required>
                        <span>Email</span>
                    </div>

                    <div class="inputBox">
                        <textarea  maxlength="250" name="message" id="" cols="30" rows="5" required></textarea>
                        <span>Message...</span>
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <p class="foot">© Copyright 2020</p>
</body>
</html>