<?php
class Requests extends model
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

  public function insert($id_client, $id_product, $date)
  {
    $sql = "INSERT INTO request (id_client, id_product, update_at) VALUES (?, ?, ?);";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(1, $id_client);
    $sql->bindValue(2, $id_product);
    $sql->bindValue(3, $date);
    $sql->execute();
    return $this->db->lastInsertId();
  }
}
