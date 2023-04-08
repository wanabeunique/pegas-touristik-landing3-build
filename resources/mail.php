<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

$title = "Заявка с сайта";
$file = $_FILES['file'];


if (isset($_POST['q1'])){
  $ans1 = $_POST['q1'];
  $ans2 = $_POST['q2'];
}

$name = $_POST['name'];
$tel = $_POST['tel'];
$question = $_POST['question'];

$c = true;
// Формирование самого письма
$title = "Заявка с сайта";
// foreach ( $_POST as $key => $value ) {
//   if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
//     $body .= "
//     " . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
//       <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
//       <td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
//     </tr>
//     ";
//   }
// }

$body = "<table style='width: 100%;'>$body</table>";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();

try {
  $mail->isSMTP();
  $mail->CharSet = "UTF-8";
  $mail->SMTPAuth   = true;

  // Настройки вашей почты
  $mail->Host       = 'smtp.mail.ru'; // SMTP сервера вашей почты
  $mail->Username   = ''; // Логин на почте
  $mail->Password   = ''; // Пароль на почте
  $mail->SMTPSecure = 'ssl';
  $mail->Port       = 465;

  $mail->setFrom('', 'Заявка с вашего сайта'); // Адрес самой почты и имя отправителя

  // Получатель письма
  $mail->addAddress('');

  // Прикрипление файлов к письму
  // if (!empty($file['name'][0])) {
  //   for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
  //     $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
  //     $filename = $file['name'][$ct];
  //     if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
  //         $mail->addAttachment($uploadfile, $filename);
  //         $rfile[] = "Файл $filename прикреплён";
  //     } else {
  //         $rfile[] = "Не удалось прикрепить файл $filename";
  //     }
  //   }
  // }

  $body = "
  <tr>
    <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Имя пользователя: $name </b></td>
    <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Телефон: $tel </b></td>
    <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Ответы на 1 вопрос: $ans1 </b></td>
    <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Ответы на 2 вопрос: $ans2 </b></td>
    <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Вопрос: $question </b></td>
  </tr>
 ";

 if (!isset($_POST['q1'])){
  $body = "
  <tr>
    <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Имя пользователя: $name </b></td>
    <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Телефон: $tel </b></td>
    <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>Вопрос: $question </b></td>
  </tr>
 ";
 }

 $body = "<table style='width: 100%;'>$body</table>";
  // Отправка сообщения
  $mail->isHTML(true);
  $mail->Subject = $title;
  $mail->Body = $body;

  $mail->send();

  $mail->addAddress('');
  $mail->send();

  header('location: ./../index.html');
} catch (Exception $e) {
  $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}
