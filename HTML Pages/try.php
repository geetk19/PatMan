<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>    <?php
if(isset($_POST['phone'])){
    $msg='Hiii';
    $phone=$_POST['phone'];
    send_sms($msg,$phone);
}
function send_sms($ph,$sms){

   

    $fields = array(
        "sender_id" => "FSTSMS",
        "message" => $sms,
        "language" => "english",
        "route" => "p",
        "numbers" => $ph,
    );
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($fields),
      CURLOPT_HTTPHEADER => array(
        "authorization: Uvc5TO0fPgK3t1qAr9b2w4JRQokWleVINDMuYEmdsCXBxhjZL63Bidp6ObyTqgXWUZ8FutkSzV7Cs2YL",
        "accept: */*",
        "cache-control: no-cache",
        "content-type: application/json"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }



}          
?>
    <form action="try.php" method="post">
    <input type="text" placeholder="Phone" name="phone">

    <input type="submit">
 
    </form>
</body>
</html>