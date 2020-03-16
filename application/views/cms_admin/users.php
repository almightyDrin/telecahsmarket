        <!-- Begin Page Content -->
        <div class="container-fluid">
            

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- Buttons -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="row">
                            <h3 class="m-0 font-weight-bold text-primary ml-3">List of Users </h3>    
                        </div>
                        <div class="row mr-2">
                            <!-- <a data-toggle="modal" data-target="#addFlagModal" class="btn btn-primary btn-circle btn-lg mr-2" toggle="tooltip" data-placement="top" title="Add Flag">
                                <i class="fas fa-plus text-light"></i>
                            </a> -->
                            <!-- <a data-toggle="modal" data-target="#addFlagModal" class="btn btn-primary btn-icon-split" title="Add Flag">
                                <span class="icon text-white-50">
                                <i class="fas fa-plus text-light"></i>
                                </span>
                                <span class="text text-light">Add Flag</span>
                            </a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0" data-csrfname="<?= $this->security->get_csrf_token_name(); ?>" data-token="<?= $this->security->get_csrf_hash(); ?>">
                    <thead>
                        <tr class="text-center">
                            <th width="50">ID</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Cashmarket</th>
                            <th>Date Registered</th>
                            <th width="100">Actions</th>
                        </tr>
                    </thead>
                    </table>
                </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

        <!-- Large modal -->
        <div class="modal fade bd-example-modal-lg show" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">User Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
        </div>