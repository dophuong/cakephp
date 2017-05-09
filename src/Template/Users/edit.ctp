<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php $this->layout = 'default';?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <div class="nav nav-sidebar">
                <li><?= $this->Html->link(__('Home'), ['controller'=>'pages', 'action' => 'display']) ?> </li>
                <li><?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $user->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
                    )
                    ?></li>
                <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
                <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'addpost']) ?> </li>
                <li><?= $this->Html->link(__('List Category'), ['controller' => 'Categories', 'action' => 'view']) ?></li>
                <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= __('Edit User') ?></legend>
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
            <?= $this->Form->button(__('Submit'),['class'=>'btn btn-primary']) ?>

        </fieldset>
        <?= $this->Form->end() ?>
    </div>
