<?php
    if (isset($_POST['submit'])) {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $message=$_POST['message'];
        $captcha=$_POST['g-recaptcha-response'];
        $secretKey = "6Ldj5SgUAAAAAAVlYJq8OHmR1B12WZkq-Vsy_yER";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        $from = 'Portfolio Contact Form';
        $to = 'james@jhopechemistry.co.uk';
        $subject = 'New Message from Jhopechemistry.co.uk';
        $body = "From: $name\nE-Mail: $email\nMessage: $message";
        if(!$errName && !$errEmail && !$errHuman && intval($responseKeys["success"]) == 1) {
            if (mail ($to, $subject, $body, $from)) {
                $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
            } else {
                $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
            }
        }
}
?>