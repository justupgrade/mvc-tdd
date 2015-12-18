<div>
    <h2>Delete</h2>
    <form id="login-form" action="<?php echo $this->getDeleteAction() ?>" method="post">
        <ul>
            <li>
                <input type="text" name="email" id="email" />
            </li>
            <li>
                <label for="pwd">Password</label>
                <input type="password" name="password" id="pwd" required />
            </li>
            <li>
                <input type="submit" name="delete" value="Delete" />
            </li>
        </ul>
    </form>
</div>