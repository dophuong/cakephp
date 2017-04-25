/**
 * Created by phuong on 24/04/2017.
 */

$(document).ready(function () {
    loadComment();
    $('#commentForm').submit(function () {
        var formData = $('#commentForm').serialize();
        var formUrl = $(this).attr('action');
        $.ajax({
            type:"POST",
            url:formUrl,
            data:formData,
            success: function (data) {
                loadComment();
            }
        });
        return false;
    });
});

function loadComment() {
    var post_id = $('#post_id').val();
    $.ajax({
        type:"GET",
        url : myUrl+"comments/getcomment/"+post_id+"",
        success: function (data) {
            showComment(data);
        }
    });
    return false;
}
function showComment(data) {
    var html = "";
    var parent = 0;
    data.forEach(function (comment) {
        aut = comment.author;
        cont = comment.content;
        cre = comment.created;
        mod = comment.modified;
        pa = comment.id;
        html1 = '<input type="hidden" name="parent_id" id="parent_id" value="'+pa+'"/>';
        html ='<img src="/img/icon.png" width="30px"/>' +
            '<b class="c-b">'+aut+'   '+'</b>' +
            '<small class="c-small">'+cre+'</small>' +
            '<div class="c-c2">' +
            '<p class="c-c4" style="font-size: 15px; margin: 0px; padding: 0px">'+cont+'</p>' +
            '<button type="button" class="c-c4 btn btn-link">Reply</button>'+
            '<hr /></div>';
        if(comment.parent_id == 0){
            $('#divComment').append(html);
            $('#parent_id').append(html1);
        } else {
            data.forEach(function (children) {
                html = '<div class="c-c2">'+html+'</div>';
            if((children.id == comment.parent_id) && (children.parent_id == 0 )){
                $('#divComment').append(html);
                $('#parent_id').append(html1);
            }
                else if((children.id == comment.parent_id) && (children.parent_id != 0 )){
                html = '<div class="c-c2">'+html+'</div>';
                $('#divComment').append(html);
                $('#parent_id').append(html1);
            }
            });
        }
    })
}

