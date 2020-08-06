<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_board extends CI_Model {
	function __construct () {
		parent::__construct();
	}
	function get_list ($data = array()) {

		//검색 기능
		$query = "SELECT `idx`, `title`, `writer`, `image`, `content`, `reg_date`, `del` FROM `posts` WHERE `title` LIKE '%$data[2]%' AND `del` = 'N' ORDER BY `idx` DESC LIMIT {$data[0]}, {$data[1]}";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute();
			$row = $result->fetchAll(PDO::FETCH_ASSOC);
			return $row;  
		} catch (PDOException $e) {				
			return 'error';
		}
	}

	function get_list_cnt ($data) {		
		
		$query = "SELECT COUNT(*) AS `cnt` FROM `posts` WHERE `title` LIKE '%$data%' AND `del` = 'N'";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute();
			$row = $result->fetch(PDO::FETCH_ASSOC);						
			return $row['cnt'];  
		} catch (PDOException $e) {				
			return 'error';
		}	
	}

	function get_my_post ($data = array()) {		
		
		$query = "SELECT `idx`, `title`, `writer`, `reg_date` FROM `posts` WHERE `writer` = '{$data[2]}' AND `del` = 'N' ORDER BY `idx` DESC LIMIT {$data[0]}, {$data[1]}";
		try {
			$result = $this->db->conn_id->prepare($query);			
			$result->execute();
			$row = $result->fetchAll(PDO::FETCH_ASSOC);			
			return $row;
		} catch (PDOException $e) {				
			return 'error';
		}
	}

	function get_myPost_cnt ($data = array()) {		
		
		$query = "SELECT COUNT(*) AS `cnt` FROM `posts` WHERE `del` = 'N' AND `writer` = :writer";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->bindValue(':writer', $data);
			$result->execute();
			$row = $result->fetch(PDO::FETCH_ASSOC);						
			return $row['cnt'];  
		} catch (PDOException $e) {				
			return 'error';
		}
	}

	function get_my_comment ($data = array()) {				
		$query = "SELECT `idx`, `writer`, `comment`, `reg_date` FROM `comment` WHERE `writer` = :writer ORDER BY `reg_date` DESC";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->bindValue(':writer', $data);
			$result->execute();
			$row = $result->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		} catch (PDOException $e) {				
			return 'error';
		}
	}

	function set_post ($data = array()) {
		
		if (!@$data) return 'error';
		$query = "INSERT INTO `posts` (`posts_cate`, `title`, `content`, `image`, `writer`, `reg_date`) VALUES (?, ?, ?, ?, ?, now())";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute(array($data['posts_cate'],$data['title'], $data['content'], $data['image'], $data['writer']));
			return $this->db->conn_id->lastInsertId();
		} catch (PDOException $e) {				
			return 'error';
		}

	}

	function get_post ($idx) {
		$query = "SELECT `idx`, `title`, `content`, `image`, `writer`, `reg_date` FROM `posts` WHERE `idx` = ?";

		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute(array($idx));
			$row = $result->fetch(PDO::FETCH_ASSOC);
			return $row;
		} catch (PDOException $e) {				
			return 'error';
		}
	}

	function set_comment ($data = array()) {	

		$query = "INSERT INTO `comment` (`writer`, `posts_idx`, `comment`, `reg_date`) VALUES (?, ?, ?, ?)";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute(array($data['nickname'], $data['idx'], $data['comment'], $data['now']));
			return $this->db->conn_id->lastInsertId();
		} catch (PDOException $e) {				
			return 'error';
		}

	}

	function get_comment ($idx) {
		$query = "SELECT `idx`, `writer`, `comment`, `reg_date` FROM `comment` WHERE `posts_idx` = ? AND `del_comment` = 'N' ORDER BY `reg_date` DESC";

		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute(array($idx));
			$row = $result->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		} catch (PDOException $e) {				
			return 'error';
		}
	}

	//관리자용 댓글 전체보기
	function get_comments($data = array()) {
		$query = "SELECT `idx`, `posts_idx` ,`writer`, `comment`, `reg_date`, `del_comment` FROM `comment` WHERE `del_comment` = 'N' ORDER BY `reg_date` DESC LIMIT {$data[0]}, {$data[1]}";

		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute();
			$row = $result->fetchAll(PDO::FETCH_ASSOC);
			return $row;
		} catch (PDOException $e) {				
			return 'error';
		}
	}

	function get_comments_cnt() {
		$query = "SELECT COUNT(*) AS `cnt` FROM `comment` WHERE `del_comment` = 'N'";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute();
			$row = $result->fetch(PDO::FETCH_ASSOC);						
			return $row['cnt'];  
		} catch (PDOException $e) {				
			return 'error';
		}	
	}

	function del_comment($idx) {
		$query = "UPDATE `comment` SET `del_comment` = 'Y' WHERE `idx` = ?";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute(array($idx));		
			return 'success';
		} catch (PDOException $e) {
			return $e;
		}
	}

	function del_post ($data = array()) {
		
		$query = "UPDATE `posts` SET `del` = 'Y' WHERE `writer` = :writer AND `idx` = :idx";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->bindValue(':writer', $data['nickname']);
			$result->bindValue(':idx', $data['idx']);
			$result->execute();		
			return 'success';
		} catch (PDOException $e) {
			return $e;
		}
	}
	function set_view_count ($data = array()) {
		if (!@$data) return 'error';
		$query = "INSERT INTO `view_cnt` (`posts_idx`, `ip`, `reg_date`) VALUES (?, ?, ?)";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->execute($data);
			return 'succes';
		} catch (PDOException $e) {
			return 'error';
		}
	}

	function get_view_count ($idx) {
		$query = "SELECT COUNT(*) AS `cnt` FROM `view_cnt` WHERE `posts_idx` = :idx";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->bindValue(':idx', $idx);
			$result->execute();
			$row = $result->fetch(PDO::FETCH_ASSOC);
			return $row['cnt'];
		} catch (PDOException $e) {
			return 'error';
		}
	}

	function get_comment_count ($idx) {
		$query = "SELECT COUNT(*) AS `cnt` FROM `comment` WHERE `posts_idx` = :idx";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->bindValue(':idx', $idx);
			$result->execute();
			$row = $result->fetch(PDO::FETCH_ASSOC);
			return $row['cnt'];
		} catch (PDOException $e) {
			return 'error';
		}

	}

	function get_like_count ($idx) {
		$query = "SELECT COUNT(*) AS `cnt` FROM `posts_like` WHERE `posts_idx` = :idx";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->bindValue(':idx', $idx);
			$result->execute();
			$row = $result->fetch(PDO::FETCH_ASSOC);
			return $row['cnt'];
		} catch (PDOException $e) {
			return 'error';
		}
	}

	function checkLike_post ($data = array()){
		if (!@$data) return 'error';		
		$query = "SELECT COUNT(*) AS `cnt` FROM `posts_like` WHERE `posts_idx` = :posts_idx AND `member_idx` = :member_idx";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->bindValue(':posts_idx', $data['posts_idx']);
			$result->bindValue(':member_idx', $data['member_idx']);			
			$result->execute();
			$row = $result->fetch(PDO::FETCH_ASSOC);
			return $row['cnt'];
		} catch (PDOException $e) {
			return 'error';
		}
	}

	function del_like ($data = array()) {
		if (!@$data) return 'error';		
		$query = "DELETE FROM `posts_like` WHERE `posts_idx` = :posts_idx AND `member_idx` = :member_idx";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->bindValue(':posts_idx', $data['posts_idx']);
			$result->bindValue(':member_idx', $data['member_idx']);			
			$result->execute();
			$row = $result->fetch(PDO::FETCH_ASSOC);
			return $row['cnt'];
		} catch (PDOException $e) {
			return 'error';
		}
	}

	function like_post ($data = array()){
		if (!@$data) return 'error';		
		$query = "INSERT INTO `posts_like`(`posts_idx`, `member_idx`, `reg_date`) VALUES(:posts_idx, :member_idx, now())";
		try {
			$result = $this->db->conn_id->prepare($query);
			$result->bindValue(':posts_idx', $data['posts_idx']);
			$result->bindValue(':member_idx', $data['member_idx']);
			$result->execute();			
			$result->fetch(PDO::FETCH_ASSOC);
			return $this->db->conn_id->lastInsertId();
		} catch (PDOException $e) {
			return 'error';
		}
	}

}	
