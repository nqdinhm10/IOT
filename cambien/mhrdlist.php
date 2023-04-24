<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/mhrd.php' ?>
<?php
    $mhrd = new mhrd();
    //  if(isset($_GET['delid'])){
    //     $id = $_GET['delid']; 
    //     $delmhrd = $mhrd->del_mhrd($id);
    // }
    if(isset($_POST['delete'])){
        if(isset($_POST['checkbox'])){
            $chkarr = $_POST['checkbox'];
            foreach ($chkarr as $id) {
                mysqli_query($connect,"DELETE FROM mhrd where datetime = '$id'");
            }  
        }       
    }mysqli_close($connect);
?>       
<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dữ liệu cảm biến rò rỉ nước (MHRD)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Sensor id</th>
                            <th>Thời gian</th>
                            <th>Chất lượng</th>                           
                            <!-- <th>Action</th> -->
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $datemin = $mhrd->datemin($_GET['room']);
                        $daten = $datemin->fetch_assoc();
                        $datemax = $mhrd->datemax($_GET['room']);
                        $datem = $datemax->fetch_assoc();
                        if(isset($_POST['submit'])){
                            $startdate = $_POST['startdate'];
                            $enddate = $_POST['enddate'];
                            $show_mhrd = $mhrd->show_mhrddtp($startdate, $enddate, $_GET['room'], Session::get('userId'));
                        }elseif(isset($_POST['today'])){
                            $startdate = date("Y-m-d");
                            $enddate = date("Y-m-d");
                            $show_mhrd = $mhrd->show_mhrddtp($startdate, $enddate, $_GET['room'], Session::get('userId'));
                        }elseif(isset($_POST['7day'])){
                            $show_mhrd = $mhrd->show_mhrd_7day($_GET['room'], Session::get('userId'));
                        }elseif(isset($_POST['1month'])){
                            $show_mhrd = $mhrd->show_mhrd_1month($_GET['room'], Session::get('userId'));
                        }elseif(isset($_POST['3month'])){
                            $show_mhrd = $mhrd->show_mhrd_3month($_GET['room'], Session::get('userId'));
                        }else{
                            $show_mhrd = $mhrd->show_mhrd($_GET['room'], Session::get('userId'));
                        }
                        if($show_mhrd){
                            $i = 0;
                            while($result = $show_mhrd->fetch_assoc()){
                                $i++;
                            
                    ?>
                        <tr class="odd gradeX">
                            <td><input type='checkbox' name='checkbox[]' value="<?php echo $result['datetime'] ?>"> <?php echo $i; ?></td>
                            <td><?php echo $result['sensor_id'] ?></td>
                            <td><?php echo $result['datetime'] ?></td>
                            <?php 
                                if($result['quality']==1){
                            ?>
                            <td>Tốt</td>
                            <?php
                                }else{
                            ?>
                            <td>Rò rỉ</td>
                            <?php
                                }
                            ?>
                            <!-- <td><a class = "btn btn-warning" href="mhrdedit.php?datetime=<?php echo $result['datetime'] ?>">Sửa</a><a class = "btn btn-red" onclick = "return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['datetime'] ?>">Xóa</a></td> -->
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                    <b>Từ: <input type="date" name="startdate" min="<?php echo $daten['date'] ?>" max="<?php echo $datem['date'] ?>"/>&emsp;
                    
                    Đến: <input type="date" name="enddate" min="<?php echo $daten['date'] ?>" max="<?php echo $datem['date'] ?>"/>&emsp;</b>
                            
                    <input class = "btn btn-green" type="submit" name="submit" Value="Duyệt" />&ensp;
                    <input class = "btn btn-blue" type="submit" name="today" Value="Hôm nay" />&ensp;
                    <input class = "btn btn-blue" type="submit" name="7day" Value="7 ngày" />&ensp;
                    <input class = "btn btn-blue" type="submit" name="1month" Value="1 tháng" />&ensp;
                    <input class = "btn btn-blue" type="submit" name="3month" Value="3 tháng" />&ensp;
                    <input class = "btn btn-green" type="submit" name="reset" Value="Reset" />
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