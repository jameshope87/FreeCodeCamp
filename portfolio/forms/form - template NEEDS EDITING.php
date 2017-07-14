<?php



  
  //Only process POST requests
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Get the form fields
    $name = strip_tags(trim($_POST["name"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);
    $captcha=$_POST['g-recaptcha-response'];
    
  if(empty($captcha)) {
    http_response_code(400);
    echo "Oops! It doesn't look like you have ticked the ReCaptcha box...";
    exit;
  }
    // ENTER YOUR SECRET RECAPTCHA KEY BELOW
    $secretKey = "***************";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $responseKeys = json_decode($response,true);

  if ( empty($name) OR empty($message) OR empty($email)) {
      // Set a 400 (Bad response) code and exit
      http_response_code(400);
      echo "Oops! There was a problem with your submission. Please check all the inputs are valid and try again.";
      exit;
    }
  if (intval($responseKeys['success']) == 1) {
    //Set recipient email address
    //ENTER YOUR EMAIL ADDRESS BELOW
    $recipient = "hello@hello.co.uk";
    
    // Set email subject
    $subject = 'New Message from Jhopechemistry.co.uk';
    
    //Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Message:\n$message\n";
    
    //Build the email headers
    $email_headers = "From: $name <$email>";
    
    //Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
      //Set a 200 (ok) response code
      http_response_code(200);
      echo "Thank You! Your message has been sent and I look forward to replaying soon";
    } else {
      //Set a 500 (server error) response code
      http_response_code(500);
      echo "Oops! Something went wrong with your submission";
    }
    } else {
      http_response_code(400);
      echo "Oops! It seems you have triggered the spam detection, this is unusual.";
      exit;
    }

  } else {
    //Not a POST request, set a 403 (forbidden) response code
    http_response_code(403);
    echo "Oops! Something went wrong with your submission";
  }


