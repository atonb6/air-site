<?php

// grab recaptcha library
require_once "parts/recaptchalib.php";
// your secret key
$secret = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
// empty response
$response = null;
// check secret key
$reCaptcha = new ReCaptcha($secret);

$name = $email = $subject = $phone = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $phone = test_input($_POST["phone"]);
  $subject = test_input($_POST["subject"]);
  $message = test_input($_POST["message"]);

  $response = $reCaptcha->verifyResponse(
      $_SERVER["REMOTE_ADDR"],
      $_POST["g-recaptcha-response"]
  );

}


if ($response != null && $response->success) {
  
  $mailTo = "contacto@philippeparis.net";
  $headers = "From: " . $email;
  $txt = "Formulario de " . $name . ".\n\nTeléfono " . $phone . "\n\n" . $message;
  
  mail($mailTo, $subject, $txt, $headers);
  // Cambios solicitados acá
  $namelog = date("Ymd") . ".csv";
  $ip = get_ip_address();
  $ua = $_SERVER['HTTP_USER_AGENT'];
  $hora = date("d-m-Y H:i:s");
  
  $arr = array($hora, $ip, $ua, $name, $phone, $email, $subject, $message);
  $contacto = implode("\t", $arr) . "\n";
  file_put_contents($namelog, $contacto, FILE_APPEND | LOCK_EX);
  // Fin de cambios
  header("Location: ../gracias.php");


} else {

  echo ('falló');

}


?>