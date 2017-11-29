<?php
/**
 * Created by IntelliJ IDEA.
 * User: howor
 * Date: 09/11/2017
 * Time: 13:20
 */
?>

<script>
    function registerValidateForm(event){
        var username = $('#username').val();
        var pass = $('#password').val();
        var confrmPass = $('#confirmPassword').val();

        console.log("This is a log");
        if(pass !== confrmPass){
            document.getElementById('msgReg').innerHTML = "Passwords do not match.";
            event.preventDefault();
            return false;
        }
        if(pass === "" || confrmPass === ""){
            document.getElementById('msgReg').innerHTML = "Password and Confirm Password Fields cannot be empty.";
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
<!-- Modal (similiar to fragments in android)-->
<div id="register_box" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="msgReg"></div>
                <form id="registerForm" method="POST" action="~../../index.php" onsubmit="registerValidateForm(event)" novalidate="novalidate">
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="" required=""
                               title="Please enter you username" placeholder="Username">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="" required=""
                               title="Please enter your password" placeholder="Password">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                               required="" title="Please confirm your password" placeholder="Confirm password">
                        <span class="help-block"></span>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Register</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
