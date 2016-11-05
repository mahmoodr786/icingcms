<?php
$code = $this->Page->ee(
    'code',
    '<div></div><!-- Type your code here -->',
    [
        'type' => 'code',
        'mode' => 'ace/mode/html',
        'theme' => 'ace/theme/iplastic'
    ]
);
?>
<div class="code">
	<p>your code:</p>
	<?=$code;?>
</div>