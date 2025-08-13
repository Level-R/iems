<?php if (isset($_GET['error'])): ?>
    <div id="flashMessage" class="alert alert-danger m-auto text-center roboto-body fade-message">
        <?= htmlspecialchars($_GET['error']) ?>
    </div>
<?php endif; ?>
