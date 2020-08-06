<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function paging($total_cnt, $n_page, $limit, $block) {

	$start = ($n_page - 1) * $limit; //페이지 시작
	$total_page = ceil($total_cnt / $limit); // 글 개수에서 10개씩 나눈걸 반올림하면 표시할 총 페이지 수가 나옴.
	$total_block = ceil($total_page / $block); //총 페이지 수를 보여줄 블럭 수만큼으로 나눈 개수.
	$n_block = ceil($n_page / $block); // 5개씩 나눈 블럭의 몇번째인지 위치. 1부터 시작
	$s_page = ($n_block * $block) - ($block - 1); // 첫번째 블럭 1,2,3,4,5면 블럭의 1부터 시작. 다음 페이지 버튼 눌렀을때, s_page가 시작이 된다. 
	if($s_page < 1) $s_page = 1;

	$e_page = ($n_block * $block); //그 블럭의 제일 끝번이 마지막 페이지임. 1,2,3,4,5 중 5를 의미. 
	if($e_page >= $total_page) $e_page = $total_page;
	
	$ary = array(
		's_page' => $s_page,
		'e_page' => $e_page,
		'start' => $start,
		'n_page' => $n_page,
		'n_block' => $n_block,
		'total_page' => $total_page,
		'total_block' => $total_block
	);
	return $ary;
}	

function paging_html($total_cnt, $n_page, $limit, $block) {

	$start = ($n_page - 1) * $limit; //페이지 시작
	$total_page = ceil($total_cnt / $limit); // 글 개수에서 10개씩 나눈걸 반올림하면 표시할 총 페이지 수가 나옴.
	$total_block = ceil($total_page / $block); //총 페이지 수를 보여줄 블럭 수만큼으로 나눈 개수.
	$n_block = ceil($n_page / $block); // 5개씩 나눈 블럭의 몇번째인지 위치. 1부터 시작
	$s_page = ($n_block * $block) - ($block - 1); // 첫번째 블럭 1,2,3,4,5면 블럭의 1부터 시작. 다음 페이지 버튼 눌렀을때, s_page가 시작이 된다. 
	if($s_page < 1) $s_page = 1;

	$e_page = ($n_block * $block); //그 블럭의 제일 끝번이 마지막 페이지임. 1,2,3,4,5 중 5를 의미. 
	if($e_page >= $total_page) $e_page = $total_page;
	
	$ary = array(
		's_page' => $s_page,
		'e_page' => $e_page,
		'start' => $start,
		'n_block' => $n_block,
		'total_page' => $total_page,
		'total_block' => $total_block
	);	

	$html = '<ul>';
	for($i=1; $i<=$total_page; $i++) {
		$html .= '<li><a href="./posts/'.$i.'">'.$i.'</a></li>';
	}
	$html .= '</ul>';
	return $html;	
}