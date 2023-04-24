<?php
define("DB_HOST", "localhost");
define("DB_USER", "id18690894_dth185247");
define("DB_PASS", "Quandinh113@");
define("DB_NAME", "id18690894_sensor");

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if (!$connect)
{
	echo "Lỗi kết nối database....";
}
?>
