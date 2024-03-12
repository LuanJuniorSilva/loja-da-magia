<?php
class Users extends model
{
  public function getAll()
  {
    $sql = 'SELECT *  FROM product';
    $sql = $this->db->query($sql);

    if ($sql->rowCount() > 0) {
      $sql = $sql->fetchAll(PDO::FETCH_OBJ);
      return $sql;
    } else {
      return 0;
    }
  }

  public function getUser($email)
  {
    $sql = 'SELECT id, user, email FROM user WHERE email = ?;';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(1, $email);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_OBJ);
  }

  public function getAuth($email, $pass)
  {
    $sql = 'SELECT id, user, email FROM user WHERE email = ? AND pass = ?;';
    $sql = $this->db->prepare($sql);
    $sql->bindValue(1, $email);
    $sql->bindValue(2, $pass);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_OBJ);
  }
}
