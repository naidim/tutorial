<?php $this->assign('title', $user->full_name); ?>
<div class="row">
  <aside class="column">
    <div class="side-nav">
      <h4 class="heading"><?php echo __('Actions') ?></h4>
      <?php echo $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
      <?php echo $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
    </div>
  </aside>
  <div class="column column-80">
    <div class="users view content">
      <h3><?php echo h($user->full_name) ?></h3>
      <table>
        <tr>
          <th><?php echo __('Username') ?></th>
          <td><?php echo h($user->username) ?></td>
        </tr>
        <tr>
          <th><?php echo __('First Name') ?></th>
          <td><?php echo h($user->first_name) ?></td>
        </tr>
        <tr>
          <th><?php echo __('Last Name') ?></th>
          <td><?php echo h($user->last_name) ?></td>
        </tr>
        <tr>
          <th><?php echo __('Email') ?></th>
          <td><?php echo $this->Text->autoLinkEmails($user->email) ?></td>
        </tr>
        <tr>
          <th><?php echo __('Role') ?></th>
          <td><?php echo h($user->role) ?></td>
        </tr>
        <tr>
          <th><?php echo __('Modified') ?></th>
          <td><?php echo h($user->modified) ?></td>
        </tr>
        <tr>
          <th><?php echo __('Created') ?></th>
          <td><?php echo h($user->created) ?></td>
        </tr>
      </table>
    </div>
  </div>
</div>