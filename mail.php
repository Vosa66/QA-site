<?php

include_once('config.php');


$to_email = 'vjosaislami26@outlook.com';
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: noreply@company.com';

mail($to_email,$subject,$message,$headers);

?>
