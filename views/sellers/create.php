<main class="contenedor seccion">
  <h1>Registrar Vendedor(a)</h1>

  <a href="/admin" class="boton boton-secondary">Volver</a>

  <?php foreach ($errors as $error) : ?>

    <div class="alert error">
      <?php echo $error; ?>
    </div>

  <?php endforeach; ?>

  <form method="POST" class="formulario" action="/sellers/create">

    <?php include 'form.php'; ?>

    <input type="submit" value="Registrar Vendedor(a)" class="boton boton-secondary" />
  </form>
</main>