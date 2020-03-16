<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center mt-5 pt-5">

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="img-cashmarket d-flex justify-content-between">
          <img src="./assets/img/7bet-logo.png" alt="7bet" width="200">
          <img src="./assets/img/ligajudi-logo.png" alt="ligajudi" width="200">
        </div>
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h1 text-gray-900 mb-4">TELECASHMARKET SYSTEM</h1>
                  </div>
                  <form id="adminLogin" class="user" action="./auth" method="post">
                    <div class="form-group">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                      <input type="text" name="admin_user" class="form-control form-control-user" id="exampleInputUsername" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="admin_pword" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group show-message text-center"></div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>