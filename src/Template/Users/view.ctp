<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php $this->layout = 'default';?>
<div class="container-fluid">
    <div class="row ">
        <div class="col-sm-3 col-md-2 sidebar">
            <?php
            if($user->role == 1){?>
                <ul class="nav nav-sidebar">
                    <li><?= $this->Html->link(__('Home'), ['controller'=>'pages', 'action' => 'display']) ?> </li>
                    <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
                    <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
                    <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
                    <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
                    <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
                    <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'addpost']) ?> </li>
                    <li><?= $this->Html->link(__('List Category'), ['controller' => 'Categories', 'action' => 'view']) ?></li>
                    <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
                </ul>
            <?php } else{?>
                <ul class="nav nav-sidebar">
                    <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
                    <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'addpost']) ?> </li>
                    <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
                </ul>
            <?php } ?>
        </div>
    <div class="col-sm-9 col-md-10 main">
        <h1 class="page-header text-info">User profile</h1>
            <div class="table">
                <table class="table table-striped">
                    <tr>
                        <th scope="row"><?= __('Username') ?></th>
                        <td><?= h($user->username) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Email') ?></th>
                        <td><?= h($user->email) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Role') ?></th>
                        <td><?= h($user->role) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($user->created) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($user->modified) ?></td>
                    </tr>
                </table>
            </div>
        <div class="table-responsive">
            <h2 class="sub-header">Related Posts</h2>
            <div class="table">
                <?php if (!empty($user->posts)): ?>
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>User Id</th>
                            <th>Cat Id</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Summary</th>
                            <th>Images</th>
                            <th>Is Private</th>
                            <th>Created</th>
                            <th>Modified</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($user->posts as $posts): ?>
                            <tr>
                                <td><?= h($posts->id) ?></td>
                                <td><?= h($posts->user_id) ?></td>
                                <td><?= h($posts->cat_id) ?></td>
                                <td><?= h($posts->title) ?></td>
                                <td><?= h($posts->slug) ?></td>
                                <td><?= h($posts->summary) ?></td>
                                <td><?= h($posts->images) ?></td>
                                <td><?= h($posts->is_private) ?></td>
                                <td><?= h($posts->created) ?></td>
                                <td><?= h($posts->modified) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['controller' => 'Posts', 'action' => 'view', $posts->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'Posts', 'action' => 'edit', $posts->id]) ?>
                                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Posts', 'action' => 'delete', $posts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $posts->id)]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>
</div>
