<?php
$name = $_POST['Name'];
$telephone = $_POST['telephone'];
$email = $_POST['InputEmail'];
$message = $_POST['InputMessage'];
?>

<?php
function IsInjected($str)
{
    $injections = array(
        '(\n+)',
        '(\r+)',
        '(\t+)',
        '(%0A+)',
        '(%0D+)',
        '(%08+)',
        '(%09+)'
    );

    $inject = join('|', $injections);
    $inject = "/$inject/i";

    if (preg_match($inject, $str)) {
        return true;
    } else {
        return false;
    }
}

if (IsInjected($email)) {
    echo "Bad email value!";
    exit;
}
?>

<?php
$email_from = 'no-reply@mamasite.ru';

$email_subject = "Тебе оставили сообщение на сайте";

$email_body = "На консультацию записалась $name.\n" .
    "Номер телефона:$telephone, адрес $email. Оставили сообщение:\n $message";
?>

<?php

$to = "vlad-belichenkov@mail.ru";

$headers = "From: $email_from \r\n";

$headers .= "Reply-To: $email \r\n";

mail($to, $email_subject, $email_body, $headers);

?>