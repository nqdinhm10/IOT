<?php
    include 'lib/session.php';
    Session::checkSession();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hệ thống giám sát môi trường</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <!-- Custom styles for catlist page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Chart -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/style.css" rel="stylesheet">
    
    <script src="dist/gauge.min.js"></script>
</head>

<body id="page-top">
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Hãy chọn "Xác nhận" để đăng xuất.</div>
                <div class="modal-footer">                 
                    <?php
                        if(isset($_GET['action']) && $_GET['action']=='logout'){
                            Session::destroy();
                        }
                    ?>
                    <a class="btn btn-red" href="?action=logout">Xác nhận</a>
                    <button class="btn btn-grey" type="button" data-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-server"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SERVER CENTER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Bảng điều khiển
            </div>
            
            <!-- Nav Item - DHT22 Collapse Menu -->
            <li class="nav-item">
                <?php
                    if(Session::get('level')==0){
                ?>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseROOM"
                    aria-expanded="true" aria-controls="collapseROOM">
                    <i class="fas fa-fw fa-list"></i>
                    <span>PHÒNG</span>
                </a>
                
                <div id="collapseROOM" class="collapse" aria-labelledby="headingROOM" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                       
                        <a class="collapse-item" href="roomadd.php">Thêm</a>
                        <a class="collapse-item" href="roomlist.php">Danh sách</a>
                    </div>
                </div>
                <?php
                    }else{
                ?>
                <a class="nav-link collapsed" href="roomlist.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>PHÒNG</span>
                </a>
                <?php
                    }
                ?>
            </li>
            
            <!-- Nav Item - DHT22 Collapse Menu -->
            <li class="nav-item">
                <?php
                    if(Session::get('level')==0){
                ?>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDHT22"
                    aria-expanded="true" aria-controls="collapseDHT22">
                    <i class="fas fa-fw fa-list"></i>
                    <span>DHT22 (Nhiệt/Ẩm độ)</span>
                </a>
                <div id="collapseDHT22" class="collapse" aria-labelledby="headingDHT22" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                       
                        <a class="collapse-item" href="dht22_sensoradd.php">Thêm</a>
                        <a class="collapse-item" href="dht22_sensorlist.php">Danh sách</a>
                    </div>
                </div>
                <?php
                    }else{
                ?>
                <a class="nav-link collapsed" href="dht22_sensorlist.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>DHT22 (Nhiệt/Ẩm độ)</span>
                </a>
                <?php
                    }
                ?>
            </li>
            
            <!-- Nav Item - MQ135 Collapse Menu -->
            <li class="nav-item">
                <?php
                    if(Session::get('level')==0){
                ?>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMQ135"
                    aria-expanded="true" aria-controls="collapseMQ135">
                    <i class="fas fa-fw fa-list"></i>
                    <span>MQ135 (Không khí)</span>
                </a>
                <div id="collapseMQ135" class="collapse" aria-labelledby="headingMQ135" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                       
                        <a class="collapse-item" href="mq135_sensoradd.php">Thêm</a>
                        <a class="collapse-item" href="mq135_sensorlist.php">Danh sách</a>
                    </div>
                </div>
                <?php
                    }else{
                ?>
                <a class="nav-link collapsed" href="mq135_sensorlist.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>MQ135 (Không khí)</span>
                </a>
                <?php
                    }
                ?>
            </li>

            <li class="nav-item">
                <?php
                    if(Session::get('level')==0){
                ?>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMHRD"
                    aria-expanded="true" aria-controls="collapseMHRD">
                    <i class="fas fa-fw fa-list"></i>
                    <span>MH-RD (Rò rỉ nước)</span>
                </a>
                <div id="collapseMHRD" class="collapse" aria-labelledby="headingMHRD" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                       
                        <a class="collapse-item" href="mhrd_sensoradd.php">Thêm</a>
                        <a class="collapse-item" href="mhrd_sensorlist.php">Danh sách</a>
                    </div>
                </div>
                <?php
                    }else{
                ?>
                <a class="nav-link collapsed" href="mhrd_sensorlist.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>MH-RD (Rò rỉ nước)</span>
                </a>
                <?php
                    }
                ?>
            </li>
            
            <!-- Nav Item - HL83 Collapse Menu -->
            <!--<li class="nav-item">-->
            <!--    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHL83"-->
            <!--        aria-expanded="true" aria-controls="collapseHL83">-->
            <!--        <i class="fas fa-fw fa-list"></i>-->
            <!--        <span>HL83</span>-->
            <!--    </a>-->
            <!--    <div id="collapseHL83" class="collapse" aria-labelledby="headingHL83" data-parent="#accordionSidebar">-->
            <!--        <div class="bg-white py-2 collapse-inner rounded">                       -->
            <!--            <a class="collapse-item" href="hl83_sensorlist.php">Danh sách</a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</li>-->
            
            <?php
                if(Session::get('level')==0){
            ?>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Quản trị
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Người dùng</span>
                    </a>

                    
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">                      
                            <a class="collapse-item" href="adminadd.php">Thêm người dùng</a>
                            <a class="collapse-item" href="adminlist.php">Danh sách người dùng</a>
                            
                        </div>
                    </div>
                    
                </li>
            <?php
                }
            ?>
            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->