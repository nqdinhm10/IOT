<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	Session::checkLogin();
	include_once($filepath.'/../lib/database.php');
	include_once($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class adminlogin
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function login_admin($userId,$userPass){
			$userId = $this->fm->validation($userId);
			$userPass = $this->fm->validation($userPass);

			$userId = mysqli_real_escape_string($this->db->link, $userId);
			$userPass = mysqli_real_escape_string($this->db->link, $userPass);

			if(empty($userId) || empty($userPass)){
				$alert = "Vui lòng nhập đủ thông tin";
				return $alert;
			}else{
				$query = "SELECT * FROM user WHERE userId = '$userId' AND userPass = '$userPass' AND status = 0";
				$result = $this->db->select($query);

				if($result != false){

					$value = $result->fetch_assoc();

					Session::set('adminlogin', true);

					Session::set('userId', $value['userId']);
					Session::set('userName', $value['userName']);
					Session::set('level', $value['level']);
					Session::set('image', $value['image']);
					header('Location:index.php');

				}else{
					$alert = "Đăng nhập không thành công!";
					return $alert;
				}
			}
		}


	}
?>