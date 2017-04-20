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
    <h4><?= __('Comments') ?></h4>
            <div id="divComment"></div>
    <?= $this->Form->create('comment', array('url' => array('controller'=>'Comments','action'=>'add', $post->id ),'id'=>'commentForm')) ?>
    <fieldset>
        <legend><?= __('Add Comment') ?></legend>
        <?php
        echo $this->Form->control('author');
        echo $this->Form->control('content');?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<script>
    $(document).ready(function () {
        loadComment();
        $('#commentForm').submit(function () {
            var formData = $('#commentForm').serialize()+"&post_id=<?=$post->id?>";
            var formUrl = $(this).attr('action');
            $.ajax({
                type:"POST",
                url:formUrl,
                data:formData,
                success: function (data) {
              console.log(data);
                    loadComment();
                }
            });
            return false;
        });
    });

    function loadComment() {
        $.ajax({
        type:"GET",
            url:"<?=$this->Url->build(['controller' => 'comments', 'action' => 'getcomment',$post->id]); ?>",
            success: function (data) {
//                console.log(data);
                showComment(data);
            }
        });
        return false;
    }
    function showComment(data) {
        var html = "";
        data.forEach(function (comment) {
            aut = comment.author;
            cont = comment.content;
            cre = comment.created;
            console.log(cre);
            mod = comment.modified;
//            console.log(cont);
            html ='<fieldset><legend style="color: #2a6496 ; font-size: 20px">'+aut+'  <p style="font-size: small"> '+cre+'</p></legend><p>'+cont+'</p></fieldset>';
            $('#divComment').append(html);
        })
    }
</script>
