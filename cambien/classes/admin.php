<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class admin
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insert_admin($data,$files){

			$userName = mysqli_real_escape_string($this->db->link, $data['userName']);
			$userEmail = mysqli_real_escape_string($this->db->link, $data['userEmail']);
			$userPhone = mysqli_real_escape_string($this->db->link, $data['userPhone']);
			$userId = mysqli_real_escape_string($this->db->link, $data['userId']);
			$userPass = mysqli_real_escape_string($this->db->link, md5($data['userPass']));
			$level = mysqli_real_escape_string($this->db->link, $data['level']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($userName=="" || $userEmail=="" || $userPhone=="" || $userId=="" || $userPass=="" || $level==""){
				$alert = "<span class='error'>Vui lòng nhập đầy đủ thông tin</span>";
				return $alert;
			}else{
				$check_user = "SELECT * FROM user WHERE userId='$userId' LIMIT 1";
				$result_check = $this->db->select($check_user);
				if($result_check){
					$alert = "<span class='error'>Tài khoản đã tồn tại!</span>";
					return $alert;
				}else{
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "INSERT INTO user(userName, userEmail, userPhone, userId, userPass, level, image) VALUES('$userName', '$userEmail', '$userPhone', '$userId', '$userPass', '$level', '$unique_image')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Thêm người dùng thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm người dùng không thành công</span>";
						return $alert;
					}
				}
			}
		}
		public function show_admin(){
			$query = "SELECT * FROM user order by userId desc";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function show_countadmin(){
			$query = "SELECT COUNT(*) AS countuser FROM user";
			$result = $this->db->select($query);
			return $result;
		}

		public function getadminbyId($id){
			$query = "SELECT * FROM user where userId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function update_admin($data,$files,$id){
			$userName = mysqli_real_escape_string($this->db->link, $data['userName']);
			$userEmail = mysqli_real_escape_string($this->db->link, $data['userEmail']);
			$userPhone = mysqli_real_escape_string($this->db->link, $data['userPhone']);
			$level = mysqli_real_escape_string($this->db->link, $data['level']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			$status = mysqli_real_escape_string($this->db->link, $data['status']);
			if($userName=="" || $userEmail=="" || $userPhone=="" || $level==""){
				$alert = "<span class='error'>Vui lòng nhập đủ thông tin</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 20480000) {

		    		 $alert = "<span class='success'>Kích thước ảnh nên nhỏ hơn 2MB!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE user SET
					userName = '$userName',
					userEmail = '$userEmail',
					userPhone = '$userPhone',
					level = '$level', 
					image = '$unique_image',
					status = '$status'
					WHERE userId = '$id'";
					
				}else{
					$query = "UPDATE user SET
					userName = '$userName',
					userEmail = '$userEmail',
					userPhone = '$userPhone',
					level = '$level',
					status = '$status' 
					WHERE userId = '$id'";
				}
					$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Cập nhật thành công.</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Cập nhật không thành công.</span>";
						return $alert;
					}
			
			}

		}

		public function update_nhanvien($data,$files,$id){
			$userName = mysqli_real_escape_string($this->db->link, $data['userName']);
			$userEmail = mysqli_real_escape_string($this->db->link, $data['userEmail']);
			$userPhone = mysqli_real_escape_string($this->db->link, $data['userPhone']);
			//Kiem tra hình ảnh và lấy hình ảnh cho vào folder upload
			$permited  = array('jpg', 'jpeg', 'png', 'gif');

			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			// $file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;
			if($userName=="" || $userEmail=="" || $userPhone==""){
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//Nếu người dùng chọn ảnh
					if ($file_size > 2048000) {

		    		 $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
					return $alert;
				    } 
					elseif (in_array($file_ext, $permited) === false) 
					{
				     // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
				    $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
					return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE user SET
					userName = '$userName',
					userEmail = '$userEmail',
					userPhone = '$userPhone',
					image = '$unique_image'
					WHERE userId = '$id'";
					
				}else{
					$query = "UPDATE user SET
					userName = '$userName',
					userEmail = '$userEmail',
					userPhone = '$userPhone'
					WHERE userId = '$id'";
				}
					$result = $this->db->update($query);
					if($result){
						$alert = "<span class='success'>Cập nhật thành công.</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Cập nhật không thành công.</span>";
						return $alert;
					}
			
			}

		}
		
		public function update_pass($data,$files,$id){
			$userOldPass = mysqli_real_escape_string($this->db->link, md5($data['userOldPass']));		
			$userPass = mysqli_real_escape_string($this->db->link, md5($data['userPass']));
			$queryP = "SELECT * FROM user where userId = '$id' AND userPass = '$userOldPass'";
			$resultP = $this->db->select($queryP);
			if($resultP){
				$query = "UPDATE user SET
				userPass = '$userPass'
				WHERE userId = '$id'";
			}else{
				$alert = "<span class='error'>Mật khẩu cũ không đúng</span>";
				return $alert;
			}
			$result = $this->db->update($query);
			if($result){
				$alert = "<span class='success'>Đổi mật khẩu thành công.</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Đổi mật khẩu không thành công.</span>";
				return $alert;
			}		
		}

		public function restore_pass($data,$files,$id){
			$userPass = mysqli_real_escape_string($this->db->link, md5($data['userPass']));

			$query = "UPDATE user SET
			userPass = '$userPass'
			WHERE userId = '$id'";
			$result = $this->db->update($query);
			if($result){
				$alert = "<span class='success'>Phục hồi thành công.</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Phục hồi không thành công.</span>";
				return $alert;
			}
		}

		public function del_admin($id){
			$query = "DELETE FROM user where userId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa người dùng thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa người dùng không thành công</span>";
				return $alert;
			}	
		}
		
		public function show_adminselect($room){
			$query = "SELECT userId FROM user WHERE userId NOT IN (SELECT s.userId FROM user s, room_detail where userId = user_id and room_id = '$room');";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>