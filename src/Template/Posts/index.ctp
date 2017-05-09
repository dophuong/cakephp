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
                <li><?= $this->Html->link(__('Home'), ['controller' => 'pages', 'action' => 'display']) ?> </li>
                <li><?= $this->Html->link(__('New Post'), ['action' => 'addpost']) ?></li>
                <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
                <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
                <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
            <h1 class="page-header text-info">Posts</h1>
            <div class="table-responsive table">
                <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('cat_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('images') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('is_private') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= $this->Number->format($post->id) ?></td>
                        <td><?= $post->has('user') ? $this->Html->link($post->user->id, ['controller' => 'Users', 'action' => 'view', $post->user->id]) : '' ?></td>
                        <td><?= $post->has('category') ? $this->Html->link($post->category->title, ['controller' => 'Categories', 'action' => 'view', $post->category->id]) : '' ?></td>
                        <td><?= h($post->title) ?></td>
                        <td><?= h($post->slug) ?></td>
                        <td><?= h($post->images) ?></td>
                        <td><?= $this->Number->format($post->is_private) ?></td>
                        <td><?= h($post->created) ?></td>
                        <td><?= h($post->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $post->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $post->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $post->id], ['confirm' => __('Are you sure you want to delete # {0}?', $post->id)]) ?>
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