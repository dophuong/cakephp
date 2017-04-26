/**
 * Created by phuong on 24/04/2017.
 */

var that = this;
$(document).ready(function(){

    loadComment();
    var $formComment =  $('#commentForm');

    $("#buttonShowForm").click(function() {
        if($('#user').val()){
            $("#commentForm").show();
        }else {
            alert('You have to login before comment !');
            window.location.href = myUrl+'users/login';
        }
    });
    that.replyComment = function (element, parentId) {
        var $reply = $(element);
        if($('#user').val()){
            $formComment.insertAfter($reply);
            $formComment
                .find('#parent_id')
                .val(parentId);
            $formComment.show();

        }else {
            alert('You have to login before comment !');
            window.location.href = myUrl+'users/login';
        }
    }

    $formComment.submit(function () {
        //$formComment.hide();
        var postId = $('#postId').val();
        var formData = $formComment.serialize();
        $.ajax({
            type:"POST",
            url: myUrl + "comments/add/"+postId+"",
            data:formData,
            success: function (data) {
                loadComment();
            }
        });
        return false;
    });



});

function loadComment() {
    var postId = $('#postId').val();
    $.ajax({
        type:"GET",
        url : myUrl+"comments/getComment/"+postId+"",
        success: function (data) {
            $('#divComment').empty();
            $('#divComment').append(treeLine(data));
            // showComment(data);
        }
    });
    return false;
}

//tao cay comment
function treeLine(data){
    var tree = [];
    $.each(data, function(index, comment){
        if(comment.parent_id > 0){
            if(typeof tree[comment.parent_id] !== 'object') { // kiem tra co phai la array, object
                tree[comment.parent_id] = [];
            }
                tree[comment.parent_id].push(comment);
        } else {
            console.log(typeof tree[0]);
            if(typeof tree[0] !== 'object') { // kiem tra co phai la array, object
                tree[0] = [];
            }
            tree[0].push(comment);
        }
    });
console.log(tree);
    return forEachTree(tree, 0, 0);
}

function forEachTree(tree, comment_parent_id, level) {
    var html = '';

    $.each(tree[comment_parent_id], function(index, comment) {
        html += '<div class="c-c2">'.repeat(level);
        html += showCommentTree(tree, comment);
        html += '</div>'.repeat(level);
        html += forEachTree(tree, comment.id, level + 1); // in ra cac con cua comment dang kiem tra
    });

    return html;
}

function showCommentTree(tree, comment) {
    aut = comment.author;
    cont = comment.content;
    cre = comment.created;
    mod = comment.modified;
    pa = comment.id;
    html ='<img src="/img/icon.png" width="30px"/>' +
        '<b class="c-b">'+aut + ' ' + comment.id + ' ' + comment.parent_id +'   '+'</b>' +
        '<small class="c-small">'+cre+'</small>' +
        '<div class="c-c2">' +
        '<p class="c-c4" style="font-size: 15px; margin: 0px; padding: 0px">'+cont+'</p>' +
        '<input class="c-c4 btn btn-link" onclick="replyComment(this, '+pa+')" type="submit" value="Reply"/>'+
        '<hr /></div>';
    return html;
}


function showComment(data) {
    var html = "";
    var parent = 0;
    $('#divComment').empty();
    data.forEach(function (comment) {
        aut = comment.author;
        cont = comment.content;
        cre = comment.created;
        mod = comment.modified;
        pa = comment.id;
        html ='<img src="/img/icon.png" width="30px"/>' +
            '<b class="c-b">'+aut+'   '+'</b>' +
            '<small class="c-small">'+cre+'</small>' +
            '<div class="c-c2">' +
            '<p class="c-c4" style="font-size: 15px; margin: 0px; padding: 0px">'+cont+'</p>' +
            '<input class="c-c4 btn btn-link" onclick="replyComment('+pa+')" type="submit" value="Reply"/>'+
            '<hr /></div>';
        if(comment.parent_id == 0) {
            $('#divComment').append(html);
        }else {
            data.forEach(function (children) {
                html = '<div class="c-c2">'+html+'</div>';
            if((children.id == comment.parent_id) && (children.parent_id == 0 )){
                $('#divComment').append(html);
            }
                else if((children.id == comment.parent_id) && (children.parent_id != 0 )){
                html = '<div class="c-c2">'+html+'</div>';
                $('#divComment').append(html);
            }
            });
        }
    })
}


/**
 * $formComment.insertAfter($reply); // form dc insert  sau Reply
 * $reply.after($formCommet);/// giong nhu o tren
 *
 *
 * $formComment.appendTo($reply); // chen noi dung form comment vao trong reply o cuoi cung
 * $reply.apppend($formComment);
 *
 */
