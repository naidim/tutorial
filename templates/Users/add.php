<?php $this->assign('title', 'Add User'); // Set the title for the page ?>
<div class="row">
  <aside class="column">
    <div class="side-nav">
      <h4 class="heading"><?php echo __('Actions') ?></h4>
      <?php echo $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
    </div>
  </aside>
  <div class="column column-80">
    <div class="users form content">
      <?php echo $this->Form->create($user) ?>
      <fieldset>
        <legend><?php echo __('Add User') ?></legend>
          <?php
            echo $this->Form->control('username', ['autofocus' => true]);
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('password'); ?>
          <p class="helper">Passwords must be at least 8 characters and contain at least 1 number, 1 uppercase, 1 lowercase, and 1 special character</p>
          <?php
            echo $this->Form->control('confirm_password', ['type' => 'password']);
            echo $this->Form->control('email');
            echo $this->Form->control('role');
          ?>
      </fieldset>
      <?php echo $this->Form->button(__('Submit')) ?>
      <?php echo $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'button']); ?>
      <?php echo $this->Form->end() ?>
    </div>
  </div>
</div>