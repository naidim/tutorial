<?php $this->assign('title', 'Edit User'); ?>
<div class="row">
  <aside class="column">
    <div class="side-nav">
      <h4 class="heading"><?php echo __('Actions') ?></h4>
      <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0} ({1})?', $user->name, $user->id), 'class' => 'side-nav-item']
            ) ?>
      <?php echo $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
    </div>
  </aside>
  <div class="column column-80">
    <div class="users form content">
      <?php echo $this->Form->create($user) ?>
      <fieldset>
        <legend><?php echo __('Edit User') ?></legend>
        <?php
          echo $this->Form->control('username', ['autofocus' => true]);
          echo $this->Form->control('first_name');
          echo $this->Form->control('last_name');
          echo $this->Form->control('password', ['value' => '']);
        ?>
        <p class="helper">Passwords must be at least 8 characters and contain at least 1 number, 1 uppercase, 1 lowercase, and 1 special character</p>
        <?php
          echo $this->Form->control('confirm_password', ['type' => 'password', 'value' => '']);
          echo $this->Form->control('dob', ['label' => 'Date of Birth']);
          echo $this->Form->control('email');
          echo $this->Form->control('modified');
        ?>
      </fieldset>
      <?php echo $this->Form->button(__('Submit')) ?>
      <?php echo $this->Html->link(__('Cancel'), ['action' => 'view', $user->slug], ['class' => 'button']); ?>
      <?php echo $this->Form->end() ?>
      <?php echo $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->full_name), 'class' => 'side-nav-item']) ?>
    </div>
  </div>
</div>