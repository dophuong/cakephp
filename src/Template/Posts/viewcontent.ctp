<?php $this->layout = 'homelayout';?>
<div class="modal-header" style="padding:35px 50px;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4><span class="glyphicon glyphicon-sunglasses"></span><?=$this->Html->link( " ". $post->title, ['controller' => 'Posts', 'action' => 'viewcontent', $post->id]) ?>
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
    <hr>

        <div class="form-group" id="divComment"></div>

        <div id="c-c2">
            <?= $this->Form->create('comment', array('url' => array('controller'=>'Comments','action'=>'add', $post->id),'id'=>'commentForm')) ?>
            <fieldset>
                <legend><?= __('Add Comment') ?></legend>
                <div id="parent_id"></div>
                <?= $this->Form->control('author');?>
                <?=$this->Form->control('content');?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>

    <?= $this->Form->create('comment', array('url' => array('controller'=>'Comments','action'=>'add', $post->id),'id'=>'commentForm')) ?>
    <fieldset>
        <legend class="c-b"><?=$username?></legend>
        <input type="hidden" name="post_id" id="post_id" value="<?=$post->id?>"/>
        <?php
        echo $this->Form->input('parent_id',array('type' => 'hidden', 'default' => 0));
        echo $this->Form->input('content', array('type'=>'textarea'));?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
<script> var myUrl='<?=$this->Url->build('/') ?>'</script>
<?= $this->Html->script('comment.js') ?>
</div>