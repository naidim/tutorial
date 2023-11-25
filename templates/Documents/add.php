<div class="row">
    <div class="column column-100">
        <div class="documents form content">
            <?= $this->Form->create($document, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Document') ?></legend>
                <?php
                    echo $this->Form->hidden('user_id', ['value' => $user_id]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('file', ['type' => 'file', 'required' => true]);
                    echo $this->Form->control('description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Html->link(__('Cancel'), ['controller' => 'Users', 'action' => 'view', $user_id], ['class' => 'button']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
