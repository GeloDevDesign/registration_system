<?php
require_once 'models/Inventory.php';
require_once './utils/status.php';

class InventoryController
{
    public function showInventory()
    {

        $userModel = new User();
        
        $inventoryData = $userModel->getInventoryData();


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


            $userModel = new User();


            $result = $userModel->updateInventoryData($name, $quantity, $description, $id);


            isUpdateSuccess($result);
        }
    }


    public function deleteInventory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = htmlspecialchars($_POST['id']);

            $userModel = new User();
            $result = $userModel->deleteInventory($id);

            isUpdateSuccess($result);
        }
    }
}
