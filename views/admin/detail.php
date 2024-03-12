<?php require_once 'partials/header.php'; ?>

<div class="contact_detail">
  <?php if ($result) : ?>
    <h2 class="text_center">Detalhe do Contato selecionado</h2>
    <p>
      <strong>Nome: </strong> <?php echo $result->name ?> <br>
      <strong>E-mail: </strong> <?php echo $result->email ?> <br>
      <strong>Histórico de Pedidos: </strong> <?php echo $products ?> <br>
      <strong>Data Último Pedido: </strong> <?php echo getDateUpdate($result->date) ?> <br>
      <strong>Valor Último Pedido ($): </strong> R$ <?php echo number_format($result->price, 2, ',') ?> <br>
    </p>
  <?php else : ?>
    <h2 class="text_center contact_404">Cliente não encontrado</h2>
  <?php endif; ?>
</div>
<?php require_once 'partials/footer.php'; ?>