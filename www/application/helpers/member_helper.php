<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function member () {
	$member = array(
		'idx' => @$_SESSION['idx'],
		'id' => @$_SESSION['id'],
		'nickname' => @$_SESSION['nickname'],
	);

	return $member;
}