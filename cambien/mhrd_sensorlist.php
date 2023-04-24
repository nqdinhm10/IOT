<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/mhrd.php' ?>
<?php
    $sensor = new mhrd();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delsensor = $sensor->del_mhrdlist($id);
    }
?>       
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách cảm biến rò rỉ nước MHRD</h6>
        </div>
        <div class="card-body">
            <?php if(Session::get('level')==0){ ?>
           <p><a class = "btn btn-green" href="mhrd_sensoradd.php"><i class="fas fa-fw fa-plus"></i> Thêm mới</a></p>
           <?php } ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID cảm biến</th>
                            <th>Phòng</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(Session::get('level')==0){
                            $show_sensor = $sensor->show_mhrdsensorad();
                        }else{
                            $show_sensor = $sensor->show_mhrdsensor(Session::get('userId'));
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
                            
                            <?php if(Session::get('level')==0){ ?>
                            <td><a class = "btn btn-red" onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['id'] ?>"><i class="fas fa-fw fa-trash-alt"></i> Xóa</a></td>
                            <?php
                                }else{ ?>
                                    <td>N/A</td>
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
            