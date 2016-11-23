<?php
    $current_user = $this->request->session()->read('Auth.User');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Present'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="presents index large-9 medium-8 columns content">
    <h3><?= __('Presents') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($presents as $present): ?>
            <tr>
                <td><?= $this->Number->format($present->id) ?></td>
                <td>
                    <?php
                        $title = $present->title;
                        if ($present->user_id == $current_user['id']) $title = 'překvapení!';
                        echo h($title);
                    ?>
                </td>
                <td><?= h($present->type) ?></td>
                <td><?= h($present->created) ?></td>
                <td><?= $present->has('user') ? $this->Html->link($present->user->id, ['controller' => 'Users', 'action' => 'view', $present->user->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $present->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $present->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $present->id], ['confirm' => __('Are you sure you want to delete # {0}?', $present->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
