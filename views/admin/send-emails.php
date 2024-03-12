<?php require_once 'partials/header.php'; ?>
<h2>Disparar E-mails</h2>
<?php if (count($clients) > 0) : ?>
  <form action="<?php echo getUrl('admin/sendEmailsRequest') ?>" class="form-emails" method="post">
    <label for="">Selecione um evento</label>
    <select name="type">
      <option value="promo">Promoções</option>
      <option value="news">Novidades</option>
      <option value="status_request">Status do Pedido</option>
    </select>
    <label for="">Cliente(s)</label>
    <select name="list-client">
      <option value="all">Todos os clientes</option>
      <?php foreach ($clients as $client) : ?>
        <option value="<?php echo $client->id ?>"><?php echo $client->name ?></option>
      <?php endforeach; ?>
    </select>
    <input type="text" name="title" placeholder="Digite aqui seu titulo">
    <textarea rows="5" name="description" placeholder="Digite aqui sua mensagem"></textarea>
    <button>Enviar</button>
  </form>
<?php else : ?>
  <h2>Não há cliente para o envio de e-mail.</h2>
<?php endif; ?>
<?php require_once 'partials/footer.php'; ?>