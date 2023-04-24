<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/room.php'?>
<?php
    $room = new room();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $insertRoom = $room->insert_room($_POST,$_FILES);
        
    }
?>
<div class="container-fluid">
    <div class="box">
        <h2>Thêm phòng</h2>
        <div class="block">    
         <?php
                if(isset($insertRoom)){
                    echo $insertRoom;
                }
            ?>             
         <form action="roomadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td style="width: 200px">
                        <label>ID</label>
                    </td>
                    <td>
                        <input type="text" name="id" placeholder="Nhập ID..." class="mini" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Tên phòng</label>
                    </td>
                    <td>
                        <input type="text" name="name" placeholder="Nhập tên phòng..." class="mini" />
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


