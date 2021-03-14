<form id="frmContact" class="contact-form recaptchaForm" action="" method="post" novalidate="novalidate">
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
            <input class="form-control" type="tel" name="phone" placeholder="56 9 1234 5678" placeholder="Teléfono" required>
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
          <div class="g-recaptcha" data-sitekey="<?php echo $SITE_KEY; ?>"></div>
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