<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $phoneNumber->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $phoneNumber->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Phone Numbers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
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
            <?php echo $this->Html->link(__('Cancel'), ['action' => 'view', $phoneNumber->id], ['class' => 'button']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
