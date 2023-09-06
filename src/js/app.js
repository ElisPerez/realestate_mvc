// ! Limpiar cache si no se reflejan los cambios

document.addEventListener('DOMContentLoaded', function () {
  eventListeners();

  darkMode();

  const pathname = window.location.pathname;
  // console.log(pathname);
  const routesCharCounter = ['/properties/update', '/properties/create'];

  if (routesCharCounter.includes(pathname)) {
    charCounterHandler();
  }
});

function darkMode() {
  const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

  // console.log(prefiereDarkMode.matches);

  if (prefiereDarkMode.matches) {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }

  prefiereDarkMode.addEventListener('change', function () {
    if (prefiereDarkMode.matches) {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  });

  const botonDarkMode = document.querySelector('.dark-mode-boton');

  botonDarkMode.addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');
  });
}

function eventListeners() {
  const mobileMenu = document.querySelector('.mobile-menu');

  mobileMenu.addEventListener('click', navegacionResponsive);

  // Muestra campos condicionales
  const contactMethod = document.querySelectorAll(
    'input[name="contact[contact]"]'
  );

  contactMethod.forEach((input) =>
    input.addEventListener('click', showContactMethod)
  );
}

function showContactMethod(e) {
  const contactDiv = document.querySelector('#contact');

  if (e.target.value === 'Telefono') {
    contactDiv.innerHTML = `
    <label for="phone">Número de Teléfono</label>
    <input type="tel" name="contact[phone]" id="phone" placeholder="Tu Teléfono" required />

    <p>Elija la fecha y hora para la llamada</p>

      <label for="date">Fecha:</label>
      <input type="date" name="contact[date]" id="date" required />

      <label for="time">Hora:</label>
      <input type="time" name="contact[time]" id="time" min="09:00" max="18:00" required />
    `;
  } else {
    contactDiv.innerHTML = `
      <label for="email">E-mail</label>
      <input type="email" name="contact[email]" id="email" placeholder="Tu Email" required />
    `;
  }
}

function navegacionResponsive() {
  const navegacion = document.querySelector('.navegacion');

  navegacion.classList.toggle('mostrar');
}

function charCounterHandler() {
  const textarea = document.querySelector('#description');
  const charCount = document.querySelector('#charCount');

  // Calculating and displaying initial character count
  const initialCount = textarea.value.length;
  charCount.textContent = initialCount;

  // Adding class to the count if exceeding the limit
  if (initialCount < 50) {
    charCount.classList.add('char-count');
  } else {
    charCount.classList.remove('char-count');
  }

  textarea.addEventListener('input', function () {
    const currentCount = textarea.value.length;
    charCount.textContent = currentCount;

    if (currentCount < 50) {
      charCount.classList.add('char-count');
    } else {
      charCount.classList.remove('char-count');
    }
  });
}
