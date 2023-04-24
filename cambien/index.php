<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/room.php'?>
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 font-weight-bold text-info">NHIỆT ĐỘ TIÊU CHUẨN: 19°C - 22°C<br>ĐỘ ẨM TIÊU CHUẨN: 45% - 50% </h1>
    </div>
    <div class="row">
        <?php
            $room = new room();
            if(Session::get('level')==0){
                $show_room = $room->show_roomad();
            }else{
                $show_room = $room->show_room(Session::get('userId'));
            }
            
            if($show_room){
                $i = 0;
                while($result = $show_room->fetch_assoc()){
                    $room = $result['id'];
                    $sqlDht22 = mysqli_query($connect, "SELECT datetime,temperature,humidity FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY a.id DESC LIMIT 0,1");
                    $data=mysqli_fetch_array($sqlDht22);
                    
                    $sqlDht22m = mysqli_query($connect, "SELECT MAX(temperature) as maxt, MIN(temperature) as mint, ROUND(AVG(temperature),2) as avgt, MAX(humidity) as maxh, MIN(humidity) as minh, ROUND(AVG(humidity),2) as avgh FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id AND date(datetime) = CURRENT_DATE");
                    $datam=mysqli_fetch_array($sqlDht22m);
                    
                    $sqlMq135 = mysqli_query($connect, "SELECT datetime,quality FROM mq135 a, mq135list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY a.id DESC LIMIT 0,1");
                    $dataMq135=mysqli_fetch_array($sqlMq135);
                    
                    $sqlMhrd = mysqli_query($connect, "SELECT datetime,quality FROM mhrd a, mhrdlist l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY a.id DESC LIMIT 0,1");
                    $dataMhrd=mysqli_fetch_array($sqlMhrd);
                    $i++;
        ?>
         
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-primary">
                                    PHÒNG <?php echo $result['name'] ?> <i class="fas fa-server" style="float: right"></i></div>
                                <hr>
                                <div class="h6 m-0 font-weight-bold text-info">LẦN ĐO GẦN NHẤT</div>
                                <span class="m-0 font-weight-bold">
                                    NHIỆT ĐỘ</span>
                                <?php
                                    if($data['temperature']<20 || $data['temperature']>22){
                                ?>
                                <span class="h6 m-0 font-weight-bold text-danger" style="float: right"><?php echo $data['temperature'] ?>°C</span>
                                <?php
                                    }else{
                                ?>
                                <span class="h6 m-0 font-weight-bold text-success" style="float: right"><?php echo $data['temperature'] ?>°C</span>
                                <?php
                                    }
                                ?>
                                <br>
                                <span class="m-0 font-weight-bold">
                                    ĐỘ ẨM</span>
                                <?php
                                    if($data['humidity']<45 || $data['humidity']>50){
                                ?>
                                <span class="h6 m-0 font-weight-bold text-danger" style="float: right"><?php echo $data['humidity'] ?>%</span>
                                <?php
                                    }else{
                                ?>
                                <span class="h6 m-0 font-weight-bold text-success" style="float: right"><?php echo $data['humidity'] ?>%</span>
                                <?php
                                    }
                                ?>
                                <br>
                                <span class="m-0 font-weight-bold">
                                      KHÔNG KHÍ</span>
                                  <?php
                                    if($dataMq135['quality']==0){
                                  ?>
                                  
                                  <?php
                                    }elseif($dataMq135['quality']==1){
                                  ?>
                                  <span class="h6 m-0 font-weight-bold text-success" style="float: right"> Tốt</span>
                                  <?php
                                    }else{
                                  ?>
                                  <span class="h6 m-0 font-weight-bold text-danger" style="float: right"> Kém</span>
                                  <?php
                                    }
                                  ?>
                                  <br>
                                <span class="m-0 font-weight-bold">
                                      RÒ RỈ NƯỚC</span>
                                  <?php
                                    if($dataMhrd['quality']==0){
                                  ?>
                                  
                                  <?php
                                    }elseif($dataMhrd['quality']==1){
                                  ?>
                                  <span class="h6 m-0 font-weight-bold text-success" style="float: right"> Tốt</span>
                                  <?php
                                    }else{
                                  ?>
                                  <span class="h6 m-0 font-weight-bold text-danger" style="float: right"> Rò rỉ</span>
                                  <?php
                                    }
                                  ?>
                                  <hr>
                                  <div class="h6 m-0 font-weight-bold text-info">NHIỆT ĐỘ HÔM NAY</div>
                                  <span class="m-0 font-weight-bold">
                                    CAO NHẤT</span>
                                    <?php
                                        if($datam['maxt']<20 || $datam['maxt']>22){
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-danger" style="float: right"><?php echo $datam['maxt'] ?>°C</span>
                                    <?php
                                        }else{
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-success" style="float: right"><?php echo $datam['maxt'] ?>°C</span>
                                    <?php
                                        }
                                    ?>
                                    <br>
                                    <span class="m-0 font-weight-bold">
                                    THẤP NHẤT</span>
                                    <?php
                                        if($datam['mint']<20 || $datam['mint']>22){
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-danger" style="float: right"><?php echo $datam['mint'] ?>°C</span>
                                    <?php
                                        }else{
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-success" style="float: right"><?php echo $datam['mint'] ?>°C</span>
                                    <?php
                                        }
                                    ?>
                                    <br>
                                    <span class="m-0 font-weight-bold">
                                    TRUNG BÌNH</span>
                                    <?php
                                        if($datam['avgt']<20 || $datam['avgt']>22){
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-danger" style="float: right"><?php echo $datam['avgt'] ?>°C</span>
                                    <?php
                                        }else{
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-success" style="float: right"><?php echo $datam['avgt'] ?>°C</span>
                                    <?php
                                        }
                                    ?>
                                    <hr>
                                  <div class="h6 m-0 font-weight-bold text-info">ĐỘ ẨM HÔM NAY</div>
                                  <span class="m-0 font-weight-bold">
                                    CAO NHẤT</span>
                                    <?php
                                        if($datam['maxh']<45 || $datam['maxh']>50){
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-danger" style="float: right"><?php echo $datam['maxh'] ?>%</span>
                                    <?php
                                        }else{
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-success" style="float: right"><?php echo $datam['maxh'] ?>%</span>
                                    <?php
                                        }
                                    ?>
                                    <br>
                                    <span class="m-0 font-weight-bold">
                                    THẤP NHẤT</span>
                                    <?php
                                        if($datam['minh']<45 || $datam['minh']>50){
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-danger" style="float: right"><?php echo $datam['minh'] ?>%</span>
                                    <?php
                                        }else{
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-success" style="float: right"><?php echo $datam['minh'] ?>%</span>
                                    <?php
                                        }
                                    ?>
                                    <br>
                                    <span class="m-0 font-weight-bold">
                                    TRUNG BÌNH</span>
                                    <?php
                                        if($datam['avgh']<20 || $datam['avgh']>22){
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-danger" style="float: right"><?php echo $datam['avgh'] ?>%</span>
                                    <?php
                                        }else{
                                    ?>
                                    <span class="h6 m-0 font-weight-bold text-success" style="float: right"><?php echo $datam['avgh'] ?>%</span>
                                    <?php
                                        }
                                    ?>
                                <hr>
                                <u><i><a class="h6 m-0 font-weight-bold text-primary" href="roomview.php?room=<?php echo $result['id'] ?>">Xem chi tiết</a></i></u>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
                   
    </div>
</div>
           
<?php include 'inc/footer.php'?>      