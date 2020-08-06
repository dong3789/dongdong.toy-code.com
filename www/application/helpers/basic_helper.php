
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function alert ($msg, $url = '') {
	if (!@$url) $url = './main';
	$location = 'location.href="'.$url.'";';

	if ($url == 'back') $location = 'history.back();';

	echo '<script>alert("'.$msg.'");'.$location.'</script>';
	// if($url == 'back') {

	// 	echo "<script>alert('".$msg."');history.back();</script>";
	// } else {
	// 	echo "<script>alert('".$msg."');location.href='".$url."'</script>";
	// }
	
}



// function alert2 ($msg, $url = '') {
// 	if (!@$url) $url = './main';

// 	echo "<script>swal('".$msg."');location.href='".$url."'</script>";
// }

// function alert2 ($msg, $url = '') {
// 	echo "<script>alert('".$msg."');history.back();</script>";
// }

function msg ($msg) {
	echo "<pre>";
	print_r($msg);
	echo "</pre>";
}

function json_result ($data = array()) {
	$output = json_encode($data, JSON_UNESCAPED_UNICODE);
	echo $output;	
	exit();
}
