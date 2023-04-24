<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/mhrd.php' ?>
<?php
   
    if(!isset($_GET['datetime']) || $_GET['datetime']==NULL){
       echo "<script>window.location ='mhrdlist.php'</script>";
    }else{
         $id = $_GET['datetime']; 
    }
     $mhrd = new mhrd();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $quality = $_POST['quality'];
        $updatemhrd = $mhrd->update_mhrd($quality, $id);
        
    }

?>
<?php  ?>
        <div class="container-fluid">
            <div class="box round first grid">
                <h2>Cập nhật</h2>

               <div class="block copyblock"> 
                 <?php
                if(isset($updatemhrd)){
                    echo $updatemhrd;
                }
                ?>
                <?php
                    $get_mhrd = $mhrd->getmhrdbyId($id);
                    if($get_mhrd){
                        while($result = $get_mhrd->fetch_assoc()){
                       
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