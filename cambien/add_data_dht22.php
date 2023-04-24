<?php
    // Connect to MySQL
    include("config/config.php");
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date("Y-m-d G:i:s");
    // Prepare the SQL statement
    $SQL = "INSERT INTO dht22 (sensor_id, datetime, temperature, humidity) VALUES ('".$_GET["sensorid"]."', '$date', '".$_GET["temp"]."','".$_GET["hum"]."')";
    mysqli_query($connect, $SQL);
    // Execute SQL statement
    $result = $connect->query("SELECT * FROM user u, room_detail r, dht22list l WHERE u.userId = r.user_id AND r.room_id = l.room_id AND l.id = '".$_GET["sensorid"]."' AND u.status = '0'");
    $rs_alarm = $connect->query("SELECT alarm_temp_low, alarm_temp_high, alarm_hum_low, alarm_hum_high FROM user u, room_detail r, dht22list l WHERE u.userId = r.user_id AND r.room_id = l.room_id AND l.id = '".$_GET["sensorid"]."' AND u.status = '0'");

    $data1=$rs_alarm->fetch_assoc();
    $alarm = $data1['alarm_temp_low'];
    $alarm2 = $data1['alarm_temp_high'];
    
    $alarma = $data1['alarm_hum_low'];
    $alarmb = $data1['alarm_hum_high'];
    
    if(($_GET["temp"]<$alarm || $_GET["temp"]>$alarm2) && ($_GET["hum"]<$alarma || $_GET["hum"]>$alarmb)){
        
        while($data=$result->fetch_assoc()){
            $email = $data['userEmail'];
            $subject = "WARNING";
            $message = "Cảnh báo! Nhiệt độ phòng ở mức ".$_GET["temp"]."°C. Độ ẩm phòng ở mức ".$_GET["hum"]."%.";
            $sender = "From: shahiprem7890@gmail.com";
            mail($email, $subject, $message, $sender);
            
        }
        $result->data_seek(0);
    }elseif($_GET["temp"]<$alarm || $_GET["temp"]>$alarm2){
        
        while($data=$result->fetch_assoc()){
            $email = $data['userEmail'];
            $subject = "WARNING";
            $message = "Cảnh báo! Nhiệt độ phòng ở mức ".$_GET["temp"]."°C.";
            $sender = "From: shahiprem7890@gmail.com";
            mail($email, $subject, $message, $sender);
            
        }
        $result->data_seek(0);
    }elseif($_GET["hum"]<$alarma || $_GET["hum"]>$alarmb){
        
        while($data=$result->fetch_assoc()){
            $email = $data['userEmail'];
            $subject = "WARNING";
            $message = "Cảnh báo! Độ ẩm phòng ở mức ".$_GET["hum"]."%.";
            $sender = "From: shahiprem7890@gmail.com";
            mail($email, $subject, $message, $sender);
            
        }
        $result->data_seek(0);
    }
?>