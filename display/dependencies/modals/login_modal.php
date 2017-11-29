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
        var loginUserName = $('#loginUserName').val();
        var pass = $('#loginPassWord').val();
        if(pass === ""){
            document.getElementById('msgReg').innerHTML = "Password Fields cannot be empty.";
            event.preventDefault();
            return false;
        }
        if(loginUserName === ""){
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
            <div id="msgReg"></div>
            <div class="modal-body">
                <form name="loginForm" id="loginForm" method="POST" action="~../../index.php" onsubmit="validateForm(event)" novalidate="novalidate">
                    <div class="form-group">
                        <label for="loginUserName" class="control-label">Username</label>
                        <input type="text" class="form-control" id="loginUserName" name="loginUserName" value="" required=""
                               title="Please enter you loginUserName" placeholder="username">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="loginPassWord" class="control-label">Password</label>
                        <input type="password" class="form-control" id="loginPassWord" name="loginPassWord" value="" required=""
                               title="Please enter your loginPassWord" placeholder="Password">
                        <span class="help-block"></span>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
