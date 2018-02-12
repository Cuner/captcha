<?php
session_start();

$image = imagecreatetruecolor(200, 60);//新建画布
$bgcolor = imagecolorallocate($image, 250, 250, 200);//画布背景颜色
imagefill($image, 0, 0, $bgcolor);//填充画布

$fontface = 'STXINWEI.TTF';
$strdb = array('小', '桥', '哈', '呵', '狗', '鸡', '验', '证', '码', '字', '体', '库');//验证码字体库
$captcha_code = '';//全局变量用于存储验证码内容
for ($i = 0; $i < 4; $i++) {
    $fontcolor = imagecolorallocate($image, rand(30, 80), rand(30, 80), rand(30, 80));
    $cn = $strdb[rand(0, 11)];
    $captcha_code .= $cn;
    imagettftext($image, mt_rand(20, 24), mt_rand(-60, 60), (40 * $i + 20), mt_rand(30, 35), $fontcolor, $fontface, $cn);
}//画布内容（中文）
$_SESSION['authcode'] = $captcha_code;

for ($i = 0; $i < 200; $i++) {
    $pointcolor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
    imagesetpixel($image, rand(1, 199), rand(1, 59), $pointcolor);
}//添加干扰点

for ($i = 0; $i < 3; $i++) {
    $linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
    imageline($image, rand(1, 199), rand(1, 59), rand(1, 199), rand(1, 59), $linecolor);
}//添加干扰线

header('content-type: image/png');
imagepng($image);
imagedestroy($image);
