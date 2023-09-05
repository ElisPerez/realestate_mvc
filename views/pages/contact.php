<main class="contenedor seccion">
  <h1>Contacto</h1>

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

      <label for="email">E-mail</label>
      <input type="email" name="contact[email]" id="email" placeholder="Tu Email" required />

      <label for="phone">Teléfono</label>
      <input type="tel" name="contact[phone]" id="phone" placeholder="Tu Teléfono" />

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
        <input type="radio" value="phone" name="contact[contact]" id="contact-phone" required />

        <label for="contactar-email">E-mail</label>
        <input type="radio" value="email" name="contact[contact]" id="contactar-email" required />
      </div>

      <p>Si eligió teléfono, elija la fecha y hora</p>

      <label for="date">Fecha:</label>
      <input type="date" name="contact[date]" id="date" />

      <label for="time">Hora:</label>
      <input type="time" name="contact[time]" id="time" min="09:00" max="18:00" />
    </fieldset>

    <input type="submit" value="Enviar" class="boton-primary" />
  </form>
</main>