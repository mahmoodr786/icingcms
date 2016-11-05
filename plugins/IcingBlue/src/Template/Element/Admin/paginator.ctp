<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('<i class="fa fa-chevron-left" aria-hidden="true"></i>',['escape' => false]) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('<i class="fa fa-chevron-right" aria-hidden="true"></i>',['escape' => false]) ?>
    </ul>
    <p>Page <?= $this->Paginator->counter() ?></p>
</div>