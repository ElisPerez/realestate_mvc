<main class="contenedor seccion">
  <h1>Actualizar Vendedor(a)</h1>

  <a href="/admin" class="boton boton-secondary">Volver</a>

  <?php foreach ($errors as $error) : ?>

    <div class="alert error">
      <?php echo $error; ?>
    </div>

  <?php endforeach; ?>

  <form method="POST" class="formulario" action="/sellers/update">

    <?php include 'form.php'; ?>

    <input type="submit" value="Guardar Cambios" class="boton boton-secondary" />
  </form>
</main>