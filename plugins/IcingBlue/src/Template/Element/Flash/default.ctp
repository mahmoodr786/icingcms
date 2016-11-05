<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="alert alert-info <?= h($class) ?>" role="alert"> <?= h($message) ?> </div>