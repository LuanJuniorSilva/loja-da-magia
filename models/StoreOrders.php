<?php
class StoreOrders extends model
{
  public function getAll()
  {
    $sql = 'SELECT * FROM product';
    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $sql = $sql->fetchAll(PDO::FETCH_OBJ);
      return $sql;
    } else {
      return 0;
    }
  }

  public function insert($data)
  {
    $sql = "INSERT INTO storeorders (id_loja, nome_loja, localizacao, produto, quantidade) VALUES (?, ?, ?, ?, ?);";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(1, $data->id_loja);
    $sql->bindValue(2, $data->nome_loja);
    $sql->bindValue(3, $data->localizacao);
    $sql->bindValue(4, $data->produto);
    $sql->bindValue(5, $data->quantidade);
    $sql->execute();
    return $this->db->lastInsertId();
  }
}
