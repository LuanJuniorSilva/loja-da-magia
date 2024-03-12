<?php require_once 'partials/header.php'; ?>

<section class="banner" style="background-image: url('images/{{ background }}')">Loja da mágia, adquira já o seu produto</section>
<?php if (count($products) > 0) : ?>
  <h2> Produtos disponíveis</h2>

  <div class="container list">
    <?php foreach ($products as $product) : ?>
      <div class="item">
        <div class="item--name"><?php echo $product->name; ?></div>
        <div class="item--price">Descrição: <?php echo $product->description; ?></div>
        <div class="item--price">Preço: <?php echo $product->price; ?></div>
      </div>
    <?php endforeach; ?>
  </div>
<?php else : ?>
  <h2> Nenhum produto disponível</h2>
<?php endif ?>

<?php require_once 'partials/footer.php'; ?>