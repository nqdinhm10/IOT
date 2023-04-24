<?php include 'inc/sidebar.php'?>
<?php include 'inc/header.php'?>
<?php 
    if(Session::get('level')==0){
?>
<?php include 'classes/admin.php'?>
<?php
    $ad = new admin();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        
        $insertAdmin = $ad->insert_admin($_POST,$_FILES);
        
    }
?>
<div class="container-fluid">
    <div class="box round first grid">
        <h2>Thêm người dùng</h2>
        <div class="block">    
         <?php

                if(isset($insertAdmin)){
                    echo $insertAdmin;
                }

            ?>             
         <form action="adminadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Họ tên</label>
                    </td>
                    <td>
                        <input type="text" name="userName" placeholder="Nhập họ tên..." class="medium" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" name="userEmail" placeholder="Nhập email..." class="medium" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Số điện thoại</label>
                    </td>
                    <td>
                        <input type="text" name="userPhone" placeholder="Nhập số điện thoại..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Tài khoản</label>
                    </td>
                    <td>
                        <input type="text" name="userId" placeholder="Nhập tên tài khoản..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Mật khẩu</label>
                    </td>
                    <td>
                        <input type="password" name="userPass" placeholder="Nhập mật khẩu..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Quyền</label>
                    </td>
                    <?php 
                        if(Session::get('level')==0){
                    ?>
                    <td>
                        <select id="select" name="level">
                            <option>---Chọn quyền---</option>
                            <option value="0">Admin</option>
                            <option value="1">Quản lý</option>
                        </select>
                    </td>
                    <?php
                        }
                    ?>
                </tr>

                <tr>
                    <td>
                        <label>Ảnh đại diện</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td></td>
                    <td>
                        <input class = "btn btn-blue" type="submit" name="submit" Value="Thêm" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<?php 
    }else{
?>
    <h4>Bạn không đủ quyền hạn!</h4>
<?php 
    }
?>
<?php include 'inc/footer.php'?>

