<div class="page-header">
    <h1>This is account page!</h1>
</div>
<div>
    <form id="account-form" method="post" action="/dashboard/changeEmailAjax">
        <label for="new_email">Email address</label>
        <input id="new_email" name="new_email" type="email" value="<?php echo $this->user->getEmail() ?>" />
        <hr>
        <input type="submit" name="update" value="Update" class="btn btn-primary-outline" />
    </form>
</div>
