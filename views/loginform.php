<div class = "container" style = "margin-top:30px">
    <div class = "col-md-4 col-md-offset-4">
        <h1>SMUXtremists Members Arena</h1>
        <br>
        <div class = "panel panel-default">
            <div class = "panel-heading">
                <h3 class = "panel-title"><strong>Sign in </strong></h3></div>
            <div class = "panel-body">

                <form method="post" action="index.php" name="loginform">
                    <div class = "form-group">
                        <label for = "smu_email">Email Address</label>
                        <input type = "text" id = "user_name" name = "smu_email" class = "form-control" style = "border-radius:0px" placeholder = "Enter email">
                    </div>
                    <div class = "form-group">
                        <label for = "password">Password</label>
                        <input type = "password" id = "user_password" name = "user_password" class = "form-control" style = "border-radius:0px"  placeholder = "Password">
                    </div>
                    <div class="checkbox">
                        <label for = "user_rememberme">Keep Me Logged In for 2 Weeks (-FIX THIS)</label>
                        <input type="checkbox" id = "user_rememberme" name = "user_rememberme" value="1">

                    </div>


                    <button type = "submit" name="login" class = "btn btn-lg btn-success btn-block">Sign in</button>
                </form>



            </div>

            <div class = "panel-body">

                <strong><a href = "MemberPages/ApplySmuxMembership.php">Not a member? Apply now!</a></strong>
                <br>
                <strong><a href = "/MemberPages/ForgotPassword">Forgot Password</a></strong>
            </div>

        </div>
    </div>
</div>