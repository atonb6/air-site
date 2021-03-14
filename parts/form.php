<?php

// grab recaptcha library
require_once "recaptchalib.php";


// your secret key
$secret = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);


// if submitted check response
if ($_POST["g-recaptcha-response"]) {
  $response = $reCaptcha->verifyResponse(
      $_SERVER["REMOTE_ADDR"],
      $_POST["g-recaptcha-response"]
  );
}


$name = $email = $subject = $phone = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["name"])) {
    $nameErr = "El nombre es requerido";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
      $nameErr = "Sólo letras y espacios permitidos";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "El email es requerido";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Formateo invalido";
    }
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "El teléfono es requerido";
  } else {
    $phone = test_input($_POST["phone"]);
    if (!filter_var($phone, FILTER_VALIDATE_EMAIL)) {
      $phoneErr = "Formateo de teléfono invalido";
    }
  }

  if (empty($_POST["subject"])) {
    $subjectErr = "Debe agregar un asunto";
  } else {
    $subject = test_input($_POST["subject"]);
  }

  if (empty($_POST["message"])) {
    $messageErr = "Debe agregar un mensaje";
  } else {
    $message = test_input($_POST["message"]);
  }

  if ($response != null && $response->success) {
    echo "Hi " . $_POST["name"] . " (" . $_POST["email"] . "), thanks for submitting the form!";
  } else {
    
  }
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
header("Location: gracias.html");

?>


<form class="contact-form recaptchaForm" action="parts/form.php" method="post">
  <div class="section section-contact-us text-center" id="contacto">
    <div class="container">
      <h2 class="title">Cotiza con nosotros</h2>
      <p class="description">Tus proyectos de hogar u oficina son muy importante para nosotros.</p>
      <div class="row">
        <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">
          <div class="input-group input-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <!-- <i class="now-ui-icons users_circle-08"></i> -->
              </span>
            </div>
            <input class="form-control" type="text" name="name" placeholder="Nombre y apellido..." required>
          </div>
          <div class="input-group input-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <!-- <i class="now-ui-icons users_circle-08"></i> -->
              </span>
            </div>
            <input class="form-control" type="text" name="subject" placeholder="Asunto (opcional)">
          </div>
          <div class="input-group input-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <!-- <i class="now-ui-icons users_circle-08"></i> -->
              </span>
            </div>
            <input class="form-control" type="number" name="phone" placeholder="Teléfono" required>
          </div>
          <div class="input-group input-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <!-- <i class="now-ui-icons ui-1_email-85"></i> -->
              </span>
            </div>
            <input class="form-control" type="email" name="email" placeholder="Email..." required>
          </div>
          <div class="textarea-container">
            <textarea class="form-control" rows="4" cols="80" name="message" placeholder="Escribe un comentario..." required></textarea>
          </div>
          <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
          <br />
          <div class="send-button">
            <button class="btn btn-blue btn-round btn-block btn-lg" type="submit">Enviar</button>
          </div>
          <br></br>
          <h5>Contáctanos directamente en</h5>
          <p class="form-control no-border">+56966335252 | +56973710400 | gonzalo@airclima.cl | info@airclima.cl</p>
        </div>
      </div>
    </div>
  </div>
</form>