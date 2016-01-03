<div id="messages">
    <?php if($this->error_msg != null) echo $this->error_msg ?>
</div>
<div>
    <a href="<?php echo $this->getRegisterUrl() ?>">Create an Account</a>
</div>
<div>
    <h2>Login</h2>
    <form id="login-form" action="<?php echo $this->getLoginAction() ?>" method="post">
        <ul>
            <li>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required />
            </li>
            <li>
                <label for="pwd">Password</label>
                <input type="password" name="password" id="pwd" required />
            </li>
            <li>
                <input type="submit" name="login" value="Login" />
            </li>
        </ul>
    </form>
</div>