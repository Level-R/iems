<?php if (isset($_GET['upload']) && $_GET['upload'] === 'success'): ?>
  <div id="flashMessage" class="alert alert-success m-auto text-center roboto-body fade-message">Image uploaded successfully!</div>
<?php elseif (isset($uploadError)): ?>
  <div id="flashMessage" class="alert alert-danger m-auto text-center roboto-body fade-message"><?php echo $uploadError; ?></div>
<?php endif; ?>
