<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/room.php' ?>
<?php
   
    if(!isset($_GET['id']) || $_GET['id']==NULL){
       echo "<script>window.location ='roomlist.php'</script>";
    }else{
         $id = $_GET['id']; 
    }
    $room = new room();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = $_POST['name'];
        $updateroom = $room->update_room($name, $id);
        
    }

?>

    <div class="container-fluid">
        <div class="box">
            <h2>Cập nhật phòng</h2>

           <div class="block copyblock"> 
             <?php
            if(isset($updateroom)){
                echo $updateroom;
            }
            ?>
            <?php
                $get_room = $room->getroombyId($id);
                if($get_room){
                    while($result = $get_room->fetch_assoc()){
                   
            ?>
             <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <lable>Tên phòng</lable>
                        </td>
                        
                        <td>
                            <input type="text" value="<?php echo $result['name'] ?>" name="name" placeholder="Đổi tên..." class="medium" />
                        </td>
                    </tr>
                    
					<tr> 
                        <td>
                            <input class = "btn btn-blue" type="submit" name="submit" Value="Cập nhật" />
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            }
        }             
            ?>

            </div>
        </div>
    </div>
<?php include 'inc/footer.php'?>