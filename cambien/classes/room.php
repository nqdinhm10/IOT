<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class room
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
        
        public function show_roomad(){
	        $query = "SELECT * FROM room";
			$result = $this->db->select($query);
			return $result;
		}
        
		public function show_room($id){
	        $query = "SELECT r.*, rd.user_id FROM room r, room_detail rd WHERE r.id = rd.room_id AND rd.user_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function insert_room($data,$files){
		    $id = mysqli_real_escape_string($this->db->link, $data['id']);
		    $name = mysqli_real_escape_string($this->db->link, $data['name']);
			
			if($id==""||$name==""){
				$alert = "<span class='error'>Empty!!!</span>";
				return $alert;
			}else{
			    $check_id = "SELECT * FROM room WHERE id='$id' LIMIT 1";
				$result_check = $this->db->select($check_id);
				if($result_check){
					$alert = "<span class='error'>Mã phòng đã tồn tại!</span>";
					return $alert;
				}else{
				    $query = "INSERT INTO room(id, name) VALUES('$id', '$name')";
    				$result = $this->db->insert($query);
    				if($result){
    					$alert = "<span class='success'>Thêm thành công</span>";
    					return $alert;
    				}else{
    					$alert = "<span class='error'>Thêm không thành công</span>";
    					return $alert;
    				}
				}
			}
		}
		
		public function update_room($name,$id){

			$name = $this->fm->validation($name);
			$name = mysqli_real_escape_string($this->db->link, $name);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($name)){
				$alert = "<span class='error'>Vui lòng nhập đủ thông tin</span>";
				return $alert;
			}else{
				$query = "UPDATE room SET name = '$name' WHERE id = '$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Cập nhật thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhật không thành công</span>";
					return $alert;
				}
			}

		}
		public function del_room($id){
			$query = "DELETE FROM room where id = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa không thành công</span>";
				return $alert;
			}
			
		}
		public function getroombyId($id){
			$query = "SELECT * FROM room where id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function insert_roomuser($data,$files){
		    $id = mysqli_real_escape_string($this->db->link, $data['id']);
		    $user = mysqli_real_escape_string($this->db->link, $data['user']);
			
			if($id==""||$user==""){
				$alert = "<span class='error'>Vui lòng chọn người dùng!</span>";
				return $alert;
			}else{
				$check = "SELECT * FROM room_detail WHERE room_id = '$id' AND user_id='$user' LIMIT 1";
				$result_check = $this->db->select($check);
				if($result_check){
					$alert = "<span class='error'>Trùng lặp dữ liệu!</span>";
					return $alert;
				}else{
					$query = "INSERT INTO room_detail(room_id, user_id) VALUES('$id', '$user')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Thêm thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm không thành công</span>";
						return $alert;
					}
				}
			}
		}

		public function show_roomdetail($room){
	        $query = "SELECT * FROM room_detail WHERE room_id = '$room'";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>