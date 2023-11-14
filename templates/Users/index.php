<div class="users index content">
  <?php echo $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
  <h3><?php echo __('Users') ?></h3>
  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th><?php echo $this->Paginator->sort('first_name', 'Name') ?></th>
          <th><?php echo $this->Paginator->sort('username') ?></th>
          <th><?php echo $this->Paginator->sort('email') ?></th>
          <th><?php echo $this->Paginator->sort('role') ?></th>
          <th class="actions"><?php echo __('Actions') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
          <td><?php echo $this->Html->link($user->full_name, ['action' => 'view', $user->slug]) ?></td>
          <td><?php echo h($user->username) ?></td>
          <td><?php echo $this->Text->autoLinkEmails($user->email) ?></td>
          <td><?php echo h($user->role) ?></td>
          <td class="actions">
            <?php echo $this->Html->link(__('View'), ['action' => 'view', $user->slug]) ?>
            <?php echo $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="paginator">
    <ul class="pagination">
      <?php echo $this->Paginator->first('<< ' . __('first')) ?>
      <?php echo $this->Paginator->prev('< ' . __('previous')) ?>
      <?php echo $this->Paginator->numbers() ?>
      <?php echo $this->Paginator->next(__('next') . ' >') ?>
      <?php echo $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p>Page <?php echo $this->Paginator->counter() ?></p>
  </div>
</div>