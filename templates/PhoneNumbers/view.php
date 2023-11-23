<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Phone Number'), ['action' => 'edit', $phoneNumber->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Phone Numbers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="phoneNumbers view content">
            <h3><?= h($phoneNumber->phone_number) ?></h3>
            <table>
                <tr>
                    <th><?= __('Phone Number') ?></th>
                    <td><?= h($phoneNumber->phone_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($phoneNumber->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Id') ?></th>
                    <td><?= $this->Number->format($phoneNumber->user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($phoneNumber->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($phoneNumber->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
