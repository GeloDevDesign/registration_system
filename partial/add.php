<?php 
require_once './utils/auth.php';


requireAuth(); // Ensure the user is authenticated
$user_id = $_SESSION['user']['id'];

?>

<div class="w-full justify-end items-end">
  <!-- Open the modal using ID.showModal() method -->
  <button class="btn btn-sm btn-primary" onclick="my_modal_1.showModal()">Add New Item</button>
  <dialog id="my_modal_1" class="modal">
    <form method="POST" action="?path=inventory_add" class="modal-box">
      <h3 class="text-lg font-bold">Edit Inventory Item</h3>
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_id); ?>">

      <div class="mt-2">
        <label>Name</label>
        <input type="text" name="item_name" value="" class="input input-bordered w-full">
      </div>

      <div class="mt-2">
        <label>Quantity</label>
        <input type="number" name="quantity" value="" class="input input-bordered w-full">
      </div>

      <div class="mt-2">
        <label>Description</label>
        <textarea name="description" class="textarea textarea-bordered w-full"></textarea>
      </div>

      <div class="modal-action">
        <button type="submit" class="btn btn-primary">Add new Item</button>
        <button type="" class="btn ">Cancel</button>
      </div>
    </form>
  </dialog>
</div>