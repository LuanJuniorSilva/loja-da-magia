<?php
class Clients extends model
{
  public function getClients($id = '')
  {
    $where = ' WHERE email <> "" AND name <> "" ';
    if ($id) {
      $where = 'WHERE id = ? AND email <> "" AND name <> ""';
    }
    $sql = "SELECT name, email FROM client {$where} ORDER BY name ASC;";
    $sql = $this->db->prepare($sql);

    if ($id) $sql->bindValue(1, $id);

    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_OBJ);
  }

  public function getAmount($search)
  {
    $sql = "SELECT c.id as id, c.name as name, c.email as email, r.update_at as date, p.name as product, p.price FROM client c INNER JOIN request r ON c.id = r.id_client INNER JOIN product p ON r.id_product = p.id WHERE c.name LIKE '%{$search}%' OR c.email LIKE '%{$search}%' GROUP BY c.name ORDER BY c.name ASC;";
    $sql = $this->db->prepare($sql);

    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_OBJ);
  }

  public function getAll($search, $offset, $limit)
  {
    $sql = "SELECT c.id as id, c.name as name, c.email as email, r.update_at as date, p.name as product, p.price FROM client c INNER JOIN request r ON c.id = r.id_client INNER JOIN product p ON r.id_product = p.id WHERE c.name LIKE '%{$search}%' OR c.email LIKE '%{$search}%' GROUP BY c.name ORDER BY c.name ASC LIMIT {$offset}, {$limit};";
    $sql = $this->db->prepare($sql);

    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_OBJ);
  }

  public function getById($id)
  {
    $sql = "SELECT c.id as id, c.name as name, c.email as email, r.update_at as date, p.name as product, p.price FROM client c INNER JOIN request r ON c.id = r.id_client INNER JOIN product p ON r.id_product = p.id WHERE c.id = ?;";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(1, $id);

    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_OBJ);
  }

  public function update($id, $data)
  {
    $sql = "UPDATE client SET name = ?, email = ? WHERE id = ?";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(1, $data->name);
    $sql->bindValue(2, $data->email);
    $sql->bindValue(3, $id);
    return $sql->execute();
  }

  public function insert($data)
  {
    $sql = "INSERT INTO client (id, name, email) VALUES (?, ?, ?);";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(1, $data->id);
    $sql->bindValue(2, $data->name);
    $sql->bindValue(3, $data->email);
    $sql->execute();
    return $this->db->lastInsertId();
  }
}
