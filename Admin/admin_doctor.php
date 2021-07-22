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
    else{
        require_once('../HTML Pages/dbconnect.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor List</title>
    <link rel="stylesheet" href="admin_doctor.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <header>
        <nav class="navigation">
            <span class="logo">PATMAN</span>
            <ul>
                <li>
                    <a href="#"><?php echo $username; ?></a>
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
        <section class="dr_list">
            <section class="note">
                <p class="list">Doctors List</p>
            </section>
            <?php 
                $sql = "SELECT hospital_dr.dr_id,hospital_dr.dr_name,hospital_dr.contact_no FROM hospital_dr WHERE hospital_dr.hospital_id=(SELECT hospital_id FROM admin WHERE admin_username=?)";
                $sql_pre = $conn->prepare($sql);
                $sql_pre->bind_param('s',$username);
                $sql_pre->execute();
                $sql_get = $sql_pre->get_result();
                while($row=$sql_get->fetch_assoc()):
            ?>
            <section class="dr_row" id="<?php echo $row['dr_id']; ?>" onclick="fetch(this.id)">
                    <div class="inner"></div>
                    <p class="dr_name"><?php echo 'Dr. '.$row['dr_name'];  ?></p>
                    <span class="dr_contact"><?php echo 'Contact No.: '.$row['contact_no']; ?></p></span>
            </section> 
                <?php endwhile; ?>
        </section>
    </main>
    <aside>
        <div class="outer"></div>
    </aside>
</body>
<script>
    function edit(id){

        window.location.href = "./editprof.php?did="+id;
    }
    function fetch(id){
        var username = "<?php echo $username; ?>";
        var dr_id = id;
        // alert(iid);
        var obJ = {usernamekey:username,dr_idkey:dr_id};
        var dataObj = JSON.stringify(obJ);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data=JSON.parse(this.responseText);
                document.getElementsByClassName("outer")[0].innerHTML = data;   
            }
        };
        xhttp.open("POST", "fetchdoc.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("dataObj="+dataObj);
    }
</script>
</html>