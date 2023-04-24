<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/mhrd.php'?>
<?php include 'classes/room.php'?>
<?php
    $sensor = new mhrd();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $insertsensor = $sensor->insert_mhrdsensor($_POST,$_FILES);
        
    }
?>
<div class="container-fluid">
    <div class="box">
        <h2>Thêm cảm biến MHRD</h2>
        <div class="block">    
         <?php
                if(isset($insertsensor)){
                    echo $insertsensor;
                }
            ?>             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td style="width:200px">
                        <label>ID cảm biến</label>
                    </td>
                    <td>
                        <input type="text" name="id" placeholder="Nhập ID..." class="mini" />
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


