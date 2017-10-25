<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>订阅信息</title>
    <style>
        html {
            padding: 50px 10px;
            font-size: 16px;
            line-height: 1.4;
            color: #666;
            background: #F6F6F3;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        html,
        input { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; }
        body {
            max-width: 500px;
            _width: 500px;
            padding: 30px 20px;
            margin: 0 auto;
            background: #FFF;
        }
        ul {
            padding: 0 0 0 40px;
        }
        .container {
            max-width: 380px;
            _width: 380px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $themeUrl = $_POST['themeUrl'];
        require ''.$themeUrl.'PHPMailerAutoload.php';

        $mail = new PHPMailer();

        $mail->isSMTP();// 使用SMTP服务
        $mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
        $mail->Host = "smtp.163.com";// 发送方的SMTP服务器地址
        $mail->SMTPAuth = true;// 是否使用身份验证
        $mail->Username = "ihewro@163.com";// 发送方的163邮箱用户名
        $mail->Password = "hewro19980801";// 发送方的邮箱密码，注意用163邮箱这里填写的是“客户端授权密码”而不是邮箱的登录密码！
        $mail->SMTPSecure = "ssl";// 使用ssl协议方式
        $mail->Port = 465;// 163邮箱的ssl协议方式端口号是465/994
        $mail->isHTML(true);

        $mail->setFrom("ihewro@163.com","Mailer");// 设置发件人信息，如邮件格式说明中的发件人，这里会显示为Mailer(xxxx@163.com），Mailer是当做名字显示
        $mail->addAddress("ihewro@163.com");// 设置收件人信息，如邮件格式说明中的收件人，这里会显示为Liang(yyyy@163.com)
        $mail->addReplyTo("ihewro@163.com");// 设置回复人信息，指的是收件人收到邮件后，如果要回复，回复邮件将发送到的邮箱地址
        $name = $_POST['name'];
        $phoneNumber = $_POST['phoneNumber'];
        $message = $_POST['message'];
        $permalink = $_POST['permalink'];
        $title = $_POST['title'];
        $msg = '  <div class="nui-fClear sR0">
   <br />
   <table style="width: 99.8%;height:99.8% ">
    <tbody>
     <tr>
      <td style="background:#FAFAFA">
       <div style="background-color:white;border-left: 2px solid #555555;box-shadow:0 1px 3px #AAAAAA;line-height:180%;padding:0 15px 12px;width:500px;margin:50px auto;color:#555555;font-family:\'Century Gothic\',\'Trebuchet MS\',\'Hiragino Sans GB\',微软雅黑,\'Microsoft Yahei\',Tahoma,Helvetica,Arial,\'SimSun\',sans-serif;font-size:12px;">
        <h2 style="border-bottom:1px solid #DDD;font-size:14px;font-weight:normal;padding:13px 0 10px 8px;"><span style="color: #f59200;font-weight: bold;">&gt; </span>您的博客有新的预约通知！ </h2>
        <div style="padding:0 12px 0 12px;margin-top:18px">
         <p>有客户在活动文章《'.$title.'》上提交了预约信息:</p>
         <div style="background-color: #f5f5f5;border: 0px solid #DDD;padding: 10px 15px;margin:18px 0">
             <ul>
                 <li><p>客户姓名：'.$name.' <br/></p></li>
                 <li><p>客户手机号码：'.$phoneNumber.'<br/></p></li>
                 <li><p>客户留言：'.$message.'<br/></p></li>
             </ul>
         </div>
         <p>您可以点击 <a style="text-decoration:none; color:#f59200" href="'.$permalink.'">查看活动文章详细内容 </a>。</p>
        </div>
       </div> </td>
     </tr>
    </tbody>
   </table>
   <br />
   <br />
  </div>
';
        $mail->Subject = '有客户在活动文章《'.$title.'》上提交了预约信息';// 邮件标题
        $mail->Body = $msg;// 邮件正文

        if(!$mail->send()){// 发送邮件
            echo '尊敬的<strong>'.$name.'</strong>,您已成功提交预约信息，我们会尽快联系您';
        }else{
            echo '尊敬的<strong>'.$name.'</strong>,您已成功提交预约信息，我们会尽快联系您';
        }
        ?>
    </div>
</body>
</html>