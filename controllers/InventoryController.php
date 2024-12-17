<?php
require_once 'models/Inventory.php';
require_once './utils/status.php';

class InventoryController
{
    private $inventoryModel;

    // Constructor to initialize the model
    public function __construct()
    {
        $this->inventoryModel = new InventoryModel();
    }

    public function showInventory()
    {
        // Fetch inventory data
        $inventoryData = $this->inventoryModel->getInventoryData();

        // Pass data to the view
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

            // Update inventory
            $result = $this->inventoryModel->updateInventoryData($name, $quantity, $description, $id);

            // Check the update status
            isUpdateSuccess($result);
        }
    }

    public function deleteInventory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize input
            $id = htmlspecialchars($_POST['id']);

            // Delete the record
            $result = $this->inventoryModel->deleteInventory($id);

            // Check the delete status
            isUpdateSuccess($result);
        }
    }
}
