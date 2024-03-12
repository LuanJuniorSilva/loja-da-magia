<?php require_once 'partials/header.php'; ?>
<form class="title-import" action="<?php echo getUrl('admin/importCsvOrXlsx') ?>" enctype="multipart/form-data" method="post">
  <h2>IMPORTAR CONTATOS</h2>
  <label for="file">
    Por favor selecione um arquivo XLSX ou CSV válido para importar os contatos
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