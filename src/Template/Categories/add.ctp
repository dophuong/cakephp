<?php
/**
  * @var \App\View\AppView $this
  */
$this->layout = 'default';
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display']) ?></li>
                <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'addpost']) ?> </li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
            <?= $this->Form->create($category) ?>
            <fieldset>
                <legend><?= __('Add Category') ?></legend>
                <div class="form-group">
                    <?= $this->Form->control('title',['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('slug',['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('parent_id', ['class'=>'form-control', 'options' => $parentCategories]);?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('description',['class'=>'form-control']);?>
                </div>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>