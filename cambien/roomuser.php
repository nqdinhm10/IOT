<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/room.php'?>
<?php include 'classes/admin.php'?>
<?php
    if(isset($_POST['delete'])){
        if(isset($_POST['checkbox'])){
            $chkarr = $_POST['checkbox'];
            foreach ($chkarr as $id) {
                mysqli_query($connect,"DELETE FROM room_detail where id = '$id'");
            }  
        }
    }mysqli_close($connect);

    $id = $_GET['id'];
    $room = new room();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $insertRoomuser = $room->insert_roomuser($_POST,$_FILES);
        
    }
?>
<div class="container-fluid">
    <div class="box">
        <h2>Thêm người dùng</h2>
        <div class="block">    
            <?php
                if(isset($insertRoomuser)){
                    echo $insertRoomuser;
                }

                $get_room = $room->getroombyId($id);
                if($get_room){
                    while($result_room = $get_room->fetch_assoc()){
                        $user = new admin();
                        $userlist = $user->show_adminselect($id);
                        if($userlist=="")
                            echo '<h4 style="color:red;text-align:center;">ĐÃ THÊM TẤT CẢ NGƯỜI DÙNG!</h4>';
                        else{

            ?>             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Phòng</label>
                    </td>
                    <td>
                        <input type="text" name="id" value="<?php echo $result_room['id'] ?>" class="small" readonly/>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Người dùng</label>
                    </td>
                    <td>
                        <select id="select" name="user">
                            <option hidden selected value="">---Chọn người dùng---</option>
                            <?php                        
                            if($userlist){
                                while($result = $userlist->fetch_assoc()){
                            ?>

                            <option value="<?php echo $result['userId'] ?>"><?php echo $result['userId'] ?></option>

                               <?php
                                  }
                              }
                           ?>
                        </select>
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
            <?php
                    }
                }
            }             
            ?>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Phòng</th>
                            <th>Người dùng</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $show_roomdetail = $room->show_roomdetail($id);
                        if($show_roomdetail){
                            $i = 0;
                            while($result = $show_roomdetail->fetch_assoc()){
                                $i++;
                            
                    ?>
                        <tr class="odd gradeX">
                            <td><input type='checkbox' name='checkbox[]' value="<?php echo $result['id'] ?>"> 
                                <?php echo $i; ?></td>
                            <td><?php echo $result['room_id'] ?></td>
                            <td><?php echo $result['user_id'] ?></td>
                        </tr>
                        <?php
                    }
                        }
                        ?>
                    </tbody>
                     <p><input type="checkbox" onClick="toggle(this)"/> Chọn tất cả &emsp;<input class = "btn btn-red" style="" type="submit" name="delete" id="delete" value="Xóa" onclick = "return confirm('Bạn có muốn xóa?')"></p>   
                </table>
                </form>
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
    
    function toggle(source) {
  checkboxes = document.getElementsByName('checkbox[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>      
<?php include 'inc/footer.php'?>


