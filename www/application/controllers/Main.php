<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	function __construct () {
		parent::__construct();
		session_start();
		$this->load->model(array('M_member'));
		$this->lang->load('main', 'ko');
	}

	function index () {
		$mb = member();
		$data = array(
			'mb' => $mb,
		);
		$this->load->view('template/index_header', $data);
		$this->load->view('main/index', $data);		
		$this->load->view('template/index_footer');
	}

	function join () {
		$mb = member();
		$data = array(
			'mb' => $mb,
		);
		$this->load->view('template/header', $data);
		$this->load->view('main/join');
		$this->load->view('template/footer');
	}

	function join_proc () {				
		$p_data = $this->input->post();
		switch ($p_data['state']) {
			case 'idcheck':
				$member = $this->M_member->get_member_id(array($p_data['id']));			
				if (@$member['cnt'] > 0) {
					_error(_ERR_ID_OVER_);
				} else {
					_success(_SUC_ID_SIGN_);
				}
				break;

			case 'nicknamecheck':
				$member = $this->M_member->get_member_nickname(array($p_data['nickname']));

				if (@$member['cnt'] > 0) {
					_error(_ERR_NICK_OVER_);
				} else {
					_success(_SUC_NICK_SIGN_);
				}
				break;

			case 'pwCheck':
				$member = $this->M_member->get_pwCheck($p_data);

				if (@$member > 0) {
					_success(_SUC_PW_CHECK_);
				} else if (@$member == 'nothing') {
					_error(_ERR_PW_INSERT_);
				} else {
					_error(_ERR_PW_NOTMATCH_);
				}
				break;
					
			case 'joinMember':				
				$member = $this->M_member->get_member_id(array($p_data['id']));

				if (@$member['cnt'] > 0) {
					alert('이미 존재하는 아이디입니다.', 'back');
				}

				$member = $this->M_member->get_member_nickname(array($p_data['nickname']));

				if (@$member['cnt'] > 0) {
					alert('이미 존재하는 닉네임입니다.', 'back');
				} 

				$member = $this->M_member->get_pwCheck($p_data);

				if (@$member < 1) {					
					alert('비밀번호가 일치하지 않습니다.', 'back');
				}
				$data = array(
					'id' => $p_data['id'],
					'pwd' => $p_data['pw'],
					'nickname'=> $p_data['nickname'],
					'now' => date('Y-m-d H:i:s'),
				);

				$member = $this->M_member->set_join($data);

				if (!@$member) {
					alert('회원가입에 실패하였습니다.\n잠시후 다시시도해 주세요.\n문제가 지속될 경우 관리자에게 문의해 주세요.', 'back');
 				} else {
					alert('회원가입에 성공하였습니다.', './login');
				}
				break;
			
			default:
				_error(_ERR_LOCATION_);				
				break;
		} 			
	}

	function login () {
		$mb = member();
		$data = array(
			'mb' => $mb,
		);
		$this->load->view('template/header', $data);
		$this->load->view('main/login');
		$this->load->view('template/footer');
	}
		

	function login_proc () {
		$p_data = $this->input->post();
		$data = array(
			$p_data['id'],
			$p_data['pw'],
		);

		$member = $this->M_member->get_member($data);
		if ($member == 'login_fail') {
			alert('아이디 또는 비밀번호가 잘못되었습니다.', './login');
		} else {
			if (@$member['id']) {
				$_SESSION = array(
					'idx' => $member['idx'],
					'id' => $member['id'],
					'nickname' => $member['nickname'],
				);

				Header('Location:./');
			} else {
				msg($member);
				exit();
			}
		}
	}

	function logout () {
		session_destroy();
		alert('로그아웃 되었습니다.', './');
	}

	function mypage () {
		$mb = member();
		
		$data = array(
			'mb' => $mb,
		);
		if (!@$mb['idx']) alert('마이페이지는 회원만 접속이 가능합니다.');	
		$this->load->view('template/header', $data);
		$this->load->view('main/mypage', $data);
		$this->load->view('template/footer');
	}

	function mypage_proc () {
		$p_data = $this->input->post();
		$mb = member();
		
		switch($p_data['state']) {
			case 'pwchange':
				$origin_data = array(
					$mb['idx'],
					$p_data['origin_pw'],
				);

				$origin_pw = $this->M_member->get_origin_pw($origin_data);

				if (@$origin_pw < 1) {
					_error(_ERR_OPW_FAIL_);
				}

				$member = $this->M_member->get_pwCheck($p_data);

				if (@$member < 1) {
					_error(_ERR_PW_NOTMATCH_);
				}

				$update_ary = array(
					$p_data['pw'],
					$mb['idx'],
				);

				$pw_state = $this->M_member->update_pw($update_ary);

				if ($pw_state == 'success') {
					_success(_SUC_PW_CHANGE_);
				} else {
					_error(_ERR_PW_NOTCHANGE_);
				}
				break;

			case 'nickchange': 
				//유효 닉 체크
				$origin_nick = array(
					$p_data['re_nick'],					
				);		

				$member = $this->M_member->get_nickCheck($origin_nick);

				if (@$member['cnt'] > 0) {
					_error(_ERR_NICK_OVER_);
				}

				//닉체크 성공 시 닉 변경
				$update_ary = array(
					$p_data['re_nick'],
					$mb['idx'],
				);

				$nick_state = $this->M_member->update_nick($update_ary);

				if ($nick_state == 'success') {
					_success(_SUC_NICK_CHANGE);
				} else {
					_error(_ERR_NICK_NOTCHANGE_);
				}
				break;

			case 'searchPw':
				$id = $p_data['id'];
							
				$search_pw = $this->M_member->search_pw($id);

				if ($search_pw == 'success') {
					_success(_SUC_SEARCH_PW_);
				} else {
					_error(_ERR_SEARCH_PW_);					
				}
				break;

			case 'secession':
				$data = array(
					$mb['id'],
					$p_data['pw'],
				);
				$secession = $this->M_member->secession_data($data);

				if ($secession == 'success') {
					session_destroy();
					_success(_SUC_SECESSION_);					
				} else {
					_error(_ERR_SECESSION_FAIL_);
				}
				break;

			default:
				_error(_ERR_LOCATION_);
				break;
		}
	}
}