<?php
/**
 * Created by IntelliJ IDEA.
 * User: howor
 * Date: 09/11/2017
 * Time: 13:20
 */
?>

<script>
    function validateForm(event){
        var username = $('#username').val();
        var pass = $('#password').val();

        if(pass === ""){
            document.getElementById('msgReg').innerHTML = "Password cannot be empty.";
            event.preventDefault();
            return false;
        }
        if(username === ""){
            document.getElementById('msgReg').innerHTML = "User name cannot be empty.";
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>

<!-- Modal -->
<div id="login_box" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id=" loginForm" method="POST" action="~/../dependencies/header.php" onsubmit="validateForm(event)">
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="" required=""
                               title="Please enter you username" placeholder="example@gmail.com">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="" required=""
                               title="Please enter your password" placeholder="Password">
                        <span class="help-block"></span>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" id="remember"> Remember login
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Login</button>
                    <a href="" class="btn btn-default btn-block">Forgotten password</a>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
