<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class mhrd
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
        
        public function show_mhrdtk($room){
			$query = "SELECT datetime,quality FROM mhrd a, mhrdlist l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY a.id DESC LIMIT 0,1";
			$result = $this->db->select($query);
			return $result;
		}
        
		public function show_mhrdad(){
			$query = "SELECT * FROM mhrd ORDER BY datetime DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_mhrd($room, $userid){
			$query = "SELECT sensor_id, datetime, quality FROM mhrd a, mhrdlist l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_mhrd($quality, $id){

			$quality = $this->fm->validation($quality);
			$quality = mysqli_real_escape_string($this->db->link, $quality);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($quality)){
				$alert = "<span class='error'>Vui lòng nhập đủ thông tin</span>";
				return $alert;
			}else{
				$query = "UPDATE mhrd SET quality = '$quality' WHERE datetime = '$id'";
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
		public function del_mhrd($id){
			$query = "DELETE FROM mhrd where datetime = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa không thành công</span>";
				return $alert;
			}
			
		}
		public function getmhrdbyId($id){
			$query = "SELECT * FROM mhrd where datetime = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function show_mhrdsensorad(){
			$query = "SELECT * FROM mhrdlist";
			$result = $this->db->select($query);
			return $result;
		}
        
        public function insert_mhrdsensor($data,$files){

			
			$id = mysqli_real_escape_string($this->db->link, $data['id']);
			$room = mysqli_real_escape_string($this->db->link, $data['room']);
			
			if($id=="" || $room==""){
				$alert = "<span class='error'>Vui lòng nhập đủ thông tin</span>";
				return $alert;
			}else{
			    $check_id = "SELECT * FROM mhrdlist WHERE id='$id' LIMIT 1";
				$result_check = $this->db->select($check_id);
				if($result_check){
					$alert = "<span class='error'>Mã cảm biến đã tồn tại!</span>";
					return $alert;
				}else{
				    $query = "INSERT INTO mhrdlist(id, room_id) VALUES('$id', '$room')";
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
        
        public function del_mhrdlist($id){
			$query = "DELETE FROM mhrdlist where id = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa không thành công</span>";
				return $alert;
			}
			
		}
    
		public function show_mhrdsensor($id){
			$query = "SELECT l.* FROM mhrdlist l, room_detail r WHERE l.room_id = r.room_id AND r.user_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_mhrddtp($startdate, $enddate, $room, $userid){
			$query = "SELECT sensor_id, datetime, quality FROM mhrd a, mhrdlist l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND date(datetime) BETWEEN '$startdate' AND '$enddate' ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}
        
        public function show_mhrd_7day($room, $userid){
			$query = "SELECT sensor_id, datetime, quality FROM mhrd a, mhrdlist l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND datetime >= now() - interval 7 day ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_mhrd_1month($room, $userid){
			$query = "SELECT sensor_id, datetime, quality FROM mhrd a, mhrdlist l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND datetime >= now() - interval 1 month ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_mhrd_3month($room, $userid){
			$query = "SELECT sensor_id, datetime, quality FROM mhrd a, mhrdlist l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND datetime >= now() - interval 3 month ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}
        
		public function datemin($room){
			$query = "SELECT date(datetime) as date FROM ( SELECT a.* FROM mhrd a, mhrdlist l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 ORDER BY ID ASC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function datemax($room){
			$query = "SELECT date(datetime) as date FROM ( SELECT a.* FROM mhrd a, mhrdlist l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 ORDER BY ID DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>