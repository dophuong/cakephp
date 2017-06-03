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
$this->layout = 'homeLayout';
?>
<header class="row">
    <div class="container">
        <div class="header-title">
            <div class="p-title">
                <h5 align="right"> <?=$this->Html->link('Home', ['controller' => 'Pages', 'action' => 'display']) .' | '?>
                    <?php if($username!=null) {
                        echo $this->Html->link($username, ['controller' => 'Users', 'action' => 'view', $id]) .' | ';
                        echo $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']);
                    }else
                    { ?>
                        <a href="users/login" data-target="#theModal" data-toggle="modal">Login</a>
                        <div class="modal fade text-center" id="theModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?></h5>
            </div>
            <h1> PhuongDo' Blog</h1>
        </div>
    </div>
</header>
<content class="row">
    <div class="container">
        <div class="col-md-9">
            <h4>Categories</h4>
            <?php foreach($post->toArray() as $p):?>
            <div class="post-item">
                <div class="col-md-3">
                    <div class="p-img">
                        <img src="<?= '/img/upload'.$p->images?>" class="img-thumbnail" />
                    </div>
                </div>
                <div class="col-md-9">
                    <h5><a href="posts/viewcontent/<?=$p->id?>" data-target="#modalPost" data-toggle="modal"><?=$p->title?></a>
                        <div class="modal fade text-center" id="modalPost">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                </div>
                            </div>
                        </div>
                    </h5>
                    <?= $this->Text->truncate($p->content, 100, ['ellipsis' => '...', 'exact' => false]);?>
                    <a href="posts/viewcontent/<?=$p->id?>" data-target="#modalPost" data-toggle="modal">Read more</a>
                    <div class="pa">
                        <p align="right">Author :  <?=$p->user->username?></p>
                        <p align="right">Created date : <?=$p->created?></p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
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
        <div class="col-md-3">
            <h4>List of users</h4>
            <?php
            foreach ($users as $user):
                $userId = $user->id; ?>
                <h5><span
                        class="glyphicon glyphicon-user"></span><?= $this->Html->link(" " . $user->username, ['controller' => 'Posts', 'action' => 'upost', $userId]) ?>
                </h5>
            <?php endforeach; ?>

            <div class="p-content p-display-container" style="max-width: 400px ; max-height: 200px; margin: 0px">

                <div class="w3-display-container mySlides">
                    <img class="animate-top" src="/img/thac.jpg" style="width:100%">
                    <div class="p-container p-display-topright p-black">
                        <a href="https://www.nhk.or.jp/lesson/vietnamese/syllabary/">Học tiếng Nhật</a>
                    </div>
                </div>
                <div class="w3-display-container  mySlides">
                    <img class="animate-bottom" src="/img/hoa.jpg" style="width:100%">
                    <div class="p-container p-display-topright p-black">
                        <a href="http://www.esl-lab.com/">Học tiếng Anh</a>
                    </div>
                </div>
                <div class="w3-display-container  mySlides">
                    <img class="animate-top" src="/img/uploadbg2.jpg" style="width:100%">
                    <div class="p-container p-display-topright p-black">
                        <a href="http://unckel.de/kanateacher/index-en.html">Học tiếng Nhật</a>
                    </div>
                </div>
                <?= $this->Html->script('slideImage.js') ?>
            </div>
        </div>
    </div>
</content>



