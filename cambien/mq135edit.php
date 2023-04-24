<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/mq135.php' ?>
<?php
   
    if(!isset($_GET['datetime']) || $_GET['datetime']==NULL){
       echo "<script>window.location ='mq135list.php'</script>";
    }else{
         $id = $_GET['datetime']; 
    }
     $mq135 = new mq135();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $quality = $_POST['quality'];
        $updatemq135 = $mq135->update_mq135($quality, $id);
        
    }

?>
<?php  ?>
        <div class="container-fluid">
            <div class="box round first grid">
                <h2>Cập nhật</h2>

               <div class="block copyblock"> 
                 <?php
                if(isset($updatemq135)){
                    echo $updatemq135;
                }
                ?>
                <?php
                    $get_mq135 = $mq135->getmq135byId($id);
                    if($get_mq135){
                        while($result = $get_mq135->fetch_assoc()){
                       
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['quality'] ?>" name="quality" placeholder="Sửa chất lượng không khí..." class="medium" />
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