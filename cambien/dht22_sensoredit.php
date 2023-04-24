<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/dht22.php' ?>
<?php
    $sensor = new dht22();
    if(!isset($_GET['id']) || $_GET['id']==NULL){
       echo "<script>window.location ='dht22_sensorlist.php'</script>";
    }else{
         $id = $_GET['id']; 
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updatesensor = $sensor->update_dht22sensor($_POST,$_FILES, $id);
    }   
?>
<div class="container-fluid">
    <div class="box">
        <h2>Sửa</h2>
        <div >    
         <?php

                if(isset($updatesensor)){
                    echo $updatesensor;
                }

            ?>        
        <?php
         $get_sensor_by_id = $sensor->getdht22sensorbyId($id);
            if($get_sensor_by_id){
                while($result_sensor = $get_sensor_by_id->fetch_assoc()){
        ?>     
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">   
                <tr>
                    <td style="width:300px">
                        <label>ID cảm biến</label>
                    </td>
                    <td>
                        <input type="text"  name="id" value="<?php echo  $result_sensor['id']?>" class="mini" readonly/>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Phòng</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result_sensor['room_id'] ?>" name="room_id" class="mini" readonly/>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Nhiệt độ cảnh báo (°C)</label>
                    </td>
                    <td>
                        Dưới (<) <input type="number" value="<?php echo $result_sensor['alarm_temp_low'] ?>" name="alarm_temp_low" style="width: 60px"/>°C &emsp;
                        Trên (>) <input type="number" value="<?php echo $result_sensor['alarm_temp_high'] ?>" name="alarm_temp_high" style="width: 60px"/>°C
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Độ ẩm cảnh báo (%)</label>
                    </td>
                    <td>
                        Dưới (<) <input type="number" value="<?php echo $result_sensor['alarm_hum_low'] ?>" name="alarm_hum_low" style="width: 60px"/>% &emsp;
                        Trên (>) <input type="number" value="<?php echo $result_sensor['alarm_hum_high'] ?>" name="alarm_hum_high" style="width: 60px"/>%
                    </td>
                </tr>

                <tr>
                    <td>
                        <input class = "btn btn-blue" type="submit" name="submit" value="Cập nhật" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
            }

        }
            ?>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'?>