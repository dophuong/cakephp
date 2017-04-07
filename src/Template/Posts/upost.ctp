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
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('home.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>
<body class="home">

<header class="row">

    <div class="header-title">
        <h5 align="right"><?=$this->Html->link($username, ['controller' => 'Users', 'action' => 'viewuser', $uid]) ?> |  <?=$this->Html->link('home', ['controller' => 'Pages', 'action' => 'display']) ?></h5>
        <h1>PhuongDo' Blog</h1>
    </div>
</header>

<div class="row">
    <div class="columns large-9">
        <h4>Categories</h4>
        <?php
        //debug($post->toArray());

        foreach($post->toArray() as $p):
            ?>
        <h5><img src="<?= '/img/upload'.$p->images?>" width="70px">
            <?=$this->Html->link($p->title, ['controller' => 'Posts', 'action' => 'viewcontent', $p->id]) ?>
        </h5>
            <?='Author : '.$p->user->username.'</br>'; ?>
                <?= 'Created date : '.$p->created.'</br>' ?>
        <?php endforeach;?>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
        </div>
    </div>
    <div class="columns large-3">
        <h4>List of users</h4>
        <?php
        foreach ($users as $user):
            $userid=$user->id;
            ?>
            <h5><?=$this->Html->link($user->username, ['controller' => 'Posts', 'action' => 'upost', $userid]) ?></h5>
        <?php endforeach;?>
    </div>
    <hr />
    <div class="row">
        <div class="columns large-12 text-center">
            <h3 class="more">More about </h3>
        </div>
    </div>

</body>
</html>
