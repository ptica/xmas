<?php
    $current_user = $this->request->session()->read('Auth.User');
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Dárky') ?></h3>
    <table cellpadding="0" cellspacing="0" class="year">
        <thead>
            <tr>
                <th scope="col" style="width:140px"><?= $this->Paginator->sort('name', 'komu') ?></th>
                <th scope="col">seznam</th>
                <th scope="col">tipy na dárek</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td class="cc"><?= h($user->name) ?></td>
                <td>
                    <?php
                        foreach ($user->presents as $present) {
                            if ($present->type != 'tip') {
                                $tx = [
                                    'big' => 'gift-flat/32x32.png',
                                    'small' => 'gift-flat/16x16.png',
                                ];
                                $image = @$tx[$present->type];
                                $tx = [
                                    'big'   => $present->title . ' od ' . $present->giver->name,
                                    'small' => $present->title . ' od ' . $present->giver->name,
                                ];
                                $title = $present->title . ' od ' . $present->giver->name;
                                if ($user->id == $current_user['id']) $title = 'překvapení!';
                                echo $this->Html->image($image, [
                                    'title' => $title,
                                    'class' => 'present',
                                ]);
                            }
                        }
                        echo $this->Html->image('plus.png', [
                            'title' => 'přidat',
                            'class' => 'new-present',
                            'data-user-id' => $user->id,
                            'data-type' => 'big'
                        ]);
                    ?>
                </td>
                <td>
                    <?php
                        foreach ($user->presents as $present) {
                            if ($present->type == 'tip') {
                                $tx = [
                                    'tip' => 'bulb.png',
                                ];
                                $image = @$tx[$present->type];
                                $tx = [
                                    'tip'   => 'tip na dárek: ' . $present->title . ' od ' . $present->giver->name,
                                ];
                                $title = $present->title . ' by ' . $present->giver->name;
                                if ($user->id == $current_user['id']) $title = 'překvapení!';
                                echo $this->Html->image($image, [
                                    'title' => $title,
                                    'class' => 'present',
                                ]);
                            }
                        }
                        echo $this->Html->image('plus.png', [
                            'title' => 'přidat',
                            'class' => 'new-present',
                            'data-user-id' => $user->id,
                            'data-type' => 'tip'
                        ]);
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
