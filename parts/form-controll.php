<?php

mb_internal_encoding('UTF-8');

if ($_POST) {
  require('constant.php');

  $name      = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
  $email     = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $phone     = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
  $content   = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
  $subject   = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);

/*   foreach ($_POST as $key => $value) {
    echo '<p><strong>' . $key.':</strong> '.$value.'</p>';
  } */
  

  //reCAPTCHA validation
  if (isset($_POST['g-recaptcha-response'])) {

    require('recaptcha/src/autoload.php');

    $recaptcha = new \ReCaptcha\ReCaptcha($SECRET_KEY);

    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

    if (!$resp->isSuccess()) {
/*       $output = json_encode(array('type' => 'error', 'text' => '<b>Captcha</b> Validation Required!'));
      die($output); */
      echo 'Success! Thanks for submitting';
    }
  }



  $mailTo = $SENDER_EMAIL;
  $headers = "From: " . $email;
  $txt = "Formulario de " . $name . ".\n\nTeléfono " . $phone . "\n\n" . $message;

  mail($mailTo, $subject, $txt, $headers);
  // Cambios solicitados acá
/*   $namelog = date("Ymd");
  $ip = get_ip_address();
  $ua = $_SERVER['HTTP_USER_AGENT'];
  $hora = date("d-m-Y H:i:s"); */

 /*  $arr = array($hora, $ip, $ua, $name, $phone, $email, $subject, $message);
  $contacto = implode("\t", $arr) . "\n";
  file_put_contents($namelog, $contacto, FILE_APPEND | LOCK_EX); */
  // Fin de cambios

  /* header("Location: parts/gracias.php"); */
}
