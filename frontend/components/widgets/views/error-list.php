<?php
?>
<div class="warning-item warning-item--error">
    <h2>Ошибки заполнения формы</h2>
    <?php foreach ($errors as $field => $error): ?>
        <h3><?= $field; ?></h3>
        <p><?= $error; ?></p>
    <?php endforeach; ?>
</div>
