<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="posts addpost large-9 medium-8 columns content">
    <?= $this->Form->create($post,array(['file' => 'type'])) ?>
    <fieldset>
        <legend><?= __('Add Post') ?></legend>
        <?php
        echo $this->Form->control('cat_id', ['options' => $categories]);
        echo $this->Form->control('title');
        echo $this->Form->control('slug');
        echo $this->Form->control('summary');
        echo $this->Form->control('content');
        echo $this->Form->control('image',['type' => 'file']);
        echo $this->Form->control('is_private',['options'=>[0,1]]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
