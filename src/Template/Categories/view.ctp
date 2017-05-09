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
                <li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id]) ?> </li>
                <li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?> </li>
                <li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
                <li><?= $this->Html->link(__('List Parent Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
                <li><?= $this->Html->link(__('New Parent Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10 main">
            <h3 class="page-header text-info">Categories</h3>
            <div class="table table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th scope="row"><?= __('Title') ?></th>
                        <td><?= h($category->title) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Slug') ?></th>
                        <td><?= h($category->slug) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Parent Category') ?></th>
                        <td><?= $category->has('parent_category') ? $this->Html->link($category->parent_category->title, ['controller' => 'Categories', 'action' => 'view', $category->parent_category->id]) : '' ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($category->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($category->created) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($category->modified) ?></td>
                    </tr>
                </table>
            </div>
                <h3 class="page-header text-info">Description</h3>
                <?= $this->Text->autoParagraph(h($category->description)); ?>
            <div class="table table-responsive">
                    <h3 class="sub-header">Related Categories</h3>
                    <?php if (!empty($category->child_categories)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-condensed">
                                <tr>
                                    <th scope="col"><?= __('Id') ?></th>
                                    <th scope="col"><?= __('Title') ?></th>
                                    <th scope="col"><?= __('Slug') ?></th>
                                    <th scope="col"><?= __('Parent Id') ?></th>
                                    <th scope="col"><?= __('Description') ?></th>
                                    <th scope="col"><?= __('Created') ?></th>
                                    <th scope="col"><?= __('Modified') ?></th>
                                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                                </tr>
                                <?php foreach ($category->child_categories as $childCategories): ?>
                                    <tr>
                                        <td><?= h($childCategories->id) ?></td>
                                        <td><?= h($childCategories->title) ?></td>
                                        <td><?= h($childCategories->slug) ?></td>
                                        <td><?= h($childCategories->parent_id) ?></td>
                                        <td><?= h($childCategories->description) ?></td>
                                        <td><?= h($childCategories->created) ?></td>
                                        <td><?= h($childCategories->modified) ?></td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('View'), ['controller' => 'Categories', 'action' => 'view', $childCategories->id]) ?>
                                            <?= $this->Html->link(__('Edit'), ['controller' => 'Categories', 'action' => 'edit', $childCategories->id]) ?>
                                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Categories', 'action' => 'delete', $childCategories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childCategories->id)]) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</div>
