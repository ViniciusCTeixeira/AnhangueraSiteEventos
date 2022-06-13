<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-success fade show" role="alert">
    <div class="container">
        <i class="fa-duotone fa-badge-check"></i>
        <?= $message ?>
    </div>
</div>
