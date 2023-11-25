<div class="row">
    <div class="column column-100">
        <div class="phoneNumbers form content">
            <?= $this->Form->create($phoneNumber) ?>
            <fieldset>
                <legend><?= __('Edit Phone Number') ?></legend>
                <?php
                    echo $this->Form->control('user_id');
                    echo $this->Form->control('phone_number');
                    echo $this->Form->control('type');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?php echo $this->Html->link(__('Cancel'), ['controller' => 'Users', 'action' => 'view', $phoneNumber->user->slug], ['class' => 'button']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
