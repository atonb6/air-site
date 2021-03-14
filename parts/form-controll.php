<?php
if($_POST)
{
require('constant.php');
    
    $user_name      = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $user_email     = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $user_phone     = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    $content   = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    $subject   = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);


    

      if (empty($_POST["name"])) {
        $nameErr = "El nombre es requerido";
      } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
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
    
      if (empty($_POST["message"])) {
        $phoneErr = "El teléfono es requerido";
      } else {
        $phone = test_input($_POST["phone"]);
        if (!filter_var($phone, FILTER_VALIDATE_EMAIL)) {
          $phoneErr = "Formateo de teléfono invalido";
        }
      }
    
      if (empty($_POST["message"])) {
        $subjectErr = "Debe agregar un asunto";
      } else {
        $subject = test_input($_POST["subject"]);
      }
    
      if (empty($_POST["message"])) {
        $messageErr = "Debe agregar un mensaje";
      } else {
        $message = test_input($_POST["message"]);
      }



      $mailTo = "info@airclima.cl";
      $headers = "From: ".$email;
      $txt = "Formulario de ".$name.".\n\nTeléfono ".$phone."\n\n".$message;
      
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
    
  
      
  
    //reCAPTCHA validation
    if (isset($_POST['g-recaptcha-response'])) {
      
      require('recaptcha/src/autoload.php');		
      
      $recaptcha = new \ReCaptcha\ReCaptcha($SECRET_KEY);
  
      $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
  
        if (!$resp->isSuccess()) {
          $output = json_encode(array('type'=>'error', 'text' => '<b>Captcha</b> Validation Required!'));
          die($output);				
        }	
    }
    
    }
