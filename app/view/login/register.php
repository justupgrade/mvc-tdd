<div>
    <h2>Register</h2>
    <form id="register-form" method="post" action="<?php echo $this->getRegisterAction() ?>">
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
                <label for="repeat-pwd">Repeat Password</label>
                <input type="password" name="password_repeat" id="repeat-pwd" required/>
            </li>
            <li>
                <input type="submit" name="register" value="Send" />
            </li>
        </ul>
    </form>
</div>