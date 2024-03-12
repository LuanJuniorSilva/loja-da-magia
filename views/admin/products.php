<?php require_once 'partials/header.php'; ?>

<?php if (count($result) > 0) : ?>
  <h2 class="text_center">Lista de clientes</h2>
  <div class="main_search">
    <form action="?link=2" method="get">
      <input type="search" name="search" class="search_input" placeholder="Pesquise por Nome do produto">
      <input type="hidden" name="link" value="2">
      <button class="button_search"><i class="fas fa-search"></i></button>

    </form>
  </div>
  <table class="table_main">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Slug</th>
        <th>Valor Último Pedido ($):</th>
        <th>Opções</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $list) : ?>
        <tr>
          <td><?php echo $list->name ?></td>
          <td><?php echo $list->slug ?></td>
          <td>R$ <?php echo number_format($list->price, 2, ',') ?></td>
          <td>
            <a class="icone_see" href="<?php echo 'viewProduct/' . $list->id ?>"><i class="fas fa-eye"></i></a>
            <a class="icone_see" href="<?php echo 'formProduct/' . $list->id ?>"><i class="fas fa-edit"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5">Lista de todos os produtos</td>
      </tr>
    </tfoot>
  </table>

  <div class="pagination">
    <?php if ($page > 1) : ?>
      <a href="<?php echo '?page=' . $previous . '&search=' . $search ?>">Anterior</a>
    <?php endif; ?>
    <?php if ($page != $pages) : ?>
      <a href="<?php echo '?page=' . $next . '&search=' . $search ?>">Próximo</a>
    <?php endif; ?>
  </div>
<?php else : ?>
  <h2 class="text_center">Não há contatos cadastrados no sistema!</h2>
<?php endif; ?>

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