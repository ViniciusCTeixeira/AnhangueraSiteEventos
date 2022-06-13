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
<div class="alert alert-danger fade show" role="alert">
    <div class="container">
        <i class="fa-duotone fa-bug"></i>
        <?= $message ?>
    </div>
</div>
