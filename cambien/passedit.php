<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php include 'classes/admin.php' ?>
<?php
    $ad = new admin();
    if(!isset($_GET['adminid']) || $_GET['adminid']==NULL){
       echo "<script>window.location ='adminlist.php'</script>";
    }else{
         $id = $_GET['adminid']; 
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updatePass = $ad->update_pass($_POST,$_FILES, $id);  
    }
?>
<div class="container-fluid">
    <div class="box round first grid">
        <h2>Đổi mật khẩu</h2>
        <div class="block copyblock">    
        <?php

            if(isset($updatePass)){
                echo $updatePass;
            }

        ?>
            
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">   
                <tr>
                    <td>
                        <label>Mật khẩu cũ</label>
                    </td>
                    <td>
                        <input type="password"  name="userOldPass" placeholder="Nhập mật khẩu cũ..." class="medium"/>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Mật khẩu mới</label>
                    </td>
                    <td>
                        <input type="password"  name="userPass" placeholder="Nhập mật khẩu mới..." class="medium"/>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input class = "btn btn-blue" type="submit" name="submit" value="Cập nhật" />
                    </td>
                </tr>
            </table>
            </form>
            
        </div>
    </div>
</div>

<?php include 'inc/footer.php'?>