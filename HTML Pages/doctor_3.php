<?php
    require_once('../partial/_dbcon.php');
    session_start();
    $username= $_SESSION['username'];
    $password=$_SESSION['password'];
    $passwords=md5($password);
    $sql="SELECT * FROM `hospital_dr` where username='$username' and `password`='$passwords'";
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
    <title>Doctor 3</title>
    <link rel="stylesheet" href="doctor_3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
                    <a href="../HTML Pages/doctorhomepage.php">Home</a>
                </li>
                <!-- <li>
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
        <?php 
            $patient_query = "SELECT pat_name,pat_gender from patient where pat_id=?";
            $patient_query_pre = $conn->prepare($patient_query);
            $patient_query_pre->bind_param('s',$_GET['patid']);
            $patient_query_pre->execute();
            $pat_name = $patient_query_pre->get_result();
            while($name = $pat_name->fetch_assoc()):
                $gender=$name['pat_gender'];
        ?>
        <section class="pat_head">
            <p class="pat_name"><?php echo $name['pat_name']; ?></p>
            <p class="pat_id">Patient Id: <?php echo $_GET['patid']; ?></p>
            <?php if($_GET['did']==$dr_id): ?>
            <span class="add_btn">Add Content: </span><button class="add_rec" onclick="addForm()"><i
                    class="material-icons">add_circle_outline</i></button>
            <?php endif; ?>
        </section>
        <?php endwhile; 
                if($_GET['did']!=$dr_id):
        ?>
        <div class="note">
            <!-- <p class="title">Patient details</p> -->
            <!-- <p class="title">Visited doctors</p> -->
            <p class="doc_note"><span class="doc_note_head">Note: </span>You can not add prescription here.</p>
        </div>
        <?php 
            endif;
        ?>
        <hr>
        <div class="prescription_list"></div>
    </main>
    <div class="add_pat" id="pop_up">
        <p class="pat_id">Patient Id: <span><?php echo $_GET['patid']; ?></span></p>
        <form action="" method="post" name="prescr_form">
            <input type="text" id="heading" name="heading" autocomplete="off" required>
            <label for="heading" class="heading">Heading</label><br>
            <input type="text" id="sub-head" name="subhead" autocomplete="off" required>
            <label for="sub-head" class="sub-head">Sub-Heading</label><br>
            <textarea type="text" id="issue" name="msg" autocomplete="off" rows="5" required></textarea>
            <label for="issue" class="issue">Problem</label><br>
            <button type="button" name="add_prescription" onclick="add()">Add</button>
            <button type="button" onclick="remove()">Cancel</button>
        </form>
        <?php if($gender=='male'){
        echo'<img src="Assets/male_user_icon.png" alt="doctor_icon" height="150" width="150">';
        }
        else if($gender=='female'){
            echo'<img src="Assets/female_user_icon.png" alt="doctor_icon" height="150" width="150">';
        }
        else{
            echo'<img src="Assets/user.png" alt="doctor_icon" height="150" width="150">';
        }
        ?>
    </div>
</body>
<script>
    document.body.onload = function (e) {
        fetchPrescr();
        var form = document.getElementById("pop_up");
        form.classList.add('disp_none');
        form.classList.remove('disp_block');
    }

    function addForm() {
        var form = document.getElementById("pop_up");
        form.style.display = "block";
        setTimeout(work,100);
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
        setTimeout(work,300);
        function work() {
            form.style.display = "none";
            document.querySelector("main").style.display = "block";
        }
    }
    function fetchPrescr(){
        var dr_id = "<?php echo $_GET['did']; ?>";
        var pat_id = "<?php echo $_GET['patid']; ?>";
        var obJ = {dr_idkey:dr_id,pat_idkey:pat_id};
        var dataObj = JSON.stringify(obJ);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data=JSON.parse(this.responseText);
                document.getElementsByClassName("prescription_list")[0].innerHTML = data;   
            }
        };
        xhttp.open("POST", "fetchprescr.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("dataObj="+dataObj); 
    }
    function add() {
            var heading = document.getElementById("heading").value;
            var subhead = document.getElementById("sub-head").value;
            var msg = document.getElementById("issue").value;
            if(heading.length==0 || subhead.length==0 || msg.length==0){
                alert("Empty Field");
            }else{
                var dr_id = "<?php echo $_GET['did']; ?>";
                var pat_id = "<?php echo $_GET['patid']; ?>";
                var obj = {headkey:heading,subheadkey:subhead,msgkey:msg,dr_idkey:dr_id,pat_idkey:pat_id};
                var dataobj = JSON.stringify(obj);
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data=JSON.parse(this.responseText);
                        // document.getElementById("").innerHTML = data;
                        console.log(data);
                        if(data=='Data Added!!'){
                            fetchPrescr();
                            var form = document.getElementById("pop_up");
                            form.classList.add('disp_none');
                            form.classList.remove('disp_block');
                            setTimeout(work,300);
                            function work() {
                                form.style.display = "none";
                                document.querySelector("main").style.display = "block";
                            }
                        }
                    }
                };
                xhttp.open("POST", "addprescr.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("dataobj="+dataobj); 
            }
    }

    // var openFull = document.getElementsByClassName("presc_box");
    // for(i=0;i<openFull.length;i++){
    //     openFull[i].onclick = function (e) {
    //         console.log("hello");
    //         openFull[i].classList.add("fullscreen");
    //     }
    // }
    function noticetable(query){
		var obj = {snqry: query};
  		var qryobj = JSON.stringify(obj);
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			 var data=JSON.parse(this.responseText);
			 document.getElementById("noticetab").innerHTML = data;
		     
		    }
		};
		xhttp.open("POST", "searchnotice.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("query="+qryobj); 
		
	}

</script>
</html>