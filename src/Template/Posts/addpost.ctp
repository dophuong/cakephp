<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php $this->layout = 'default';?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display']) ?></li>
                <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
        <?= $this->Form->create($post,array(['file' => 'type'])) ?>
        <fieldset>
            <h1 class="page-header text-info">Add posts</h1>
            <div class="form-group">
            <?= $this->Form->control('cat_id', ['class'=>'form-control','options' => $categories]);?>
            </div>
            <div class="form-group">
            <?= $this->Form->control('title',['class'=>'form-control']);?>
            </div>
            <div class="form-group">
            <?= $this->Form->control('slug',['class'=>'form-control']);?>
            </div>
            <div class="form-group">
            <?= $this->Form->control('summary',['class'=>'form-control']);?>
            </div>
            <div class="form-group">
            <?= $this->Form->control('content',['class'=>'form-control']);?>
            </div>
            <div class="form-group">
            <?= $this->Form->control('image',['type' => 'file']);?>
            </div>
            <div class="form-group">
            <?= $this->Form->control('is_private',['class'=>'form-control','options'=>[0,1]]);?>
            </div>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
        </div>
    </div>
</div>