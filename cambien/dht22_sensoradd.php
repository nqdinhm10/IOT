<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/dht22.php'?>
<?php include 'classes/room.php'?>
<?php
    $sensor = new dht22();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $insertsensor = $sensor->insert_dht22sensor($_POST,$_FILES);
        
    }
?>
<div class="container-fluid">
    <div class="box">
        <h2>Thêm cảm biến DHT22</h2>
        <div class="block">    
         <?php
                if(isset($insertsensor)){
                    echo $insertsensor;
                }
            ?>             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>ID cảm biến</label>
                    </td>
                    <td>
                        <input type="text" name="id" placeholder="Nhập ID..." class="medium" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Phòng</label>
                    </td>
                    <td>
                        <select id="select" name="room">
                            <option>---Chọn---</option>
                            <?php
                            $room = new room();
                            $roomlist = $room->show_roomad();

                            if($roomlist){
                                while($result = $roomlist->fetch_assoc()){
                             ?>

                            <option value="<?php echo $result['id'] ?>"><?php echo $result['name'] ?></option>

                               <?php
                                  }
                              }
                           ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Nhiệt độ cảnh báo (°C)</label>
                    </td>
                    <td>
                        Dưới (<) <input type="number" name="alarm_temp_low" style="width: 60px"/>°C &emsp;
                        Trên (>) <input type="number" name="alarm_temp_high" style="width: 60px"/>°C
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Độ ẩm cảnh báo (%)</label>
                    </td>
                    <td>
                        Dưới (<) <input type="number" name="alarm_hum_low" style="width: 60px"/>% &emsp;
                        Trên (>) <input type="number" name="alarm_hum_high" style="width: 60px"/>%
                    </td>
                </tr>
                
				<tr>
                    <td></td>
                    <td>
                        <input class = "btn btn-blue" class = "btn btn-blue" type="submit" name="submit" Value="Thêm" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'?>