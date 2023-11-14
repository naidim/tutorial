<?php $this->assign('title', 'Login'); ?>
<div class="users form content">
  <h3>Login</h3>
  <?php echo $this->Form->create(); ?>
  <fieldset>
    <?php echo $this->Form->control('username', ['required' => true, 'autofocus' => true]) ?>
    <?php echo $this->Form->control('password', ['required' => true]) ?>
    <?php echo $this->Html->link(__('Forgot Password?'), ['action' => 'password']) ?>
  </fieldset>
  <?php echo $this->Form->submit(__('Login')); ?>
  <?php echo $this->Form->end() ?>
</div>