<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('bootstrap.css') ?>

    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('bootbox.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <script>
        $(document).on("click", ".new-present", function(e) {
            var new_present = $(this).parent().find('.new-present');
            var form = $("<form id='present' method='post' action='/presents/add'></form>");
            var dialog  = $(this);
            var type    = $(this).data('type');
            var user_id = $(this).data('user-id');
            var big_opt   = "<option value='big'>dárek</option>";
            var small_opt = "<option value='small'>drobnost</option>";
            var tip_opt = "<option value='tip'>tip na dárek</option>";
            form.append('<h3>Přidat dárek</h3>');
            form.append("Název: <input name='title' type=text />");
            form.append("Typ: <select name='type'>" + small_opt + big_opt + tip_opt + "</select>");
            form.append("<input name='user_id'  type=hidden value='" + user_id + "' />");
            var box = bootbox.confirm(form, function(result) {
                if (result) {
                    var type  = $('#present [name="type"]').val();
                    var title = $('#present [name="title"]').val();
                    var username = '<?= $this->request->session()->read('Auth.User.name') ?>';
                    var img = $("<img class='present'/>");
                    img.attr('title', title + ' by ' + username);
                    var tx = {
                        'big': '/img/gift-flat/32x32.png',
                        'small': '/img/gift-flat/16x16.png',
                        'tip': '/img/bulb.png'
                    };
                    img.attr('src', tx[type]);
                    $.post(
                        '/presents.json',
                        $('#present').serialize(),
                        function (response) {
                            if (response.message == 'Saved') {
                                new_present.before(img);
                            }
                        }
                    );
                }
            });
            box.on('shown.bs.modal',function(){
                $('#present [name="title"]').focus();
                $('#present [name="type"]').val(type);
            });
        });
   </script>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a href="/users/edit"><?= $this->request->session()->read('Auth.User.name') ?></a></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
