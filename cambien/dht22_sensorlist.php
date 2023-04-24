<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/dht22.php' ?>
<?php
    $sensor = new dht22();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delsensor = $sensor->del_dht22list($id);
    }
?>       
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách cảm biến DHT22</h6>
        </div>
        <div class="card-body">
            <?php if(Session::get('level')==0){ ?>
           <p><a class = "btn btn-green" href="dht22_sensoradd.php"><i class="fas fa-fw fa-plus"></i> Thêm mới</a></p>
           <?php } ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID cảm biến</th>
                            <th>Phòng</th>
                            <th>Nhiệt độ cảnh báo (°C)</th>
                            <th>Độ ẩm cảnh báo (%)</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(Session::get('level')==0){
                            $show_sensor = $sensor->show_dht22sensorad();
                        }else{
                            $show_sensor = $sensor->show_dht22sensor(Session::get('userId'));
                        }
                        
                        if($show_sensor){
                            $i = 0;
                            while($result = $show_sensor->fetch_assoc()){
                                $i++;
                            
                    ?>
                        <tr style="text-align: center"class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['id'] ?></td>
                            <td><?php echo $result['room_id'] ?></td>
                            <td> Dưới (<) <?php echo $result['alarm_temp_low'] ?>°C hoặc Trên (>) <?php echo $result['alarm_temp_high'] ?>°C</td>
                            <td> Dưới (<) <?php echo $result['alarm_hum_low'] ?>% hoặc Trên (>) <?php echo $result['alarm_hum_high'] ?>%</td>
                            <?php if(Session::get('level')==0){ ?>
                            <td><a class = "btn btn-warning" href="dht22_sensoredit.php?id=<?php echo $result['id'] ?>"><i class="fas fa-fw fa-edit"></i> Sửa</a>&ensp;<a class = "btn btn-red" onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['id'] ?>"><i class="fas fa-fw fa-trash-alt"></i> Xóa</a></td>
                            <?php
                                }else{ ?>
                                    <td>
                                        <a class = "btn btn-warning" href="dht22_sensoredit.php?id=<?php echo $result['id'] ?>"><i class="fas fa-fw fa-edit"></i> Sửa</a></td>
                            <?php
                                }
                            ?>
                        </tr>
                        <?php
                    }
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>               
<?php include 'inc/footer.php'?>
            