<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sender</title>
</head>

<body>
    <form method="POST">
        <input type="submit" name="send" value="Send Email">
    </form>

    <?php
    if (isset($_POST['send'])) {
        require 'PHPMailer-master/src/Exception.php';
        require 'PHPMailer-master/src/PHPMailer.php';
        require 'PHPMailer-master/src/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            // Cấu hình server SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Server SMTP của Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'mailleduc05122004@gmail.com'; // Tài khoản SMTP (email người gửi)
            $mail->Password = 'guezbvjtsdwubjlt'; // Mật khẩu SMTP (App Password của Gmail)
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;

            // Thông tin người gửi
            $mail->setFrom('mailleduc05122004@gmail.com', 'Mailer'); // Email người gửi phải trùng với tài khoản SMTP

            // Thông tin người nhận
            $mail->addAddress('leduc2004lienquan@gmail.com', 'Joe User'); // Người nhận chính
            $mail->addAddress('leduc2004lienquan@gmail.com'); // Người nhận chính khác
            $mail->addReplyTo('leduc2004lienquan@gmail.com', 'Information');
            $mail->addCC('leduc2004lienquan@gmail.com'); // Người nhận CC
            $mail->addBCC('leduc2004lienquan@gmail.com'); // Người nhận BCC

            // File đính kèm (kiểm tra file có tồn tại không)
            // $mail->addAttachment('/var/tmp/file.tar.gz'); // Bỏ comment nếu file tồn tại
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Bỏ comment nếu file tồn tại

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'Here is the subject';
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent successfully';
        } catch (Exception $e) {
            echo "Failed to send message. Error: {$mail->ErrorInfo}";
        }
    }
    ?>
</body>

</html>