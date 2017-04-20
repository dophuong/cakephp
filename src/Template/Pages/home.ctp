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

$this->layout = 'homelayout';

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;

?>

<header class="row">
    
    <div class="header-title">
        <h5 align="right"> <?=$this->Html->link('Home', ['controller' => 'Pages', 'action' => 'display']) .' | '?>
            <?php if($username!=null) {
            echo $this->Html->link($username, ['controller' => 'Users', 'action' => 'view', $id]) .' | ';
         echo $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']);
            }else{
//                echo $this->Html->link(__('login'), ['controller' => 'Users', 'action' => 'login']);
                ?>
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
<!--        $this->request->session()->read('Auth.Users.username')!= null-->
        <h1> PhuongDo' Blog</h1>
    </div>
</header>
<div class="row">
    <div class="col-sm-2"></div>
    <div class="columns large-6">
        <h4>Categories</h4>
                <?php
                foreach($post->toArray() as $p):
                    if($p->images ) {
                        ?>
                        <h5><img src="<?= '/img/upload'.$p->images?>" width="70px"/>
                            <!--                             $this->Html->link($p->title, ['controller' => 'Posts', 'action' => 'viewcontent', $p->id]) ?>-->
                            <a href="posts/viewcontent/<?=$p->id?>" data-target="#modalPost" data-toggle="modal"><?=$p->title?></a>
                            <div class="modal fade text-center" id="modalPost">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    </div>
                                </div>
                            </div>
                        </h5>
                        <?= $this->Text->truncate($p->content, 200, ['ellipsis' => '...', 'exact' => false]);?>
                        <a href="posts/viewcontent/<?=$p->id?>" data-target="#modalPost" data-toggle="modal">Read more</a>
                        <br/>
                        <p align="right">Author :  <?=$p->user->username?></p>
                        <p align="right">Created date : <?=$p->created?></p>
                        <?php
                    }else{?>
                        <h5>
                            <!--                         $this->Html->link($p->title, ['controller' => 'Posts', 'action' => 'viewcontent', $p->id]) ?>-->
                            <a href="posts/view/<?=$p->id?>" data-target="#modalPost" data-toggle="modal"><?=$p->title?></a>
                        </h5>
                        <p align="right">Author :  <?=$p->user->username?></p>
                        <p align="right">Created date : <?=$p->created?></p>
                    <?php }endforeach;?>
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
    <div class="col-sm-1"></div>
    <div class="columns large-3">
        <h4>List of users</h4>
        <?php
        foreach ($users as $user):
        $userid = $user->id;
        ?>
        <h5><span class="glyphicon glyphicon-user"></span><?=$this->Html->link(" ".$user->username, ['controller' => 'Posts', 'action' => 'upost', $userid]) ?></h5>
        <?php endforeach;?>
        <div class="p-content p-display-container" style = "max-width: 400px ; max-height: 200px">

            <div class="w3-display-container mySlides">
                <img class="animate-top" src="../img/thac.jpg" style="width:100%">
                <div class="p-container p-display-topright p-black">
                    <a href="https://www.nhk.or.jp/lesson/vietnamese/syllabary/">Học tiếng Nhật</a>
                </div>
            </div>
            <div class="w3-display-container  mySlides">
                <img class="animate-bottom" src="../img/hoa.jpg" style="width:100%">
                <div class="p-container p-display-topright p-black">
                    <a href="http://www.esl-lab.com/">Học tiếng Anh</a>
                </div>
            </div>
            <div class="w3-display-container  mySlides">
                <img class="animate-top" src="../img/uploadbg2.jpg" style="width:100%">
                <div class="p-container p-display-topright p-black">
                    <a href="http://unckel.de/kanateacher/index-en.html">Học tiếng Nhật</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <hr />
    <div class="row" style="height: auto">
        <div class="columns large-12">
            <h3><?=$this->Html->link(_('Add post'), ['controller' => 'Posts', 'action' => 'addpost']) ?> </h3>
        </div>
    </div>
    <?= $this->Html->script('slideimage.js') ?>
    <hr/>
<div class="row">
    <div class="columns large-12 text-center">
        <h3 class="more">More about </h3>
    </div>
</div>
