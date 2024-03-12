<?php require_once 'partials/header.php'; ?>
<form action="<?php echo getUrl('admin/updateProduct') ?>" class="form-emails" method="post" enctype="multipart/form-data">
  <h2>Atualizar dados do cliente</h2>

  <input type="text" id="name" name="name" placeholder="Nome" value="<?php echo $product->name ?>" required>

  <input type="text" id="slug" name="slug" placeholder="Slug" value="<?php echo $product->slug ?>">
  <input type="text" id="price" name="price" placeholder="Preço" value="<?php echo number_format($product->price, 2, ',') ?>">
  <textarea rows="5" name="description" placeholder="Descrição"><?php echo $product->description ?></textarea>
  <input type="hidden" name="id" value="<?php echo $product->id ?>">
  <button>Atualizar dados</button>
</form>
<?php require_once 'partials/footer.php'; ?>