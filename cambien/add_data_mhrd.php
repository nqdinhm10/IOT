<?php
    // Connect to MySQL
    include("config/config.php");
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date("Y-m-d G:i:s");
    // Prepare the SQL statement

    $SQL = "INSERT INTO mhrd (sensor_id, datetime, quality) VALUES ('".$_GET["sensorid"]."', '$date', '".$_GET["quality"]."')";
    // Execute SQL statement
    $result = $connect->query("SELECT * FROM user u, room_detail r, mhrdlist l WHERE u.userId = r.user_id AND r.room_id = l.room_id AND l.id = '".$_GET["sensorid"]."' AND u.status = '0'");
    
    mysqli_query($connect, $SQL);

    if($_GET["quality"] == 2){
        
        while($data=$result->fetch_assoc()){
            $email = $data['userEmail'];
            $subject = "WARNING";
            $message = "Cảnh báo! Rò rỉ nước.";
            $sender = "From: shahiprem7890@gmail.com";
            mail($email, $subject, $message, $sender);
            
        }
        $result->data_seek(0);
    }
?>