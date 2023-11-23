<?php $this->assign('title', 'Add Phone Number'); ?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Phone Numbers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
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
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
