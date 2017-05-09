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
                <li><?= $this->Html->link(__('Home'), ['controller'=>'pages', 'action' => 'display']) ?> </li>
                <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Post'), ['action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
            <h3 class="page-header text-info">Categories</h3>
            <div class="table">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $this->Number->format($category->id) ?></td>
                        <td><?= h($category->title) ?></td>
                        <td><?= h($category->slug) ?></td>
                        <td><?= $category->has('parent_category') ? $this->Html->link($category->parent_category->title, ['controller' => 'Categories', 'action' => 'view', $category->parent_category->id]) : '' ?></td>
                        <td><?= h($category->created) ?></td>
                        <td><?= h($category->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $category->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $category->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            </div>
            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->first('<< ' . __('first')) ?>
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                    <?= $this->Paginator->last(__('last') . ' >>') ?>
                </ul>
                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
            </div>
        </div>
    </div>
</div>
