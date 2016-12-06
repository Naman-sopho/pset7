<form action="change_password.php" method="POST">
    <div class="form-group">
        <input class="form-control" name="current_password" placeholder="Current Password" type="password"/><br/><br>
        <input class="form-control" name="new_password" placeholder="New Password" type="password"/><br/>
        <input class="form-control" name="confirmation" placeholder="Confirm New Password" type="password"/>
    </div>
    
    <div class="form-group">
        <button class="btn btn-default" type="submit">
            <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
            Change Password
        </button>
    </div>
</form>