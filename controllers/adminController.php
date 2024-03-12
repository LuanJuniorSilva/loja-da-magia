<?php
include_once './utils/functions.php';
class adminController extends controller
{
  public function index()
  {
    if (isset($_SESSION['logged'])) {
      return header('Location: admin/list');
    }
    $this->loadViewPainel('login');
  }

  public function auth()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = sanitizeField('email');
      $pass = sanitizeField('password');
      $password = setHashPassword($email, $pass);

      $user = new Users();
      $result = $user->getUser($email);

      if (!$result) {
        $_SESSION['token_status'] = 'error';
        $_SESSION['token_message'] = 'Administrador não encontrado!';
        header('Location: /lojadamagia/admin/');
      }

      $resultPasswd = $user->getAuth($email, $password);

      if ($resultPasswd) {
        $_SESSION['logged'] = 'success';
        $_SESSION['email'] = $resultPasswd->email;
        header('Location: /lojadamagia/admin/home');
      } else {
        $_SESSION['token_status'] = 'error';
        $_SESSION['token_message'] = 'Senha incorreta!';
        header('Location: /lojadamagia/admin/');
      }
    } else {
      header('Location: /lojadamagia/admin');
    }
  }

  public function logout()
  {
    session_destroy();
    header('Location: /lojadamagia/admin');
  }

  public function home()
  {
    $this->loadViewPainel('home');
  }

  public function list()
  {

    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page = intval($page);

    $next = $page + 1;
    $previous = $page - 1;
    // PAGINACAO

    $limit = 5;
    $pageInitial = $page;

    $offset = ($pageInitial * $limit) - $limit;
    $clients = new Clients();

    $qtde = $clients->getAmount($search);
    $result = $clients->getAll($search, $offset, $limit);

    $pages = ceil(count($qtde) / $limit);

    $data = array(
      'result' => $result,
      'page' => $page,
      'pages' => $pages,
      'next' => $next,
      'previous' => $previous,
      'search' => $search
    );

    $this->loadViewPainel('list', $data);
  }

  public function detail($id)
  {
    $client = new Clients();
    $result = $client->getById($id);

    if (!$result) header('Location: /lojadamagia/admin/list');

    $prod = [];

    foreach ($result as $key => $value) {
      $prod[$key] = $value->product;
    }

    $data = array(
      'result' => $result[0],
      'products' => implode(';', $prod)
    );
    $this->loadViewPainel('detail', $data);
  }

  public function edit($id)
  {
    $client = new Clients();
    $result = $client->getById($id);

    if (!$result) header('Location: /lojadamagia/admin/list');

    $data = array(
      'client' => $result[0],
    );
    $this->loadViewPainel('edit', $data);
  }

  public function update()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = sanitizeField('id');
      $name = sanitizeField('name');
      $email = sanitizeField('email');

      if ($name && $email) {
        $data = (object) array(
          'name' => $name,
          'email' => $email
        );
        $client = new Clients();
        $result = $client->update($id, $data);

        if ($result) {
          $_SESSION['contact_msg_ok'] = 'Dados atualizado com sucesso.';
          header('Location: /lojadamagia/admin/list');
        } else {
          $_SESSION['contact_msg_err'] = 'Falha ao atualizar dados';
          header("Location: /lojadamagia/admin/edit/{$id}");
        }
      } else {
        echo 'Todos os campos devem ser preenchidos corretamente!';
      }
    } else {
      header('Location: /lojadamagia/admin/list');
    }
  }

  public function import()
  {
    $this->loadViewPainel('import');
  }

  public function importCsvOrXlsx()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $file = $_FILES['contacts_file'] ?? null;

      $fileData = convertFileCSVOrXlsx($file);

      if ($fileData) {
        foreach ($fileData as $value) {

          $client = new Clients();

          $idClient = $client->insert($value);

          foreach ($value->product->name as $name) {
            $product = new Products();

            $price =  changeStringForNumber($value->product->price);

            $idProduct = $product->insert($name, $price);

            $request = new Requests();
            $date = $value->request->update_at ? $value->request->update_at : null;

            $request->insert($idClient, $idProduct, $date);
          }
          $_SESSION['contact_msg_ok'] = 'Dados importado com sucesso.';
          header('Location: /lojadamagia/admin/import');
        }
      }
    } else {
      header('Location: /lojadamagia/admin/import');
    }
  }

  public function sendEmails()
  {
    $client = new Clients();
    $clients = $client->getClients();
    $this->loadViewPainel('send-emails', array(
      'clients' => $clients
    ));
  }

  public function sendEmailsRequest()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $type = sanitizeField('type');
      $listClient = sanitizeField('list-client');
      $title = sanitizeField('title');
      $description = sanitizeField('description');

      if ($type && $listClient && $title && $description) {
        $clients = new Clients();
        if ($type === 'all') {
          $listClient = '';
        }
        $listClients = $clients->getClients($listClient);

        foreach ($listClients as $client) {
          try {
            mail($client->email, $title, $description);
            $_SESSION['contact_msg_ok'] = 'E-mail enviado com sucesso.';
          } catch (Exception $e) {
            $_SESSION['contact_msg_err'] = 'Falha ao enviar e-mail, tente novamente mais tarde!';
          } finally {
            header('Location: /lojadamagia/admin/sendEmails');
          }
        }
      } else {
        $_SESSION['contact_msg_err'] = 'Digite todos os seus dados corretamente.';
        header('Location: /lojadamagia/admin/sendEmails');
      }
    } else {
      header('Location: /lojadamagia/admin/sendEmails');
    }
  }

  public function products()
  {
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page = intval($page);

    $next = $page + 1;
    $previous = $page - 1;
    // PAGINACAO

    $limit = 5;
    $pageInitial = $page;

    $offset = ($pageInitial * $limit) - $limit;
    $products = new Products();

    $qtde = $products->getAmount($search);
    $result = $products->getAll($search, $offset, $limit);

    $pages = ceil(count($qtde) / $limit);

    $data = array(
      'result' => $result,
      'page' => $page,
      'pages' => $pages,
      'next' => $next,
      'previous' => $previous,
      'search' => $search
    );

    $this->loadViewPainel('products', $data);
  }

  public function viewProduct($id)
  {
    $product = new Products();
    $result = $product->getById($id);

    if (!$result) header('Location: /lojadamagia/admin/products');

    $data = array(
      'result' => $result,
    );
    $this->loadViewPainel('detail-product', $data);
  }

  public function formProduct($id)
  {
    $product = new Products();
    $result = $product->getById($id);

    if (!$result) header('Location: /lojadamagia/admin/products');

    $data = array(
      'product' => $result,
    );
    $this->loadViewPainel('edit-product', $data);
  }

  public function updateProduct()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = sanitizeField('id');
      $name = sanitizeField('name');
      $slug = sanitizeField('slug');
      $price = sanitizeField('price');
      $description = sanitizeField('description');

      if ($name && $slug && $price && $description) {
        $data = (object) array(
          'name' => $name,
          'slug' => $slug,
          'price' => (float) $price,
          'description' => $description
        );
        $product = new Products();
        $result = $product->update($id, $data);

        if ($result) {
          $_SESSION['contact_msg_ok'] = 'Dados atualizado com sucesso.';
          header('Location: /lojadamagia/admin/products');
        } else {
          $_SESSION['contact_msg_err'] = 'Falha ao atualizar dados';
          header("Location: /lojadamagia/admin/formProduct/{$id}");
        }
      } else {
        echo 'Todos os campos devem ser preenchidos corretamente!';
      }
    } else {
      header('Location: /lojadamagia/admin/products');
    }
  }

  public function pedidos()
  {
    $this->loadViewPainel('pedidos');
  }

  public function importXML()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $file = $_FILES['contacts_file'] ?? null;

      $xmlString = file_get_contents($file['tmp_name']);
      $xml =  simplexml_load_string($xmlString);
      $array = (object) json_decode(json_encode($xml), true);

      try {

        $storeOrders = new StoreOrders();

        foreach ($array->pedido as $value) {
          $storeOrders->insert((object) $value);
        }
        $_SESSION['contact_msg_ok'] = 'Dados importado com sucesso.';
        header('Location: /lojadamagia/admin/pedidos');
      } catch (\Throwable $th) {
        $_SESSION['contact_msg_err'] = 'Falha ao importar dados.';
        header('Location: /lojadamagia/admin/pedidos');
      }
    } else {
      header('Location: /lojadamagia/admin/pedidos');
    }
  }
}
