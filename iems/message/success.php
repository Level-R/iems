<?php if (isset($_GET['success'])): ?>
    <div id="flashMessage" class="alert alert-success m-auto text-center roboto-body fade-message">
        <?= htmlspecialchars($_GET['success']) ?>
    </div>
<?php endif; ?>
