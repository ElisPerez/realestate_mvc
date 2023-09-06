<main class="contenedor seccion">
  <h1>Contacto</h1>

  <?php if ($message) { ?>
    <p class="alert success"><?php echo $message; ?></p>
  <?php } ?>

  <picture>
    <source srcset="build/img/destacada3.webp" type="image/webp" />
    <source srcset="build/img/destacada3.jpg" type="image/jpeg" />
    <img loading="lazy" src="build/img/destacada3" alt="Contacto" />
  </picture>

  <h2>Llene el formulario de contacto</h2>

  <form action="/contact" method="post" class="formulario">
    <fieldset>
      <legend>Información Personal</legend>

      <label for="name">Nombre</label>
      <input type="text" name="contact[name]" id="name" placeholder="Tu Nombre" required />

      <label for="message">Mensaje</label>
      <textarea name="contact[message]" id="message" required></textarea>
    </fieldset>

    <fieldset>
      <legend>Información sobre la propiedad</legend>

      <label for="type">Vende o Compra:</label>
      <select name="contact[type]" id="type" required>
        <option value="" disabled selected>-- Seleccione --</option>
        <option value="Compra">Compra</option>
        <option value="Vende">Vende</option>
      </select>

      <label for="price">Precio o Presupuesto</label>
      <input type="tel" name="contact[price]" id="price" placeholder="Tu Precio o Presupuesto" required />
    </fieldset>

    <fieldset>
      <legend>Contacto</legend>

      <p>Como desea ser contactado</p>

      <div class="forma-contacto">
        <label for="contact-phone">Teléfono</label>
        <input type="radio" value="Telefono" name="contact[contact]" id="contact-phone" required />

        <label for="contactar-email">E-mail</label>
        <input type="radio" value="Email" name="contact[contact]" id="contactar-email" required />
      </div>

      <div id="contact"></div>

    </fieldset>

    <input type="submit" value="Enviar" class="boton-primary" />
  </form>
</main>