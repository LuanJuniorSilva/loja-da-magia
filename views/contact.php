<?php require_once 'partials/header.php'; ?>

<h1>Página de contato</h1>

<form class="contact" action="contact/send" method="post">
  <input type="text" name="name" placeholder="Digite seu nome" required>
  <input type="email" name="email" placeholder="Digite seu e-mail" required>
  <input type="tel" name="tel" placeholder="Digite seu telefone" required>
  <input type="text" name="subject" placeholder="Digite o assunto" required>
  <textarea name="message" placeholder="Digite a mensagem" required></textarea>
  <button>Enviar Mensagem</button>
</form>
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

<?php require_once 'partials/footer.php'; ?>