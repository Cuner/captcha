<?php
session_start();
$captcha_code = '';//全局变量用于存储验证码内容

$image = imagecreatetruecolor(100,30);//新建画布
$bgcolor = imagecolorallocate($image,250,250,200);//画布背景颜色
imagefill($image,0,0,$bgcolor);//填充画布

for($i=0;$i<4;$i++){
	$frontsize  = 6;
	$frontcolor = imagecolorallocate($image,rand(30,80),rand(30,80),rand(30,80));
	$data = 'abcdefghijkmnpqrstuvwxyABCDEFGHIJKLMNPQRSTUVWXY3456789';
	$frontcontent = substr($data,rand(0,strlen($data)-1),1);//字母数字混合
	$captcha_code .= $frontcontent;
	//$frontcontent = rand(0,9);//数字
	$x = ($i*100/4+rand(5,10));
	$y = rand(5,10);
	imagestring($image,$frontsize,$x,$y,$frontcontent,$frontcolor);
}//画布内容（随机码）
$_SESSION['authcode'] = $captcha_code;

for($i = 0;$i<200;$i++){
	$pointcolor = imagecolorallocate($image,rand(50,200) ,rand(50,200) ,rand(50,200));
	imagesetpixel($image, rand(1,99), rand(1,29), $pointcolor);
}//添加干扰点

for($i = 0;$i<3;$i++){
	$linecolor = imagecolorallocate($image,rand(80,220) ,rand(80,220) ,rand(80,220));
	imageline($image, rand(1,99), rand(1,29), rand(1,99), rand(1,29),$linecolor);
}//添加干扰线

header('content-type: image/png');
imagepng($image);
imagedestroy($image);
