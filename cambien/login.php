 <?php
    include 'classes/adminlogin.php';
?>
<?php
    $class = new adminlogin();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $userId = $_POST['userId'];
        $userPass = md5($_POST['userPass']);

        $login_check = $class->login_admin($userId,$userPass);
        
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng nhập</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                     
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 mb-4" style="color: #4066d4"><b>HỆ THỐNG GIÁM SÁT MÔI TRƯỜNG</b></h1>
                                        <h1 class="h5 text-gray-900 mb-4">ĐĂNG NHẬP</h1>
                                    </div>
                                    <form class="user" action="login.php" method="post">
                                        <span><?php
                                        if(isset($login_check)){
                                            echo $login_check;
                                        }
                                         ?></span>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                placeholder="Tài khoản" required="" name="userId">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                 placeholder="Mật khẩu" required="" name="userPass" id="show">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" onclick="showPass()">
                                                <label class="custom-control-label" for="customCheck">Hiện mật khẩu</label>
                                                <label style="float: right"><a href="forgot-password.php">Quên mật khẩu<a></label>
                                            </div>
                                        </div>
                                        <div>
                                            <input class="btn btn-primary btn-user btn-block" type="submit" value="Đăng nhập" />
                                        </div>
                            
                                    </form>
                                    
                                </div>
                           
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript">
        function showPass(){
            var show = document.getElementById('show');
            if(show.type=='password'){
                show.type='text';
            }else{
                show.type='password';
            }
        }
    </script>
</body>

</html>