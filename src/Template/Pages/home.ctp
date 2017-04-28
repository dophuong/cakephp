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
</header>
    <div class="col-sm-1"></div>
    <div class="column large-6">
        <h4>Categories</h4>
        <?php foreach($post->toArray() as $p):?>
                <div class="col-sm-3">
                    <div class="p-img">
                        <img src="<?= '/img/upload'.$p->images?>" class="img-thumbnail" />
                    </div>
                </div>
                <div class="col-sm-9" >
                        <h5><a href="posts/viewcontent/<?=$p->id?>" data-target="#modalPost" data-toggle="modal"><?=$p->title?></a>
                            <div class="modal fade text-center" id="modalPost">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    </div>
                                </div>
                            </div>
                        </h5>
                            <?= $this->Text->truncate($p->content, 200, ['ellipsis' => '...', 'exact' => false]);?>
                            <a href="posts/viewcontent/<?=$p->id?>" data-target="#modalPost" data-toggle="modal">Read more</a>
                        <div class="pa">
                            <p align="right">Author :  <?=$p->user->username?></p>
                            <p align="right">Created date : <?=$p->created?></p>
                        </div>
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


