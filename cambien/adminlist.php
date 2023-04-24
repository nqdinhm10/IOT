<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php
    if(Session::get('level')==0 || Session::get('level')==1){
?>
<?php include 'classes/admin.php'?>
<?php
    $admin = new admin();
     if(isset($_GET['delid'])){
        $id = $_GET['delid']; 
        $deladmin = $admin->del_admin($id);
    }
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách người dùng</h6>
        </div>
        <div class="card-body">
            <p><a class = "btn btn-green" href="adminadd.php"><i class="fas fa-fw fa-plus"></i> Thêm mới</a></p>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Tài khoản</th>
                            <th>Quyền</th>
                            <th>Ảnh đại diện</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
						$show_admin = $admin->show_admin();
						if($show_admin){
							$i = 0;
							while($result = $show_admin->fetch_assoc()){
								$i++;
							
					?>
                        <tr style="text-align: center" class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['userName'] ?></td>
                            <td><?php echo $result['userEmail'] ?></td>
                            <td><?php echo $result['userPhone'] ?></td>
                            <td><?php echo $result['userId'] ?></td>
                            <td><?php 
                                if($result['level']==0){
                                    echo 'Admin';
                                }else{
                                    echo 'Quản lý';
                                }

                                ?>                                  
                            </td>
                            <td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>
                            <td><?php 
                                if($result['status']==0){
                                    echo '<b><span style="color:green;">Khả dụng</span></b>';  
                                }else{
                                    echo '<b><span style="color:red;">Đang khóa</span></b>';
                                }

                                ?>                                  
                            </td>
                            <?php
                                if(Session::get('level')==1 && ($result['level']==0 || $result['level']==1)){
                            ?>
		                            <td></td>
                            <?php
                                }elseif(Session::get('level')==1 && $result['level']==2){
                            ?>
                                <td><a class = "btn btn-warinng" href="adminedit.php?adminid=<?php echo $result['userId'] ?>"><i class="fas fa-fw fa-edit"></i> Sửa</a><a class = "btn btn-red" onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['userId'] ?>"><i class="fas fa-fw fa-trash-alt"></i> Xóa</a><a class = "btn btn-blue" href="passrestore.php?adminid=<?php echo $result['userId'] ?>"><i class="fas fa-fw fa-key"></i> Đặt lại mật khẩu</a></td>
                            <?php
                                }elseif(Session::get('level')==0 && $result['level']==0){                                     
                            ?>
                                <td><a class = "btn btn-warinng" href="adminedit.php?adminid=<?php echo $result['userId'] ?>"><i class="fas fa-fw fa-edit"></i> Sửa</a></td>
                            <?php
                                }elseif(Session::get('level')==0 && $result['level']==1){
     
                            ?>
                                <td><a class = "btn btn-warinng" href="adminedit.php?adminid=<?php echo $result['userId'] ?>"><i class="fas fa-fw fa-edit"></i> Sửa</a>&ensp;<a class = "btn btn-red" onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['userId'] ?>"><i class="fas fa-fw fa-trash-alt"></i> Xóa</a><a class = "btn btn-blue" href="passrestore.php?adminid=<?php echo $result['userId'] ?>">&ensp;<i class="fas fa-fw fa-key"></i> Mật khẩu</a></td>
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

<?php 
    }else{ 
?>
    <h4>Bạn không đủ quyền hạn!</h4>
<?php
    }
?>
<?php include 'inc/footer.php'?>