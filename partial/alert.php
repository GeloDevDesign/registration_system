<?php
// Check for the message parameter in the URL
if (isset($_GET['message'])):
    $message = htmlspecialchars($_GET['message']);
    $alertClass = $message === 'update_success' ? 'alert-success' : 'alert-error';
    $alertText = $message === 'update_success' ? 'Item updated successfully!' : 'Failed to update the item.';
?>

<div class="alert <?= $alertClass ?> shadow-lg mb-4">
    <div>
        <span><?= $alertText ?></span>
    </div>
</div>
<?php endif; ?>

<script>
  
    // Remove alert after 3 seconds
    const alertElement = document.querySelector('.alert');
    if (alertElement) {
        setTimeout(() => {
            alertElement.remove();
        }, 3000); // 3000ms = 3 seconds
    }
</script>
