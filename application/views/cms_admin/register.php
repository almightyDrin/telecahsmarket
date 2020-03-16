<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 id="register-heading" class="h4 text-gray-900 mb-4">Please Create an Account</h1>
              </div>
              <form id="adminRegister" class="user" method="post" action="./cms_admin/store_user">
              
                <div class="form-group">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                  <div class="col-sm-12 mb-3 mb-sm-2">
                    <input type="text" class="form-control form-control-user" id="regUsername" name="reg_user" placeholder="Username">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12 mb-3 mb-sm-2">
                    <input type="password" class="form-control form-control-user" id="regPassword" name="reg_pass" placeholder="Password">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12 mb-3 mb-sm-2">
                    <select class="form-control form-control-user form-acc-lvl" name="account_level" id="accLevel">
                      <?php if ( $session['add_acc'] === '1' ): ?>
                      <option value="" selected="selected">-- Account Level --</option>
                      <option value="0777">Admin</option>
                      <option value="0666">Manager</option>
                    <?php endif; ?>
                      <option value="0555" <?php if ( $session['add_ts_acc'] === '1' ) echo 'selected="selected"' ?>>Telesales</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                    <select class="form-control form-control-user form-acc-lvl" name="cashmarket" id="cashmarket_type">
                      <?php if ( $session['add_acc'] === '1' ): ?>
                      <option value="" selected="selected">-- Cashmarket --</option>
                      <option value="7bet">7bet</option>
                      <option value="ligajudi">LigaJudi</option>
                      <?php endif; ?>
                      <option value="<?=$session['cashmarket']?>" selected="selected"><?=ucwords($session['cashmarket'])?></option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                    <input class="btn btn-primary btn-user btn-block" type="submit" value="Register Account">
                  </div>
                </div>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="./cms_admin/logout">Login with different Account</a>
              </div>

              <!-- show messages -->
              <ul class="show-message-group list-group mt-4 text-center"></ul>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


<!-- CLIENT
url ->



Super7tech.com/checkjson
{
  'aldrin': 'all-3de4a2ae-eef8-42c9-dbb3-000053788c12',
  'takorn': 'all-3de4a2ae-eef8-42c9-dbb3-000053788c13221'
}



Sudo Code
- sub domain access
- client (AJAX request) request to compare sub-domain with json file
- if sub-domain match with json file then add element (hidden) with value from json


i.e user access takorn.7bet.com
AJAX request to super7tech.com/checkjson
will comapre 'takron' with the json object/ matched with 'all-3de4a2ae-eef8-42c9-dbb3-000053788c13221'
then using javascript to create new element (hidden field) value ='all-3de4a2ae-eef8-42c9-dbb3-000053788c13221' -->
