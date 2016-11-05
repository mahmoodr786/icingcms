
<?= $this->Form->create() ?>
<div class="settings col-lg-8 col-md-8 col-sm-8 col-xs-12">
    <fieldset>
        <legend><?= __('Edit Setting') ?></legend>
        <?php foreach ($settings as $setting):?>
            <?php
                $attrs = $this->Icing->HTMLAttrsToArray($setting->input_params);
                $attrs['label'] = $setting->title;
                $attrs['val'] = $setting->val;
                $key = explode('.', $setting->key);
            ?>
            <div class="form-group">
                <?= $this->Form->input($setting->key, $attrs); ?>
                <?= $this->Form->input('ids.' . $key[1], ['type' => 'hidden', 'value' => $setting->id]); ?>
                <?= $setting->help; ?>
            </div>
        <?php endforeach;?>
    </fieldset>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <button class="btn btn-success" type="submit">Save</button>
    <?= $this->Html->link(__('Cancel'), ['action' => 'view', $this->Icing->parentKey($setting->key)], ['class' => 'btn btn-danger']);?>
</div>
<?= $this->Form->end() ?>