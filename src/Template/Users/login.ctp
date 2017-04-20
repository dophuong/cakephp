<div class="modal-header" style="padding:35px 50px;">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
</div>
<div class="modal-body" style="padding:40px 50px;">
    <form role="form" method="post" id="loginForm" action="/users/login">
        <div class="form-group">
            <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
            <input type="text" class="form-control" id="usrname" name="username" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
            <input type="password" class="form-control" id="psw" name="password" placeholder="Enter password" required>
        </div>
        <div class="checkbox">
            <label><input type="checkbox" value="" checked> Remember me</label>
        </div>
        <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login
        </button>
    </form>
</div>
<div class="modal-footer">

    <p>Not a member? <?= $this->Html->link(__('Register'), ['controller' => 'Users', 'action' => 'register'])?></p>
</div>
<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        $('#loginForm').validator();-->
<!--    });-->
<!--    })-->
<!--    ;-->
<!--</script>-->
