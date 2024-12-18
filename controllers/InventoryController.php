<?php
require_once 'models/Inventory.php';
require_once './utils/status.php';

class InventoryController
{
    private $inventoryModel;


    public function __construct()
    {
        $this->inventoryModel = new InventoryModel();
    }

    public function showInventory()
    {
        $inventoryData = $this->inventoryModel->getInventoryData();


        require_once './views/inventory_view.php';
    }

    public function updateInventory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize user input
            $id = htmlspecialchars($_POST['id']);
            $name = htmlspecialchars($_POST['item_name']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $description = htmlspecialchars($_POST['description']);

            $result = $this->inventoryModel->updateInventoryData($name, $quantity, $description, $id);
            isUpdateSuccess($result);
        }
    }


    public function addInventory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['item_name']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $description = htmlspecialchars($_POST['description']);
            $user_id = htmlspecialchars($_POST['id']); // Ensure user_id is provided

            // Check if user_id is valid (not empty)
            if (!empty($user_id)) {
                $result = $this->inventoryModel->addInventoryData($name, $quantity, $description, $user_id);
                isUpdateSuccess($result);
            } else {
                echo "Error: user_id is required and must be valid.";
            }
        }
    }


    public function deleteInventory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = htmlspecialchars($_POST['id']);
            $result = $this->inventoryModel->deleteInventory($id);
            isUpdateSuccess($result);
        }
    }
}
