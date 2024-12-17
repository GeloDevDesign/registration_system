<?php

class User
{
  private $db;
  
  public function __construct()
  {
    $this->db = Config::connect();
  }

  public function getInventoryData()
  {
    $stmt = $this->db->prepare("SELECT * FROM inventory");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function updateInventoryData($name, $quantity, $description, $id)
  {
    $stmt = $this->db->prepare("
            UPDATE inventory
            SET item_name = :name, quantity = :quantity, description = :description
            WHERE id = :id
        ");

    // Bind parameters to ensure data safety
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the query
    return $stmt->execute();
  }

  public function deleteInventory($id)
  {
    $stmt= $this->db->prepare("
      DELETE FROM inventory WHERE id = :id
    ");

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
