<?php
	session_start();
	if (!isset($_POST['check_captcha'])) {
		header('Content-Type: image/png');
		$chars = array();
		$font = 'CarbonPhyber.ttf';
		$font_size = 14;
		$width = 130;
		$height = 27;
		$alphabet = array('a','A','c','C','d','D','e','E','f','F','g','G','h','H','j','J','m','M','n','N','p','P','r','R','s','S','t','T','v','V','w','W','Y','y','z','Z','2','3','4','5','6','7','9');

		$img = imagecreate($width, $height);
		$bg = imagecolorallocate($img, 250, 250, 250); 
		imageRectangle($img,1,1,$width-2,$height-2,imagecolorallocate($img, 0, 0, 0));

		for ($i=0; $i<5;$i++) {
			$angle = mt_rand(0,30);
			$char = $alphabet[mt_rand(0,count($alphabet))];
			$chars[] = strtolower($char);
			imageTTFText($img, $font_size, $angle,$font_size*$i+30, ($height+$font_size)/2, imagecolorallocate($img, 0, 0, 0), $font, $char);
		}

		$_SESSION['code'] = implode("",$chars);
		imagepng($img);
	} else {
		if (strtolower($_POST['check_captcha']) == strtolower($_SESSION['code'])) {
			echo true;
		} else {
			echo false;
		}
	}
?>