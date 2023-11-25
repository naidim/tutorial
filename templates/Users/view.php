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
          <th><?php echo __('Date of Birth (age)') ?></th>
          <td><?php echo h($user->dob) . " ($user->age)" ?></td>
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
      <div class="related">
        <?php echo $this->Html->link(__('New Phone Number'), ['controller' => 'phone_numbers', 'action' => 'add', $user->id], ['class' => 'button float-right']) ?>
        <h4><?php echo __('Phone Numbers') ?></h4>
        <?php if (!empty($user->phone_numbers)) : ?>
        <div class="table-responsive">
          <table>
            <tr>
              <th><?php echo __('Type') ?></th>
              <th><?php echo __('Number') ?></th>
              <th class="actions"><?php echo __('Actions') ?></th>
            </tr>
            <?php foreach ($user->phone_numbers as $phone_number) : ?>
            <tr>
              <td><?php echo h($phone_number->type) ?></td>
              <td><?php echo h($phone_number->phone_number) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Edit'), ['controller' => 'PhoneNumbers', 'action' => 'edit', $phone_number->id]) ?> |
                <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'PhoneNumbers', 'action' => 'delete', $phone_number->id], ['confirm' => __('Are you sure you want to delete # {0}?', $phone_number->phone_number)]) ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </table>
        </div>
        <?php endif; ?>
      </div>
      <div class="related">
    <?php echo $this->Html->link(__('New Document'), ['controller' => 'Documents', 'action' => 'add', $user->id], ['class' => 'button float-right']) ?>
    <h3><?php echo __('Documents') ?></h3>
    <?php if (!empty($user->documents)): ?>
      <div class="table-responsive">
        <table>
          <tr>
            <th><?php echo __('Name') ?>
            <th><?php echo __('Description') ?>
            <th class="actions"><?php echo __('Actions') ?>
          </tr>
          <?php foreach ($user->documents as $document): ?>
          <tr>
            <td><?php echo $this->Html->link($document->name, '/files/' . $document->filename) ?>
            <td><?php echo h($document->description) ?></td>
            <td class="actions">
              <?php echo $this->Html->link(__('View'), '/files/' . $document->filename) ?> |
              <?php echo $this->Form->postLink(__('Delete'), ['controller' => 'Documents', 'action' => 'delete', $document->id], ['confirm' => __('Are you sure you want to delete {0}?', $document->name)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </table>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>