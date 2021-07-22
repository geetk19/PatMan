<?php
require_once('../HTML Pages/dbconnect.php');
$prescr = "SELECT * from hospital_dr where dr_id=?";
$obJ = json_decode($_POST["dataObj"], false);
$dr_id = $obJ->dr_idkey;
$username = $obJ->usernamekey;
$prescr_pre = $conn->prepare($prescr);
$prescr_pre->bind_param('i',$dr_id);
$prescr_pre->execute();
$res = $prescr_pre->get_result();
$var='';
while($rows=$res->fetch_assoc()){
    $var .= '<section class="profile" id="'.$dr_id.'">
                <p class="name">Name: Dr.' .$rows["dr_name"].'</p>
                <p class="username">Username: '.$rows["username"].'</p>
                <p class="email">Email Id: '.$rows["email"].'</p>
                <p class="contact">Contact No.: '.$rows["contact_no"].'</p>
                <p class="specialization">Specialization: '.$rows["specialization"].'</p>
                <p class="designation">Designation: '.$rows["designation"].'</p>
                <p class="exp">Experience: '.$rows["exp"].'years</p>
                <p class="age">Age: '.$rows["age"].'year</p>
                <p class="gender">Gender: '.$rows["gender"].'</p>
                <button onclick="edit('.$dr_id.')">Edit</button>
        </section>';
}
echo json_encode($var);
?>