<ul class="nav docs-nav">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#setup">Setup <span class="caret"></span></a>
        <ul class="collapse" id="setup">
            <li>
                <?= $this->Html->link('Installation','/documentation/setup/installation');?>
            </li>
            <li>
                <?= $this->Html->link('Configuration','/docs/setup/config');?>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#core-plugins">Core Plugins <span class="caret"></span></a>
        <ul class="collapse" id="core-plugins">
            <li>
                <?= $this->Html->link('Icing Manager','/docs/core-plugins/icing-manager');?>
            </li>
            <li>
                <?= $this->Html->link('Content Manager','/docs/core-plugins/content-manager');?>
            </li>
            <li>
                <?= $this->Html->link('File Manager','/docs/core-plugins/file-manager');?>
            </li>
            <li>
                <?= $this->Html->link('User Manager','/docs/core-plugins/user-manager');?>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#core-themes">Core Themes <span class="caret"></span></a>
        <ul class="collapse" id="core-themes">
            <li>
                <?= $this->Html->link('Icing Blue','/docs/core-themes/icing-blue');?>
            </li>
            <li>
                <?= $this->Html->link('Icing Red','/docs/core-themes/icing-red');?>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="collapse" data-target="#create-pt">Create Plugins &amp; Themes <span class="caret"></span></a>
        <ul class="collapse" id="create-pt">
            <li>
                <?= $this->Html->link('Plugins','/docs/create/plugin');?>
            </li>
            <li>
                <?= $this->Html->link('Themes','/docs/create/themes');?>
            </li>
        </ul>
    </li>
</ul>