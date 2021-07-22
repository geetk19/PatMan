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
    // else{
    //     // require_once('dbconnect.php');
    // }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient 2</title>
    <!-- <link rel="stylesheet" href="patient_2.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,300;1,600&display=swap");

        @font-face {
        font-family: "Kaushanscript";
        src: url("Fonts/Kaushan_Script/KaushanScript-Regular.ttf");
        }

        * {
        margin: 0;
        padding: 0;
        text-decoration: none;
        list-style: none;
        box-sizing: border-box;
        }

        ::-webkit-scrollbar {
        width: 10px;
        }

        ::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.6);
        }

        ::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.8);
        }

        body {
        overflow-x: hidden;
        /* background-image: linear-gradient(300deg, #10bbce, #42d7e7); */
        height: 100%;
        width: 100%;
        scroll-behavior: smooth;
        }

        nav.navigation {
        top: 0;
        width: 100%;
        display: grid;
        grid-template-columns: 5% 3fr 1fr 1fr;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.8);
        }

        nav.navigation span.logo {
        font-size: 3vw;
        grid-column: 2;
        padding-top: 0vh;
        font-family: "Kaushanscript";
        text-decoration: none;
        color: white;
        user-select: none;
        }

        nav.navigation ul {
        grid-column: 4;
        display: flex;
        flex-direction: row;
        list-style: none;
        text-decoration: none;
        }

        nav.navigation ul li {
        padding-right: 2vw;
        padding-top: 0vh;
        }

        nav.navigation ul li a {
        font-size: 1.1vw;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        /* font-family: "Josefin Sans", sans-serif; */
        color: white;
        user-select: none;
        }

        nav.navigation ul li a::after {
        content: "";
        display: block;
        background: white;
        width: 0px;
        height: 2px;
        transition: all 1s;
        }

        nav.navigation ul li a:hover::after {
        width: 100%;
        background: #009fdf;
        transition: all 1s;
        }

        div.add_pat {
        border: 1.5px solid black;
        border-radius: 10px;
        background-color: white;
        width: 40%;
        padding: 20px;
        position: absolute;
        transition: all 0.5s;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        }

        div.add_pat p.pat_id {
        float: right;
        margin: 0;
        font-size: 1.2rem;
        font-family: "Josefin Sans", sans-serif;
        font-weight: 600;
        }

        div.add_pat img {
        position: absolute;
        top: 25%;
        left: 65%;
        }

        div.add_pat form {
        margin: 40px 0 0 0;
        }

        div.add_pat form input {
        border: none;
        border-bottom: 2px solid black;
        margin-bottom: 30px;
        outline: none;
        }

        div.add_pat form textarea#issue {
        width: 60%;
        resize: none;
        border: none;
        border-bottom: 2px solid black;
        outline: none;
        }

        div.add_pat form textarea#issue::-webkit-scrollbar {
        display: none;
        }

        div.add_pat form label.heading,
        div.add_pat form label.sub-head,
        div.add_pat form label.issue {
        position: absolute;
        left: 20px;
        transition: all 0.5s;
        }

        div.add_pat form input#sub-head {
        width: 40%;
        }

        div.add_pat form input#heading:focus ~ label.heading,
        div.add_pat form input#heading:valid ~ label.heading,
        div.add_pat form input#sub-head:focus ~ label.sub-head,
        div.add_pat form input#sub-head:valid ~ label.sub-head,
        div.add_pat form textarea#issue:focus ~ label.issue,
        div.add_pat form textarea#issue:valid ~ label.issue {
        transform: translateY(-100%);
        font-size: 16px;
        color: rgb(65, 65, 228);
        transition: all 0.5s;
        }

        div.add_pat form button {
        margin: 15px 10px 0 0;
        padding: 5px;
        width: 60px;
        border-radius: 5px;
        outline: none;
        }

        .disp_block {
        transform: scale(1);
        opacity: 1;
        }

        .disp_none {
        transform: scale(0);
        opacity: 0;
        }

        main {
        margin: 1% 5%;
        }
        main section.pat_head {
        float: left;
        user-select: none;
        }

        main section.pat_head p.pat_name {
        font-size: 3vw;
        font-family: "Josefin Sans", sans-serif;
        font-weight: 700;
        }

        main section.pat_head p.pat_id {
        font-size: 1.5vw;
        font-family: "Kaushanscript", sans-serif;
        font-weight: 500;
        }

        main section.pat_head p.doc_name {
        font-size: 1.5vw;
        font-family: "Kaushanscript", sans-serif;
        font-weight: 500;
        }

        main section.pat_head p.doc_name::after{
            content: "";
            display: block;
            background-color: #009fdf;
            width: 20%;
            height: 2px;
        }

        hr {
        margin: 1vw 2vw;
        font-weight: 600;
        opacity: 0.65;
        clear: both;
        }

        main div.prescription_list {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: auto;
        grid-gap: 20px;
        }

        main div.prescription_list section.empty {
        grid-column: 1;
        grid-row: 2;
        margin: auto;
        user-select: none;
        }

        main div.prescription_list section.empty img {
        opacity: 0.5;
        }

        main div.prescription_list section.empty p.context {
        font-size: 1.5vw;
        font-weight: 510;
        font-family: "Josefin Sans", sans-serif;
        }

        main div.prescription_list section.presc_box {
        position: relative;
        margin: auto;
        padding: 15px;
        font-family: "Josefin Sans", sans-serif;
        border: 1px solid black;
        border-radius: 10px;
        width: 60%;
        cursor: pointer;
        user-select: none;
        transition: all 0.5s;
        background-color: white;
        }
        main div.prescription_list section.presc_box div.inner {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        border-radius: 10px;
        background: #0099ff;
        clip-path: circle(5% at 0% 0%);
        transition: all 0.5s ease-in-out;
        z-index: 0;
        }

        main div.prescription_list section.presc_box p.heading {
        font-size: 2vw;
        font-weight: 501;
        }

        main div.prescription_list section.presc_box p.sub_head {
        font-size: 1.5vw;
        font-family: "Josefin Sans", sans-serif;
        margin: 1vh 0 1vh 0;
        }

        main div.prescription_list section.presc_box:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        transition: all 0.5s;
        transform: scale(1.05, 1.05);
        color:white;
        }
        main div.prescription_list section.presc_box:hover div.inner {
        clip-path: circle(100%);
        z-index: -1;
        transition: all 0.5s;
        }
        main div.prescription_list section.presc_box p.date {
        float: right;
        font-size: 1.1vw;
        }

        main svg.down {
        position: fixed;
        z-index: -2;
        left: 0;
        right: 0;
        top: auto;
        bottom: 0;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navigation">
            <span class="logo">PATMAN</span>
            <ul>
               
                <li>
                    <a href="../Profile Section/profile_patient.php"><?php echo $username;?></a>
                </li>
                <li>
                    <a href="../HTML Pages/patient_1.php">Home</a>
                </li>
                <!--<li>
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
        <?php
        $sql="SELECT pat_name from patient where pat_id='$username'";
        $result=mysqli_query($con,$sql);
        $num=mysqli_num_rows($result);
        while($row=mysqli_fetch_assoc($result)):?>
        <section class="pat_head">
            <p class="pat_name"><?php echo $row['pat_name'];?></p>
            <p class="pat_id"><?php echo "ID: " .$username;?></p>
            <p class="doc_name"><?php echo "Dr. ".$_GET['doctor'];?></p><br>
        </section><?php endwhile;?>
        <hr>
        <div class="prescription_list">
            <!-- <section class="empty">
                <img src="Assets/empty-white-box.png" alt="empty" height="150px" width="150px">
                <p class="context">Record is empty.</p>
            </section> -->
            <?php 
            $doctor=$_GET['doctor'];
            $sqls="SELECT * from prescription where pat_id='$username' and dr_id=(SELECT dr_id from hospital_dr where dr_name='$doctor')";
            $results=mysqli_query($con,$sqls);
            $nums=mysqli_num_rows($results);
            if($nums!=0):

            while($rows=mysqli_fetch_assoc($results)):
            ?>
            <section class="presc_box">
                <div class="inner"></div>
                <p class="date"><?php echo $rows['date'];?> <span class="time"><?php echo $rows['time'];?></span></p>
                <p class="heading"><?php echo $rows['heading'];?></p>
                <p class="sub_head"><?php echo $rows['sub_heading'];?></p>
                <p class="presc"><?php echo $rows['message'];?></p>
            </section>
            <?php endwhile;
            endif;
            ?>
        </div>
    </main>
</body>
<script>
    document.body.onload = function (e) {
        var form = document.getElementById("pop_up");
        form.classList.add('disp_none');
        form.classList.remove('disp_block');
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
    function add() {
        var form = document.getElementById("pop_up");
        form.style.display = "block";
        setTimeout(work, 100);
        function work() {
            form.classList.add('disp_none');
            form.classList.remove('disp_block');
            document.querySelector("main").style.display = "block";
        }
    }

    // var openFull = document.getElementsByClassName("presc_box");
    // for(i=0;i<openFull.length;i++){
    //     openFull[i].onclick = function (e) {
    //         console.log("hello");
    //         openFull[i].classList.add("fullscreen");
    //     }
    // }
</script>
</html>