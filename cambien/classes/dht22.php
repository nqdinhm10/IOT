<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class dht22
	{
		private $db;
		private $fm;
		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

        public function show_dht22ad(){
			$query = "SELECT * FROM dht22";
			$result = $this->db->select($query);
			return $result;
		}
        
        public function show_dht22tk($room){
			$query = "SELECT datetime,temperature,humidity FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY a.id DESC LIMIT 0,1";
			$result = $this->db->select($query);
			return $result;
		}
        
		public function show_dht22($room, $userid){
			$query = "SELECT sensor_id, datetime, temperature, humidity FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' ORDER BY a.id DESC";

			$result = $this->db->select($query);
			return $result;
		}
		
		public function update_dht22($temperature, $humidity,$id){

			$temperature = $this->fm->validation($temperature);
			$temperature = mysqli_real_escape_string($this->db->link, $temperature);
			$humidity = $this->fm->validation($humidity);
			$humidity = mysqli_real_escape_string($this->db->link, $humidity);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($temperature) || empty($humidity)){
				$alert = "<span class='error'>Vui lòng nhập đủ thông tin</span>";
				return $alert;
			}else{
				$query = "UPDATE dht22 SET temperature = '$temperature', humidity = '$humidity' WHERE datetime = '$id'";
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
		public function del_dht22($id){
			$query = "DELETE FROM dht22 where datetime = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa không thành công</span>";
				return $alert;
			}
			
		}
		public function getdht22byId($id){
			$query = "SELECT * FROM dht22 where datetime = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_temp(){
			$query = "SELECT temperature FROM dht22 ORDER BY datetime DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_hum(){
			$query = "SELECT humidity FROM dht22 ORDER BY datetime DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_dht22sensorad(){
			$query = "SELECT * FROM dht22list";
			$result = $this->db->select($query);
			return $result;
		}
    
        public function insert_dht22sensor($data,$files){

			$id = mysqli_real_escape_string($this->db->link, $data['id']);
			$room = mysqli_real_escape_string($this->db->link, $data['room']);
			$alarm_temp_low = mysqli_real_escape_string($this->db->link, $data['alarm_temp_low']);
			$alarm_temp_high = mysqli_real_escape_string($this->db->link, $data['alarm_temp_high']);
			$alarm_hum_low = mysqli_real_escape_string($this->db->link, $data['alarm_hum_low']);
			$alarm_hum_high = mysqli_real_escape_string($this->db->link, $data['alarm_hum_high']);
			
			if($id=="" || $room=="" || $alarm_temp_low=="" || $alarm_temp_high=="" || $alarm_hum_low=="" || $alarm_hum_high==""){
				$alert = "<span class='error'>Vui lòng nhập đủ thông tin</span>";
				return $alert;
			}elseif($alarm_temp_low > $alarm_temp_high || $alarm_hum_low > $alarm_hum_high){
				$alert = "<span class='error'>Mức cảnh báo chưa phù hợp!</span>";
				return $alert;
			}else{
			    $check_id = "SELECT * FROM dht22list WHERE id='$id' LIMIT 1";
				$result_check = $this->db->select($check_id);
				if($result_check){
					$alert = "<span class='error'>Mã cảm biến đã tồn tại!</span>";
					return $alert;
				}else{
				    $query = "INSERT INTO dht22list(id, room_id, alarm_temp_low, alarm_temp_high,alarm_hum_low,alarm_hum_high) VALUES('$id', '$room', '$alarm_temp_low','$alarm_temp_high','$alarm_hum_low','$alarm_hum_high')";
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
        
		public function update_dht22sensor($data,$files,$id){
			$alarm_temp_low = mysqli_real_escape_string($this->db->link, $data['alarm_temp_low']);
			$alarm_temp_high = mysqli_real_escape_string($this->db->link, $data['alarm_temp_high']);
			$alarm_hum_low = mysqli_real_escape_string($this->db->link, $data['alarm_hum_low']);
			$alarm_hum_high = mysqli_real_escape_string($this->db->link, $data['alarm_hum_high']);

			if($alarm_temp_low=="" || $alarm_temp_high=="" || $alarm_hum_low=="" || $alarm_hum_high==""){
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			}elseif($alarm_temp_low > $alarm_temp_high || $alarm_hum_low > $alarm_hum_high){
				$alert = "<span class='error'>Mức cảnh báo chưa phù hợp!</span>";
				return $alert;
			}else{
				$query = "UPDATE dht22list SET
				alarm_temp_low = '$alarm_temp_low', alarm_temp_high = '$alarm_temp_high',
				alarm_hum_low = '$alarm_hum_low', alarm_hum_high = '$alarm_hum_high' 
				WHERE id = '$id'";
			
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
    
        public function del_dht22list($id){
			$query = "DELETE FROM dht22list where id = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa không thành công</span>";
				return $alert;
			}
			
		}
    
		public function getdht22sensorbyId($id){
			$query = "SELECT * FROM dht22list where id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_dht22sensor($id){
			$query = "SELECT l.* FROM dht22list l, room_detail r WHERE l.room_id = r.room_id AND r.user_id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_dht22dtp($startdate, $enddate, $room, $userid){
			$query = "SELECT sensor_id, datetime, temperature, humidity FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND date(datetime) BETWEEN '$startdate' AND '$enddate' ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function show_dht22_7day($room, $userid){
			$query = "SELECT sensor_id, datetime, temperature, humidity FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND datetime >= now() - interval 7 day ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_dht22_1month($room, $userid){
			$query = "SELECT sensor_id, datetime, temperature, humidity FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND datetime >= now() - interval 1 month ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function show_dht22_3month($room, $userid){
			$query = "SELECT sensor_id, datetime, temperature, humidity FROM dht22 a, dht22list l, room_detail d WHERE l.room_id = d.room_id AND l.room_id = '$room' AND a.sensor_id = l.id AND d.user_id = '$userid' AND datetime >= now() - interval 3 month ORDER BY a.id DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function datemin($room){
			$query = "SELECT date(datetime) as date FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 ORDER BY ID ASC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function datemax($room){
			$query = "SELECT date(datetime) as date FROM ( SELECT a.* FROM dht22 a, dht22list l WHERE l.room_id = '$room' AND a.sensor_id = l.id ORDER BY id DESC) Var1 ORDER BY ID DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>