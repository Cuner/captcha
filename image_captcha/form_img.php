<?php
header("Content-Type: text/html; charset=utf-8");
if (isset($_REQUEST['authcode'])) {
    session_start();
    if (strtolower($_REQUEST['authcode']) == strtolower($_SESSION['authcode'])) {
        echo '<font color ="#0000cc"><b>输入正确</b></font>';
    } else {
        echo '<font color =red><b>输入错误</b></font>';
    }
    exit();
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>确认验证码</title>
    </head>

    <body>
        <form action="form.php" method="post">
            验证码图片：
            <img id="captcha_img" border="1" src="./CAPTCHA_img.php?r=<?php echo rand(); ?>" width="200px" height="200px"/>
            <a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='./CAPTCHA_img.php?r='+Math.random()">换一个？</a><br/>
            请输入图片内容：
            <input type="text" name="authcode"><br/>
            <input type="submit">
        </form>
    </body>
</html>

