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
$Description = "PhuongDo' Blog";
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>
        <?= $Description ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('home.css') ?>
    <?= $this->Html->css('mycss.css') ?>
    <?= $this->Html->css('comment.css') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>
<body>
    <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    <div class="container">
    <hr/>
    <div class="row">
        <div class="columns large-12">
            <h3><?= $this->Html->link(_('Add post'), ['controller' => 'Posts', 'action' => 'addpost']) ?> </h3>
        </div>
    </div>
    <hr/>
        <footer>
            <div class="row">
                <div class="columns large-12 text-center">
                    <h3 class="more">More about </h3>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
