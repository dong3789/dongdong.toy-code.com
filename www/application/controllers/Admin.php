<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct () {
		parent::__construct();
		session_start();
		$this->load->model(array('M_member'));
		$this->load->model(array('M_board'));

	}

	function index () {
		$mb = member();
		$data = array(
			'mb' => $mb,
		);
		$this->load->view('template/header', $data);		
		$this->load->view('admin/index');
		$this->load->view('template/footer');
	}

	function secessionList ($page = 1) {
		$limit = 10;
		$block = 5;
		$start = ($page - 1) * $limit;
		
		$total_cnt = $this->M_member->get_member_cnt();
		$paging = paging($total_cnt, $page, $limit, $block);
		$w_sql = array (
			$start, 
			$limit
		);
		$list = $this ->M_member->get_member_list($w_sql);
		$mb = member();	
		$data = array (
			'list' => $list,
			'paging' => $paging,
			'mb' => $mb,
		);
		if($data > 0) {
					
			$this->load->view('template/header', $data);
			$this->load->view('admin/secessionList', $data);
			$this->load->view('template/footer');		
		} else {
			alert('회원 조회 실패', './main');
		}

		
	}

	function member_posts ($page = 1) {
		$limit = 10;
		$block = 5;
		$start = ($page - 1) * $limit;
		
		$data = "";
		$total_cnt = $this->M_board->get_list_cnt($data); //전체 게시판 글 수 

		$paging = paging($total_cnt, $page, $limit, $block); //helper로 페이징할 데이터 전송
		
		$w_sql = array(
			$start,
			$limit,
			$data,			
		);
		
		$list = $this->M_board->get_list($w_sql);

		//view_cnt를 list에 담아서 같이 전송.
		foreach ($list as $key => $val) {
			$view_cnt = $this->M_board->get_view_count($val['idx']);
			$list[$key]['view_cnt'] = $view_cnt;			
		}		
		$mb = member();	
		$data = array(
			'list' => $list,
			'paging' => $paging,
			'mb' => $mb,
		);

		if($data > 0) {
			$this->load->view('template/header', $data);
			$this->load->view('admin/member_posts', $data);
			$this->load->view('template/footer');		
		} else {
			alert('글 조회 실패', './main');
		}
	}

	function member_comments ($page = 1) {
		$limit = 10;
		$block = 5;
		$start = ($page - 1) * $limit;
		
		$total_cnt = $this->M_board->get_comments_cnt();
		$paging = paging($total_cnt, $page, $limit, $block);
		$w_sql = array (
			$start, 
			$limit
		);
		$list = $this ->M_board->get_comments($w_sql);
		
		$mb = member();	
		$data = array(
			'list' => $list,
			'paging' => $paging,
			'mb' => $mb,
		);

		if($list > 0) {
			$this->load->view('template/header', $data);
			$this->load->view('admin/member_comments', $data);
			$this->load->view('template/footer');		
		} else {
			alert('글 조회 실패', './main');
		}
	}

	function admin_proc () {
		$p_data = $this->input->post();

		switch ($p_data['state']) {
			//관리자가 회원탈퇴
			case 'allSelectMember': 
				$arr = $p_data['selectMember']; 
				$secession = 0;
				for($i=0; $i<sizeof($arr); $i++){
					$secession == $this->M_member->secession_member($arr[$i]);
					$secession++;
				}			 
				
				if ($secession == count($arr)) {					
					alert('성공적으로 탈퇴했습니다.', './secessionList');

				} else {
					alert('탈퇴에 실패했습니다. \n잠시후 다시시도해 주세요.', './secessionList');
				}
				break;
			//글 삭제
			case 'memberPost': 
				$arr = $p_data['memberPost']; //삭제할 게시글
				$del_state = '';
				$del_text = '';
				$del_success = 0;
				$del_failed = 0;
				for($i=0; $i<sizeof($arr); $i++) {
					$del_state = $this->M_board->del_post($arr[$i]);

					if($del_state == 'success') $del_success++;
					else $del_failed++;
				}
				if($del_failed < 1) {					
					$del_text = $del_success.'개 글을 삭제 성공했습니다.';					
				} else {
					$del_text = $del_success.'개 글을 삭제 성공, '.$del_failed.'개 글을 삭제 실패했습니다.';					
				}
				alert($del_text, './controlBoard');
			//댓글 삭제
			case 'memberCom': 
				$arr = $p_data['memberCom']; 
				$del_state = '';
				$del_text = '';
				$del_success = 0;
				$del_failed = 0;
				for($i=0; $i<sizeof($arr); $i++) {
					$del_state = $this->M_board->del_comment($arr[$i]);

					if($del_state == 'success') $del_success++;
					else $del_failed++;
				}
				if($del_failed < 1) {								
					$del_text = $del_success.'개 댓글 삭제 성공했습니다.';
				} else {
					$del_text = $del_success.'개 글을 삭제 성공했습니다., '.$del_failed.'개 글 삭제 실패했습니다.';					
				}
				alert($del_text, './controlComments');
			default:
				_error(_ERR_LOCATION_);
				break;
		}		
	}
}