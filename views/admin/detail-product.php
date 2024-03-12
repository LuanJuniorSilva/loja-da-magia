<?php require_once 'partials/header.php'; ?>

<div class="contact_detail">
  <?php if ($result) : ?>
    <h2 class="text_center">Detalhe do Produto selecionado</h2>
    <p>
      <strong>Nome: </strong> <?php echo $result->name ?> <br>
      <strong>Data Último Pedido: </strong> <?php echo getDateUpdate($result->date) ?> <br>
      <strong>Slug: </strong> <?php echo $result->slug ?> <br>
      <strong>Descrição: </strong> <?php echo $result->description ?> <br>
      <strong>Valor Último Pedido ($): </strong> R$ <?php echo number_format($result->price, 2, ',') ?> <br>
    </p>
  <?php else : ?>
    <h2 class="text_center contact_404">Produto não encontrado</h2>
  <?php endif; ?>
</div>
<?php require_once 'partials/footer.php'; ?>