<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class mq135
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
        
        public function show_mq135tk($room){
			$query = "SELECT datetime,quality FROM mq135 a, mq135list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY a.id DESC LIMIT 0,1";
			$result = $this->db->select($query);
			return $result;
		}
        
		public function show_mq135ad(){
			$query = "SELECT * FROM mq135 ORDER BY datetime DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_mq135($room, $userid){
			$query = "SELECT sensor_id, datetime, quality FROM mq135 a, mq135list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_mq135($quality, $id){

			$quality = $this->fm->validation($quality);
			$quality = mysqli_real_escape_string($this->db->link, $quality);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($quality)){
				$alert = "<span class='error'>Vui lòng nhập đủ thông tin</span>";
				return $alert;
			}else{
				$query = "UPDATE mq135 SET quality = '$quality' WHERE datetime = '$id'";
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
		public function del_mq135($id){
			$query = "DELETE FROM mq135 where datetime = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa không thành công</span>";
				return $alert;
			}
			
		}
		public function getmq135byId($id){
			$query = "SELECT * FROM mq135 where datetime = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function show_mq135sensorad(){
			$query = "SELECT * FROM mq135list";
			$result = $this->db->select($query);
			return $result;
		}
        
        public function insert_mq135sensor($data,$files){

			
			$id = mysqli_real_escape_string($this->db->link, $data['id']);
			$room = mysqli_real_escape_string($this->db->link, $data['room']);
			
			if($id=="" || $room==""){
				$alert = "<span class='error'>Vui lòng nhập đủ thông tin</span>";
				return $alert;
			}else{
			    $check_id = "SELECT * FROM mq135list WHERE id='$id' LIMIT 1";
				$result_check = $this->db->select($check_id);
				if($result_check){
					$alert = "<span class='error'>Mã cảm biến đã tồn tại!</span>";
					return $alert;
				}else{
				    $query = "INSERT INTO mq135list(id, room_id) VALUES('$id', '$room')";
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
        
        public function del_mq135list($id){
			$query = "DELETE FROM mq135list where id = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa không thành công</span>";
				return $alert;
			}
			
		}
    
		public function show_mq135sensor($id){
			$query = "SELECT l.* FROM mq135list l, room_detail r WHERE l.room_id = r.room_id AND r.user_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_mq135dtp($startdate, $enddate, $room, $userid){
			$query = "SELECT sensor_id, datetime, quality FROM mq135 a, mq135list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND date(datetime) BETWEEN '$startdate' AND '$enddate' ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}
        
        public function show_mq135_7day($room, $userid){
			$query = "SELECT sensor_id, datetime, quality FROM mq135 a, mq135list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND datetime >= now() - interval 7 day ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_mq135_1month($room, $userid){
			$query = "SELECT sensor_id, datetime, quality FROM mq135 a, mq135list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND datetime >= now() - interval 1 month ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_mq135_3month($room, $userid){
			$query = "SELECT sensor_id, datetime, quality FROM mq135 a, mq135list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND datetime >= now() - interval 3 month ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}
        
		public function datemin($room){
			$query = "SELECT date(datetime) as date FROM ( SELECT a.* FROM mq135 a, mq135list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 ORDER BY ID ASC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function datemax($room){
			$query = "SELECT date(datetime) as date FROM ( SELECT a.* FROM mq135 a, mq135list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 ORDER BY ID DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>