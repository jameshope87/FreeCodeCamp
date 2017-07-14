<?php
$secretKey = "6Ldj5SgUAAAAAAVlYJq8OHmR1B12WZkq-Vsy_yER";
?>

if(mail($to, $subject, $body, $from)) {
                $result='<div class="alert alert-success">Thank you! I will be in touch</div>';
            } else {
                $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
            }