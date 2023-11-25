<?php $this->assign('title', 'Add Phone Number'); ?>
<div class="row">
    <div class="column column-80">
        <div class="phoneNumbers form content">
            <?= $this->Form->create($phoneNumber) ?>
            <fieldset>
                <legend><?= __('Add Phone Number') ?></legend>
                <?php
                    echo $this->Form->control('user_id');
                    echo $this->Form->control('phone_number');
                    echo $this->Form->control('type');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'button']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
