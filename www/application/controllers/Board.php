<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {
	function __construct () {
		parent::__construct();
		session_start();
		$this->load->model(array('M_board'));
	}

	function posts ($page = 1) {
		$p_data = $this->input->get(); //검색 값 받아오기
		
		//검색 및 페이징
		$page = (@$p_data['page']) ? $p_data['page'] : $page = 1 ;

		$p_data['search_post'] = (@$p_data['search_post']) ? $p_data[
			'search_post'] : ""; //초기 검색 없으면 전체 리스트 나오기		

			$limit = 6;
			$block = 5;
			$start = ($page - 1) * $limit;

		$total_cnt = $this->M_board->get_list_cnt($p_data['search_post']); //전체 게시판 글 수 
		$paging = paging($total_cnt, $page, $limit, $block); //helper로 페이징할 데이터 전송
		$w_sql = array(
			$start,
			$limit,
			$p_data['search_post'],

		);
		
		$list = $this->M_board->get_list($w_sql);		
		//view_cnt를 list에 담아서 같이 전송.
		foreach ($list as $key => $val) {
			$view_cnt = $this->M_board->get_view_count($val['idx']);
			$list[$key]['view_cnt'] = $view_cnt;
			$comment_cnt = $this->M_board->get_comment_count($val['idx']);
			$list[$key]['comment_cnt'] = $comment_cnt;
			$image_json = json_decode($list[$key]['image'], true);
			$list[$key]['image_ary'] = $image_json;

			$list[$key]['reg_date'] = date('y-m-d', strtotime($val['reg_date']));
			
		}
		$mb = member(); //로그인 시 글쓰기 위함			
		$data = array(
			'mb' => $mb,
			'list' => $list,
			'paging' => $paging,
			'search_post' => $p_data['search_post'],			
		);
		$hdata = array(
			'mb' => $mb,
		);	
		//header에 필요한 data만 넘기기.		
		$this->load->view('template/header', $hdata);		
		$this->load->view('posts/posts_list', $data);
		$this->load->view('template/footer');
	}

	function postDetail ($idx = '') {
		$row = $this->M_board->get_post($idx);
		$comment = $this->M_board->get_comment($idx);
		
		$ip = $_SERVER['REMOTE_ADDR']; //접속자의 ip 체크
		$now = date('Y-m-d');

		$w_sql = array(
			$idx,
			$ip,
			$now,
		);

		//게시글 삭제할때 필요한 닉네임 보내기
		$mb = member();
		$data = array(
			'mb' => $mb,
		);
		$nickname = $mb['nickname'];

		$this->M_board->set_view_count($w_sql);

		$view_cnt = $this->M_board->get_view_count($idx);

		$image_json = json_decode($row['image'], true);

		$row['image_ary'] = $image_json;
		
		//좋아요 개수 갖고오기
		$cnt_like = $this->M_board->get_like_count($idx);
		$hdata = array(
			'mb' => $mb,
		);	

		foreach ($comment as $key => $val) {
			$comment[$key]['reg_date'] = date('y-m-d', strtotime($comment[$key]['reg_date']));
		}
		$row['reg_date'] = date('y-m-d', strtotime($row['reg_date']));
		
		$data = array(
			'row' => $row,
			'comment' => $comment,
			'view_cnt' => $view_cnt,
			'nickname' => $nickname,
			'cnt_like' => $cnt_like,
		);				
		$this->load->view('template/header', $hdata);	
		$this->load->view('posts/posts_detail', $data);
		$this->load->view('template/footer');
	}

	function getMyPosts ($page = 1) {
		$p_data = $this->input->post();
		$mb = member();
		$data = array(
			'mb' => $mb,
		); 

		switch($p_data['state']) {
			case 'getMyPost': 
			$limit = 10;
			$block = 5;
			$start = ($page - 1) * $limit;

			$total_cnt = $this->M_board->get_myPost_cnt($mb['nickname']);

			$paging = paging($total_cnt, $page, $limit, $block);
			$w_sql = array (
				$start, 
				$limit,
				$mb['nickname'],
			);
			$list = $this->M_board->get_my_post($w_sql);				

			foreach ($list as $key => $val) {
				$view_cnt = $this->M_board->get_view_count($val['idx']);
				$list[$key]['view_cnt'] = $view_cnt;			
			}
			$data = array (
				'list' => $list,
				'paging' => $paging
			);				

			if (@$data > 0) {					
				json_result($data);
			} else {
				_error(_ERR_LOCATION_);
			}
			break;

			case 'getMyComment': 
			$row = $this->M_board->get_my_comment($mb['nickname']);

			if (@$row > 0) {					
				json_result($row);
			} else {
				_error(_ERR_LOCATION_); 					
			}
			break;

			default:
			_error(_ERR_LOCATION_);  
			break;
		}
	}

	function writePosts () {
		$mb = member();

		$data = array(
			'mb' => $mb,
		);
		$this->load->view('template/header', $data);
		$this->load->view('posts/writePosts', $data);
		$this->load->view('template/footer');
	}

	function post_proc () {
		$p_data = $this->input->post();	
		$mb = member();
		$data = array(
			'mb' => $mb
		);
		
		switch($p_data['state']) {
			case 'postWrite':
			$userDir = $_SERVER['DOCUMENT_ROOT'].'/common/img';

				$config['upload_path'] = $userDir; //업로드 파일이 위치할 폴더 경로 .폴더는 쓰기 가능해야하며 경로는 절대경로 혹은 상대경로를 사용합니다.
				$config['allowed_types'] = 'gif|jpg|jpeg|png'; //업로드를 허용할 파일의 마임타입(mime types)을 설정합니다. 보통 파일 확장자는 마임타입으로 사용될 수 있습니다. 멀티플타입은 파이프를 이용하여 구분합니다.
				$config['encrypt_name'] = true; //TRUE로 설정하면 파일이름은 랜덤하게 암호화된 문자열로 변합니다. 파일을 업로드한 사람이 파일명을 알수 없도록할 때 유용합니다

				$this->load->library('upload', $config);
				
				//이미지 파일 업로드 안하는 경우
				if (!$this->upload->do_upload("files")) {
					$p_data['file'] = (@$p_data['file']) ? $p_data['file'] : "";
					//json_result(array('error' => $this->upload->display_errors()));
				} else {
					$data = $this->upload->data();
					$image = array(
						'full_path' => $data['full_path'],//파일이름까지 포함한 서버상의 절대경로입니다.
						'file_name' => $data['file_name'], //설정해주면, CodeIgniter 는 업로드된 파일을 이 이름으로 변경할 것입니다. 파일 확장자는 반드시 허용된 확장자이어야 합니다. 만약 제공되지 않는 확장자라면, 원래 파일명이 사용될 것입니다.
						'real_name' => $data['orig_name'],
						'file_path' => '/common/img/'.$data['file_name'], //파일의 서버상 절대경로입니다.
					);

					$p_data['image'] = json_encode($image, JSON_UNESCAPED_UNICODE);
				}

				$post = $this->M_board->set_post($p_data);

				if (!@$post) {
					alert('글 작성에 실패했습니다. \n 다시 시도해 주세요.', './posts');
					exit();
				} else {
					alert('글 작성에 성공했습니다.', './posts');
					exit();
				}
				break;

			case 'commentDel':	
				$arr = $_POST['commentList'];
				$del_state = '';
				$del_text = '';
				$del_success = 0;
				$del_failed = 0;				
				for($i=0; $i<sizeof($arr); $i++){
					$del_state = $this->M_board->del_comment($arr[$i]);
					
					if($del_state == 'success') $del_success++;
					else $del_failed++;
				}
				if ($del_failed < 1) {
					$del_text = $del_success.'개 댓글 삭제에 성공했습니다.';	
				} else {
					$del_text = $del_success.'개 댓글 삭제 성공, '.$del_failed.'개 댓글 삭제에 실패했습니다. \n 다시 시도해 주세요.';					
				}
				alert($del_text, './posts');
				break;

			case 'editPost':				
				var_dump($p_data);
				exit();
				$editPost = $this->M_board->edit_post($p_data);
				break;

			case 'likePost':				
				$data = array(
					'posts_idx' => $p_data['posts_idx'],
					'member_idx' => $mb['idx'],
				);
				//먼저 좋아요했는지 확인
				$checkLike_id = $this->M_board->checkLike_post($data);

				//기존 좋아요가 존재하면 삭제
				if($checkLike_id) {
					$del_like = $this->M_board->del_like($data);							
				//없으면 좋아요 1 추가 	
				} else {
					$like_id = $this->M_board->like_post($data);					
				}	
				$cnt_like = $this->M_board->get_like_count($data['posts_idx']);
				json_result($cnt_like);				
				break;
			default :
				_error(_ERR_LOCATION_);
				break;
			}

		}

	//글 수정
		function post_edit ($idx = '') {		
			$mb = member();

			$row = $this->M_board->get_post($idx);
			$hdata = array(
				'mb' => $mb,
			);	
			$data = array(	
				'mb' => $mb,
				'row' => $row,
			);		
			$this->load->view('template/header', $hdata);
			$this->load->view('posts/post_edit', $data);
			$this->load->view('template/footer');
		}

	//글 삭제
		function posts_del ($idx = '') {
			$mb = member();
			
		//본인글만 삭제 가능 혹은 관리자
			$data = array(	
				'nickname' => $mb['nickname'],
				'idx' => $idx,
			);		

			$result = $this->M_board->del_post($data);

			if($result == 'success') {
				alert('게시글 삭제 성공', '../posts');
			} else {
				alert('게시글 삭제 실패', './postDetail/'.$data['idx']);
			}
		}

		function posts_comment () {
			$mb = member();
			$data = array(
				'nickname' => $mb['nickname'], 
				'idx' => $this->input->post('idx'),
				'comment' => $this->input->post('comment'),
				'now' => date('Y-m-d'),
			);
			$last_id = $this->M_board->set_comment($data);

			if($last_id) {
				alert('댓글 등록 성공', './postDetail/'.$data['idx']);
			} else {
				alert('댓글 등록 실패', './postDetail/'.$data['idx']);
			}
		}

	}