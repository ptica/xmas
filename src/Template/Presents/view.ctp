<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Present'), ['action' => 'edit', $present->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Present'), ['action' => 'delete', $present->id], ['confirm' => __('Are you sure you want to delete # {0}?', $present->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Presents'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Present'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="presents view large-9 medium-8 columns content">
    <h3><?= h($present->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($present->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($present->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $present->has('user') ? $this->Html->link($present->user->id, ['controller' => 'Users', 'action' => 'view', $present->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($present->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($present->created) ?></td>
        </tr>
    </table>
</div>
