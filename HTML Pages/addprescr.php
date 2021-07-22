<?php
    header("Content-Type: application/json; charset=UTF-8");
    require_once('dbconnect.php');
    $obj = json_decode($_POST["dataobj"], false);
    $dr_id = $obj->dr_idkey;
    $pat_id = $obj->pat_idkey;
    $heading = $obj->headkey;
    $subhead = $obj->subheadkey;
    $msg = $obj->msgkey;
    $date = date("Y-m-d");
    $time = date("h:i");
    $prescr_query = "INSERT INTO `prescription`(`dr_id`, `pat_id`, `heading`, `sub_heading`, `message`, `date`, `time`) VALUES (?,?,?,?,?,?,?);";
    $prescr_query_pre = $conn->prepare($prescr_query);
    $prescr_query_pre->bind_param('issssss',$dr_id,$pat_id,$heading,$subhead,$msg,$date,$time);
    if($prescr_query_pre->execute()){
        $status = 'Data Added!!';
        echo json_encode($status);
    }
?>
