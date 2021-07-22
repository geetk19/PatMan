<?php
require_once('dbconnect.php');
$prescr = "SELECT `heading`, `sub_heading`, `message`, `date`, `time` FROM `prescription` WHERE dr_id=? AND pat_id=?";
$obJ = json_decode($_POST["dataObj"], false);
$dr_id = $obJ->dr_idkey;
$pat_id = $obJ->pat_idkey;
$prescr_pre = $conn->prepare($prescr);
$prescr_pre->bind_param('is',$dr_id,$pat_id);
$prescr_pre->execute();
$res = $prescr_pre->get_result();
$var='';
while($rows=$res->fetch_assoc()){
    $var .= '<section class="presc_box">
    <div class="inner"></div>
    <p class="date">'.$rows["date"].'<span class="time">  ['.$rows["time"].']</span></p>
    <p class="heading">'.$rows["heading"].'</p>
    <p class="sub_head">'.$rows["sub_heading"].'</p>
    <p class="presc">'.$rows["message"].'</p>
    </section>';
}
echo json_encode($var);
?>