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

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Cambios solicitados acá
function get_ip_address()
{
  foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
    if (array_key_exists($key, $_SERVER) === true) {
      foreach (explode(',', $_SERVER[$key]) as $ip) {
        $ip = trim($ip); // just to be safe

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
          return $ip;
        }
      }
    }
  }
}
// Fin de cambios


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
header("Location: /gracias.php");
echo "llegó";
echo "Hi " . $_POST["name"] . " (" . $_POST["email"] . "), thanks for submitting the form!";

?>