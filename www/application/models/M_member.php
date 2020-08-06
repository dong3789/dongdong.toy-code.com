<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_member extends CI_Model {
	function __construct () {
		parent::__construct();
	}

	function get_member ($data = array()) {
		if (!@$data) return 'login_fail';		
		$query = "SELECT `idx`, `id`, `nickname` FROM `member` WHERE `id` = ? AND `pwd` = PASSWORD(?) AND `del_member` = 'N' ";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute($data);

			$row = $result->fetch(PDO::FETCH_ASSOC);

			if ($row) {
				return $row;
			} else {
				return 'login_fail';
			}
		} catch (PDOException $e) {
			return $e;
		}
	}


	function get_member_cnt () {
		$query = "SELECT COUNT(*) AS `cnt` FROM `member` WHERE `del_member` = 'N'";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute();
			$row = $result->fetch(PDO::FETCH_ASSOC);						
			return $row['cnt'];  
		} catch (PDOException $e) {				
			return 'error';
		}	
	}

	function get_member_id ($data = array()) {		
		if (!@$data) return 1;
		$query = "SELECT COUNT(*) AS `cnt` FROM `member` WHERE `id` = ?";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute($data);
			$row = $result->fetch(PDO::FETCH_ASSOC);			
			return $row['cnt'];
		} catch (PDOException $e) {
			return $e;
		}
	}

	function get_member_nickname ($data = array()) {
		if (!@$data) return 1;
		$query = "SELECT COUNT(*) AS `cnt` FROM `member` WHERE `nickname` = ?";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute($data);
			$row = $result->fetch(PDO::FETCH_ASSOC);
			return $row['cnt'];
		} catch (PDOException $e) {
			return $e;
		}
	}

	function get_pwCheck ($data = array()) {
		if (!@$data) return 1;		
		try {
			$pw = $data['pw'];
			$re_pw = $data['re_pw'];

			if($pw == $re_pw) {
				return $row = 1;
			} else if($re_pw == ''){
				return 'nothing';
			} else {
				return false;
			}			 
		} catch (PDOException $e) {
			return $e;
		}
	}

	function set_join ($data = array()) {		
		if (!@$data) return 1;
		$query = "INSERT INTO `member`(`id`, `pwd`, `nickname`, `reg_date`) VALUES (?, PASSWORD(?), ?, ?)";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute(array($data['id'], $data['pwd'], $data['nickname'], $data['now']));
			
			return $this->db->conn_id->lastInsertId();
		} catch (PDOException $e) {
			return 'error';
		}
	}

	function get_origin_pw($data = array()){
		if (!@$data) return 0; 
		//해킹, 오류 예방
		$query = "SELECT COUNT(*) AS `cnt` FROM `member` WHERE `idx` = ? AND `pwd` = PASSWORD(?)";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute($data);
			
			$row = $result->fetch(PDO::FETCH_ASSOC);

			return $row['cnt'];
		} catch (PDOException $e) {				
			return $e;
		}
	}

	function update_pw ($data = array()){
		if(!@$data) return 'error';

		$query = "UPDATE `member` SET `pwd` = PASSWORD(?) WHERE `idx` = ?";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute($data);
			
			return 'success';
		} catch (PDOException $e) {
			return 'error';
		}
	}

	function get_nickCheck($data = array()) {
		if(!@$data) return 'error';
		$query = "SELECT COUNT(*) AS `cnt` FROM `member` WHERE `nickname` = ?";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute($data);
			
			$row = $result->fetch(PDO::FETCH_ASSOC);

			return $row['cnt'];
		} catch (PDOException $e) {				
			return 'error';
		}
	}

	function update_nick ($data = array()){
		if(!@$data) return 'error';

		$query = "UPDATE `member` SET `nickname` = ? WHERE `idx` = ?";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute($data);
			
			return 'success';
		} catch (PDOException $e) {
			return $e;
		}
	}

	function search_pw ($id) {
		
		if(!@$id) return 'error';
		$pw = 1234;
		$query = "UPDATE `member` SET `pwd` = PASSWORD(?) WHERE `id` = ?";
				try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute(array($pw, $id));			
			return 'success';
		} catch (PDOException $e) {
			return $e;
		}
	}

	function secession_data ($data = array()) {
		if(!@$data) return 'error';
		$query = "UPDATE `member` SET `del_member` = 'Y' WHERE `id` = ? AND `pwd` = PASSWORD(?)";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute($data);			
			return 'success';
		} catch (PDOException $e) {
			return $e;
		}
	}
	
	function get_member_list ($data = array()) {
		$query = "SELECT `idx`, `id`, `nickname`, `reg_date`, `del_member` FROM `member` WHERE `del_member` = 'N' LIMIT {$data[0]}, {$data[1]}"; 
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute();		
			$row = $result->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		} catch (PDOException $e) {
			return $e;
		}
	}

	function secession_member ($data) {
		$query = "UPDATE `member` SET `del_member` = 'Y' WHERE `idx` = ?";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute(array($data));		
			return $this->db->conn_id->lastInsertId();
		} catch (PDOException $e) {
			return $e;
		}
	}
}