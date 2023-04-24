<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/room.php' ?>
<?php
    $room = new room();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $delroom = $room->del_room($id);
    }
?>       
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách phòng</h6>
        </div>
        <div class="card-body">
            <?php if(Session::get('level')==0){ ?>
                    <p><a class = "btn btn-green" href="roomadd.php"><i class="fas fa-fw fa-plus"></i> Thêm mới</a></p>
            <?php
                }
            ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>ID</th>
                            <th>Tên phòng</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(Session::get('level')==0){
                            $show_room = $room->show_roomad();
                        }else{
                            $show_room = $room->show_room(Session::get('userId'));
                        }
                        
                        if($show_room){
                            $i = 0;
                            while($result = $show_room->fetch_assoc()){
                                $i++;
                            
                    ?>
                        <tr style="text-align: center" class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['id'] ?></td>
                            <td><?php echo $result['name'] ?></td>
                            <?php if(Session::get('level')==0){ ?>
                            <td><a class = "btn btn-warning" href="roomedit.php?id=<?php echo $result['id'] ?>"><i class="fas fa-fw fa-edit"></i> Sửa</a>&ensp;<a class = "btn btn-red" onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['id'] ?>"><i class="fas fa-fw fa-trash-alt"></i> Xóa</a>&ensp;<a class = "btn btn-green" href="roomview.php?room=<?php echo $result['id'] ?>"><i class="fas fa-fw fa-eye"></i> Xem cảm biến</a>&ensp;<a class = "btn btn-blue" href="roomuser.php?id=<?php echo $result['id'] ?>"><i class="fas fa-fw fa-user"></i> Người dùng</a></td>
                            <?php
                                }else{ ?>
                                    <td><a class = "btn btn-warning" href="roomedit.php?id=<?php echo $result['id'] ?>"><i class="fas fa-fw fa-edit"></i> Sửa</a>&ensp;<a class = "btn btn-green" href="roomview.php?room=<?php echo $result['id'] ?>"><i class="fas fa-fw fa-eye"></i> Xem cảm biến</a></td>
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
            