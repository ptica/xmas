<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Presents'), ['controller' => 'Presents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Present'), ['controller' => 'Presents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ord') ?></th>
            <td><?= $this->Number->format($user->ord) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Presents') ?></h4>
        <?php if (!empty($user->presents)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->presents as $presents): ?>
            <tr>
                <td><?= h($presents->id) ?></td>
                <td><?= h($presents->title) ?></td>
                <td><?= h($presents->type) ?></td>
                <td><?= h($presents->created) ?></td>
                <td><?= h($presents->user_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Presents', 'action' => 'view', $presents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Presents', 'action' => 'edit', $presents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Presents', 'action' => 'delete', $presents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $presents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
