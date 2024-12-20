<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.22/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Inventory</title>
</head>

<body class="p-6">

  <?php require './partial/alert.php' ?>
  <?php require './partial/add.php' ?>
  <div class="overflow-x-auto">
    <table class="table table-zebra">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Quantity</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($inventoryData)): ?>
          <?php foreach ($inventoryData as $item): ?>
            <tr>
              <td><?= htmlspecialchars($item['id']) ?></td>
              <td><?= htmlspecialchars($item['item_name']) ?></td>
              <td><?= htmlspecialchars($item['quantity']) ?></td>
              <td><?= htmlspecialchars($item['description']) ?></td> 
              <td>
                <!-- Edit Button -->
                <button class="btn open-modal btn-primary" data-modal-target="#edit-modal-<?= $item['id'] ?>">Edit</button>

                <!-- Delete Button -->
                <button class="btn open-modal btn-error" data-modal-target="#delete-modal-<?= $item['id'] ?>">Delete</button>

                <!-- Edit Modal -->
                <dialog id="edit-modal-<?= $item['id'] ?>" class="modal">
                  <form method="POST" action="?path=inventory_update" class="modal-box">
                    <h3 class="text-lg font-bold">Edit Inventory Item</h3>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">

                    <div class="mt-2">
                      <label>Name</label>
                      <input type="text" name="item_name" value="<?= htmlspecialchars($item['item_name']) ?>" required class="input input-bordered w-full">
                    </div>

                    <div class="mt-2">
                      <label>Quantity</label>
                      <input type="number" name="quantity" value="<?= htmlspecialchars($item['quantity']) ?>" required class="input input-bordered w-full">
                    </div>

                    <div class="mt-2">
                      <label>Description</label>
                      <textarea name="description" required class="textarea textarea-bordered w-full"><?= htmlspecialchars($item['description']) ?></textarea>
                    </div>

                    <div class="modal-action">
                      <button type="submit" class="btn btn-primary">Save</button>
                      <button type="button" class="btn" onclick="closeModal('edit-modal-<?= $item['id'] ?>')">Cancel</button>
                    </div>
                  </form>
                </dialog>

                <!-- Delete Modal -->
                <dialog id="delete-modal-<?= $item['id'] ?>" class="modal">
                  <form method="POST" action="?path=inventory_delete" class="modal-box">
                    <h3 class="text-lg font-bold">Confirm Delete</h3>
                    <p>Are you sure you want to delete <strong><?= htmlspecialchars($item['item_name']) ?></strong>?</p>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']) ?>">

                    <div class="modal-action">
                      <button type="submit" class="btn btn-error">Yes, Delete</button>
                      <button type="button" class="btn" onclick="closeModal('delete-modal-<?= $item['id'] ?>')">Cancel</button>
                    </div>
                  </form>
                </dialog>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">No inventory data available.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <?php require_once './partial/logout.php' ?>

  <script>
    // Open modal
    document.querySelectorAll('.open-modal').forEach(button => {
      button.addEventListener('click', () => {
        const modalId = button.getAttribute('data-modal-target');
        const modal = document.querySelector(modalId);
        if (modal) modal.showModal();
      });
    });

    // Close modal
    function closeModal(modalId) {
      const modal = document.getElementById(modalId);
      if (modal) modal.close();
    }


  </script>

</body>

</html>