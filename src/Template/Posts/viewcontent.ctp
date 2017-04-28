<?php $this->layout = 'default';?>
<div class="modal-header" style="padding:35px 50px;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4><span class="glyphicon glyphicon-sunglasses"></span>
        <?=$this->Html->link( " ". $post->title, ['controller' => 'Posts', 'action' => 'viewcontent', $post->id]) ?>
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
    <input id="user" type="hidden" value="<?=$username?>"/>
    <input class="c-c4 btn btn-link" type="button" onclick="replyComment(this, 0)" value="Comment"/>
    <?= $this->Form->create('comment', array('id'=>'commentForm','style'=>'display:none')) ?>
    <fieldset>
        <legend class="c-b"><?=$username?></legend>
        <input type="hidden" name="postId" id="postId" value="<?=$post->id?>"/>
        <input type="hidden" name="parent_id" id="parent_id" value=''>
        <?= $this->Form->input('content', array('type'=>'textArea'));?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
<script> var myUrl='<?=$this->Url->build('/') ?>'</script>
<?= $this->Html->script('comment.js') ?>
</div>