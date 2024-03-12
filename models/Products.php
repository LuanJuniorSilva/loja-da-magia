<?php
class Products extends model
{
  public function getProducts($name = '')
  {
    $where = '';
    if ($name) {
      $where = 'WHERE name = ?';
    }
    $sql = "SELECT * FROM product {$where}";
    $sql = $this->db->prepare($sql);

    if ($name) $sql->bindValue(1, $name);

    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_OBJ);
  }
  public function getByName($name)
  {
    $sql = 'SELECT * FROM product WHERE name = ?';
    $sql = $this->db->prepare($sql);

    $sql->bindValue(1, $name);

    $sql->execute();
    return $sql->fetch(PDO::FETCH_OBJ);
  }

  public function getById($id)
  {
    $sql = 'SELECT p.id as id, p.name as name, p.slug as slug, p.description as description, p.price as price, r.update_at as date FROM product p LEFT JOIN request r ON p.id = r.id_product WHERE p.id = ?;';
    $sql = $this->db->prepare($sql);

    $sql->bindValue(1, $id);

    $sql->execute();
    return $sql->fetch(PDO::FETCH_OBJ);
  }

  public function insert($name, $price)
  {
    $sql = "INSERT INTO product (name, price) VALUES (?, ?);";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(1, $name);
    $sql->bindValue(2, $price);
    $sql->execute();
    return $this->db->lastInsertId();
  }

  public function getAmount($search)
  {
    $sql = "SELECT * from product WHERE name LIKE '%{$search}%' ORDER BY name ASC;";
    $sql = $this->db->prepare($sql);

    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_OBJ);
  }

  public function getAll($search, $offset, $limit)
  {
    $sql = "SELECT * FROM product WHERE name LIKE '%{$search}%' ORDER BY name ASC LIMIT {$offset}, {$limit};";
    $sql = $this->db->prepare($sql);

    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_OBJ);
  }

  public function update($id, $data)
  {
    $sql = "UPDATE product SET name = ?, slug = ?, price = ?, description = ? WHERE id = ?";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(1, $data->name);
    $sql->bindValue(2, $data->slug);
    $sql->bindValue(3, $data->price);
    $sql->bindValue(4, $data->description);
    $sql->bindValue(5, $id);
    return $sql->execute();
  }
}
