<?php require_once 'partials/header.php'; ?>
<form action="<?php echo getUrl('admin/update') ?>" class="update-client" method="post">
  <h2>Atualizar dados do cliente</h2>

  <input type="text" id="name" name="name" placeholder="Nome" value="<?php echo $client->name ?>" required>

  <input type="email" id="email" name="email" placeholder="E-mail" value="<?php echo $client->email ?>" required>

  <input type="hidden" name="id" value="<?php echo $client->id ?>">
  <button>Atualizar dados</button>
</form>
<?php require_once 'partials/footer.php'; ?>