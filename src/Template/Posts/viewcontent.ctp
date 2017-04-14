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
?>
<body class="home">
            <div class="modal-header" style="padding:35px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-sunglasses"></span><?=$this->Html->link('View post', ['controller' => 'Posts', 'action' => 'viewcontent', $post->id]) ?>
                </h4>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                    <div class="form-group">
                        <h4><?= __('Summary') ?></h4>
                        <?= $this->Text->autoParagraph(h($post->summary)); ?>
                    </div>
                    <div class="form-group">
                        <h4><?= __('Content') ?></h4>
                        <?= $this->Text->autoParagraph(h($post->content)); ?>
                    </div>
            </div>
</body>
</html>
