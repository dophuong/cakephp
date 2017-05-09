<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php $this->layout = 'default'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'addpost']) ?></li>
                <li><?= $this->Html->link(__('List Category'), ['controller' => 'Categories', 'action' => 'view']) ?></li>
                <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <h3 class="page-header text-info">Add users</h3>
                <div class="form-group">
                    <?= $this->Form->control('username',['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('email',['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('password',['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('role',['class'=>'form-control']);?>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>