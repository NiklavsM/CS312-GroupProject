<?php
/**
 * Created by IntelliJ IDEA.
 * User: howor
 * Date: 09/11/2017
 * Time: 13:20
 */
?>
<!-- Modal (similiar to fragments in android)-->
<div id="register_box" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="POST" action="" novalidate="novalidate">
                    <div class="form-group">
                        <label for="username" class="control-label">Drivers Licence Number</label>
                        <input type="text" class="form-control" id="DLNumber" name="DLNmuber" value="" required=""
                               title="Please enter your driving licence number" placeholder="XXXXXXXXXXXXXXXXXX">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="username" class="control-label">Email</label>
                        <input type="text" class="form-control" id="username" name="email" value="" required=""
                               title="Please enter you username" placeholder="example@gmail.com">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="" required=""
                               title="Please enter your password" placeholder="Password">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                               required="" title="Please confirm your psasword" placeholder="Confirm password">
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
