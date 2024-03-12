<?php require_once 'partials/header.php'; ?>
<form class="title-import" action="<?php echo getUrl('admin/importXML') ?>" enctype="multipart/form-data" method="post">
  <h2>IMPORTAR DADOS DAS LOJAS</h2>
  <label for="file">
    Por favor selecione um arquivo XML válido para importar
    <input type="file" id="file" name="contacts_file">
  </label>
  <button>Subir contatos</button>
  <?php if (isset($_SESSION['contact_msg_ok'])) : ?>
    <div class="message message_ok" id="message">
      <p><?php echo $_SESSION['contact_msg_ok']; ?></p>
    </div>
  <?php endif; ?>
  <?php if (isset($_SESSION['contact_msg_err'])) : ?>
    <div class="message message_err" id="message">
      <p><?php echo $_SESSION['contact_msg_err']; ?></p>
    </div>
  <?php endif; ?>
  <?php unset($_SESSION['contact_msg_ok']); ?>
  <?php unset($_SESSION['contact_msg_err']); ?>
</form>
<?php require_once 'partials/footer.php'; ?>