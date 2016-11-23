<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('darujete') ?></li>
        <?php
            foreach ($user->given as $present) {
                if ($present->type != 'tip') {
                    $title = $present->title . ' pro ' . $present->user->name;
                    $link = $this->Form->postLink(
                        __('x'),
                        ['controller' => 'presents', 'action' => 'delete', $present->id],
                        ['confirm' => __('Opravdu smazat {0}?', $title)]
                    );
                    echo $this->Html->tag('li', $link . $title);
                }
            }
        ?>
        <li class="heading"><?= __('tipujete') ?></li>
        <?php
            foreach ($user->given as $present) {
                if ($present->type == 'tip') {
                    $title = $present->title . ' pro ' . $present->user->name;
                    $link = $this->Form->postLink(
                        __('x'),
                        ['controller' => 'presents', 'action' => 'delete', $present->id],
                        ['confirm' => __('Opravdu smazat {0}?', $title)]
                    );
                    echo $this->Html->tag('li', $link . $title);
                }
            }
        ?>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Upravit') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('email');
            echo $this->Form->input('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
