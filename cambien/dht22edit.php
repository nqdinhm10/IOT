<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/dht22.php' ?>
<?php
   
    if(!isset($_GET['datetime']) || $_GET['datetime']==NULL){
       echo "<script>window.location ='dht22list.php'</script>";
    }else{
         $id = $_GET['datetime']; 
    }
     $dht22 = new dht22();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $temperature = $_POST['temperature'];
        $humidity = $_POST['humidity'];
        $updatedht22 = $dht22->update_dht22($temperature, $humidity, $id);
        
    }

?>
<?php  ?>
        <div class="container-fluid">
            <div class="box round first grid">
                <h2>Cập nhật</h2>

               <div class="block copyblock"> 
                 <?php
                if(isset($updatedht22)){
                    echo $updatedht22;
                }
                ?>
                <?php
                    $get_dht22 = $dht22->getdht22byId($id);
                    if($get_dht22){
                        while($result = $get_dht22->fetch_assoc()){
                       
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <lable>Nhiệt độ</lable>
                            </td>
                            
                            <td>
                                <input type="text" value="<?php echo $result['temperature'] ?>" name="temperature" placeholder="Sửa nhiệt độ..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <lable>Độ ẩm</lable>
                            </td>
                            
                            <td>
                                <input type="text" value="<?php echo $result['humidity'] ?>" name="humidity" placeholder="Sửa độ ẩm..." class="medium" />
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