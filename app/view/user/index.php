<div class="page-header">
    <h1>This is users page! Owner only.</h1>
</div>
<!-- CREATE FORM -->
<div>
    <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#createForm">
        Create
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="createForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="error-container" class="alert alert-danger" role="alert">
            </div>
            <form method='post' id="create-user-form" action="<?php echo URL.'user/create' ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Create new User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 form-control-label">Email</label>
                        <div class="col-sm-10">
                            <input name='email' type="email" class="form-control" id="inputEmail" placeholder="Email" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 form-control-label">Password</label>
                        <div class="col-sm-10">
                            <input name='password' type="password" class="form-control" id="inputPassword" placeholder="Password" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2">Radios</label>
                        <div class="col-sm-10">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="roles" id="role-default" value="default" checked >
                                    Default
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="roles" id="role-admin" value="admin" >
                                    Admin
                                </label>
                            </div>
                            <div class="radio disabled">
                                <label>
                                    <input type="radio" name="roles" id="role-owner" value="owner" disabled >
                                    Owner
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Create</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- user list -->
<table class="table table-hover">
    <thead class="thead-inverse">
        <tr>
            <th>ID</th>
            <th>EMAIL</th>
            <th>ROLE</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody class="">
    <?php foreach($this->users as $user): ?>
        <?php
            $user_id = $user['id'];
            $role = $user['role'];
            $classes = '';
            if($role == 'owner') $classes .= 'danger';
        ?>
        <tr class="<?php echo $classes ?>">
            <td><?php echo $user_id ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo $role ?></td>
            <td id="user-<?php echo $user_id ?>" class="user-actions">
                <a class="btn btn-primary-outline" href="#" role="button">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
                <a class="btn btn-danger-outline" href="#" role="button">
                    <i class="fa fa-times"></i>
                </a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>