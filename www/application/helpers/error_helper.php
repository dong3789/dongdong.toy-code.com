<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//코드가 넘어오면 해당 에러를 출력한다. 

function _error ($msg) {
	$ary = array();

	switch ($msg) {
		case 'id_over':
			$ary = array(
				'result' => 'fail',
				'code' => 'id_over',
				'message' => '이미 존재하는 아이디입니다.',
			);
			break;

		case 'nick_over':
			$ary = array(
				'result' => 'fail',
				'code' => 'nick_over',
				'message' => '이미 존재하는 닉네임입니다.',
			);
			break;
		case 'pw_insert':
			$ary = array(
				'result' => 'fail',
				'code' => 'pw_insert',
				'message' => '비밀번호를 입력하세요.',
			);
			break;
		case 'pw_fail':
			$ary = array(
				'result' => 'fail',
				'code' => 'pw_fail',
				'message' => '비밀번호가 일치하지 않습니다.',
			);
			break;
		case 'origin_pw_fail':
			$ary = array(
				'result' => 'fail',
				'code' => 'origin_pw_fail',
				'message' => '기존 비밀번호가 일치하지 않습니다.',
			);
			break;
		case 'pw_change_fail':
			$ary = array(
				'result' => 'fail',
				'code' => 'pw_change_fail',
				'message' => '비밀번호가 변경에 실패하였습니다.\n잠시후 다시 시도해 주세요.',
			);
			break;				
		case 'nick_change_fail':
			$ary = array(
				'result' => 'fail',
				'code' => 'nick_change_fail',
				'message' => '닉네임 변경에 실패하였습니다.\n잠시후 다시 시도해 주세요.',
			);
			break;
		case 'search_pw_fail':
			$ary = array(
				'result' => 'fail',
				'code' => 'search_pw_fail',
				'message' => '비밀번호가 변경에 실패하였습니다.\n잠시후 다시시도해 주세요.',
			);
			break;		
		case 'secession_fail':
			$ary = array(
				'result' => 'fail',
				'code' => 'secession_fail',
				'message' => '탈퇴에 실패했습니다. \n잠시후 다시시도해 주세요.',
			);
			break;	
		case 'abnormal_access':
			$ary = array(
				'result' => 'fail',
				'code' => 'abnormal_access',
				'message' => '정상적인 접근이 아닙니다.',
			);
			break;			
									
		default:
				$ary = array(
					'result' => 'l_fail',
					'message' => '잘못된 접근경로입니다.',
				);
				json_result($ary);
				break;			
	}	

	json_result($ary);
}


//성공
function _success ($msg) {
	$ary = array();

	switch ($msg) {
		case 'id_sign':
			$ary = array(
				'result' => 'success',
				'code' => 'id_sign',
				'message' => '<span class="sign_join">사용 가능한 아이디입니다.</span>',
			);
			break;
		case 'nick_sign':
			$ary = array(
				'result' => 'success',
				'code' => 'nick_sign',
				'message' => '<span class="sign_join">사용 가능한 닉네임입니다!</span>',
			);
			break;
		case 'pw_check':
			$ary = array(
				'result' => 'success',
				'code' => 'pw_check',
				'message' => '<span class="sign_join">비밀번호가 일치합니다.</span>',
			);
			break;
		case 'pw_change':
			$ary = array(
				'result' => 'success',
				'code' => 'pw_change',
				'message' => '비밀번호 변경에 성공했습니다.',
			);
			break;
		case 'nick_change':
			$ary = array(
				'result' => 'success',
				'code' => 'nick_change',
				'message' => '닉네임이 변경되었습니다.',
			);
			break;
		case 'search_pw':
			$ary = array(
				'result' => 'success',
				'code' => 'search_pw',
				'message' => '비밀번호가 변경되었습니다. 비밀번호는 \'1234\' 입니다.',
			);
			break;
		case 'secession_success':
			$ary = array(
				'result' => 'success',
				'code' => 'secession_success',
				'message' => '성공적으로 탈퇴했습니다.',
			);
			break;

		case 'success_post':
			$ary = array(
				'result' => 'success',
				'code' => 'success_post',
				'message' => '개 글을 삭제 성공했습니다.',
			);
			break;	

		case 'success_like':
			$ary = array(
				'result' => 'success',
				'code' => 'success_like',
				'message' => '좋아요',
			);
			break;	
			
		default:
			$ary = array(
				'result' => 'l_fail',
				'message' => '잘못된 접근경로입니다.',
			);
			json_result($ary);
			break;	
	}	
	json_result($ary);
}
