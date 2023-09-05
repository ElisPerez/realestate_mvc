<main class="contenedor seccion">
  <h1>Administrador de Bienes Raices</h1>
  <?php
  if ($result) {
    $message = showNotification(intval($result));
    if ($message) { ?>
      <p class="alert success"><?php echo s($message); ?></p>
  <?php }
  } ?>


  <a href="/properties/create" class="boton boton-primary">Nueva Propiedad</a>
  <a href="/sellers/create" class="boton boton-secondary">Nuevo(a) Vendedor</a>

  <h2>Propiedades</h2>

  <table class="properties">
    <thead>
      <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Imagen</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Mostrar los datos de la DB -->
      <?php foreach ($properties as $property) : ?>
        <tr>
          <td>
            <?php echo $property->id; ?>
          </td>
          <td><?php echo $property->title; ?></td>
          <td><img src="images/<?php echo $property->image; ?>" alt="<?php echo $property->title; ?>" class="image-table" /></td>
          <td>$<?php echo $property->price; ?></td>
          <td>
            <a href="/properties/update?id=<?php echo $property->id; ?>" class="boton-secondary-block">Actualizar</a>

            <form action="/properties/delete" method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $property->id; ?>" />
              <input type="hidden" name="type" value="property" />
              <input type="submit" class="boton-error-block" value="Eliminar" />
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- ** SELLERS ** -->

  <h2>Vendedores</h2>

  <table class="properties">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <!-- Mostrar los datos de la DB -->
      <?php foreach ($sellers as $seller) : ?>
        <tr>
          <td><?php echo $seller->id; ?></td>
          <td><?php echo $seller->first_name . " " . $seller->last_name; ?></td>
          <td><?php echo $seller->phone; ?></td>
          <td>
            <a href="/sellers/update?id=<?php echo $seller->id; ?>" class="boton-secondary-block">Actualizar</a>

            <form method="POST" class="w-100" action="/sellers/delete">
              <input type="hidden" name="id" value="<?php echo $seller->id; ?>" />
              <input type="hidden" name="type" value="seller" />
              <input type="submit" class="boton-error-block" value="Eliminar" />
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>