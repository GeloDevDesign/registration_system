<?php 

function isUpdateSuccess($result){
  if ($result) {
    header('Location: ?path=inventory&message=update_success');
} else {
    header('Location: ?path=inventory&message=update_failure');
}
}

?>