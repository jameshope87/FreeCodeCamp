<?php
        $name;$email;$phone;$comment;$captcha;
        if(isset($_POST['name'])){
          $name=$_POST['name'];
        }
        if(isset($_POST['email'])){
          $email=$_POST['email'];
        }
        if(isset($_POST['phone'])){
          $phone=$_POST['phone'];
        }
        if(isset($_POST['message'])){
          $message=$_POST['message'];
        }
        if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the captcha form.</h2>';
          exit;
        }
        $secretKey = "	6Ldj5SgUAAAAAAVlYJq8OHmR1B12WZkq-Vsy_yER";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
          echo '<h2>Robot Detected!</h2>';
        } else {
          echo '<h2>Thanks for posting comment.</h2>';
        }
?>