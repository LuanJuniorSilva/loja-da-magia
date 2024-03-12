<!DOCTYPE html>
<html lang="pt-BR">
<?php
if (!isset($_SESSION['logged'])) {
  return header('Location: /lojadamagia/admin');
}
?>

<head>
  <meta charset="utf-8">
  <title>Tela Inicial</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

  <link rel="stylesheet" type="text/css" href="<?php echo getUrl('assets/css/admin.css') ?>">
  <script type="text/javascript" src="<?php echo getUrl('assets/js/admin.js') ?>"></script>
</head>

<body>
  <header class="header_main">
    <h4>Bem vindo(a) <?php echo $_SESSION['email'] ?> </h4>
    <a href="<?php echo getUrl('admin/logout') ?>"><i class="fas fa-sign-out-alt"></i> sair</a>
  </header>
  <div class="flex container">
    <nav class="menu">
      <ul>
        <li><a href="<?php echo getUrl('admin/list') ?>" class="<?php echo isActive(['list', 'detail', 'edit']) ?>">Lista de Contato</a></li>
        <li><a href="<?php echo getUrl('admin/import') ?>" class="<?php echo isActive(['import']) ?>">Importar Contatos</a></li>
        <li><a href="<?php echo getUrl('admin/pedidos') ?>" class="<?php echo isActive(['pedidos']) ?>">Importar Dados das Lojas</a></li>
        <li><a href="<?php echo getUrl('admin/sendEmails') ?>" class="<?php echo isActive(['sendEmails']) ?>">Disparar E-mails</a></li>
        <li><a href="<?php echo getUrl('admin/products') ?>" class="<?php echo isActive(['products', 'viewProduct', 'formProduct']) ?>">Lista de Produtos</a></li>
      </ul>
    </nav>
    <div class="content">