<div class="row justify-content-center align-items-center my-5">
    <div class="col-md-7">
        <form id="updateUser" method="post" action="./cms_admin/update_user/<?=$user['id']?>">
            <div class="form-group">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                <div class="col-sm-12 mb-3 mb-sm-2">
                <input type="text" class="form-control form-control-user" id="regUsername" name="update_user" value="<?=$user['username']?>" placeholder="Username">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12 mb-3 mb-sm-2">
                <input type="password" class="form-control form-control-user" id="regPassword" name="update_pass" value="<?=$user['password']?>" placeholder="Password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                <input class="btn btn-primary btn-user btn-block" type="submit" value="Update Account">
                </div>
            </div>
        </form>
    </div>
</div>