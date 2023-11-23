<div class="phoneNumbers index content">
    <?= $this->Html->link(__('New Phone Number'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Phone Numbers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('phone_number') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($phoneNumbers as $phoneNumber): ?>
                <tr>
                    <td><?= $phoneNumber->user->full_name ?></td>
                    <td><?= h($phoneNumber->phone_number) ?></td>
                    <td><?= h($phoneNumber->type) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $phoneNumber->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $phoneNumber->id]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
