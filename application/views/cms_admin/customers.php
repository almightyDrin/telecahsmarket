        <!-- Begin Page Content -->
        <div class="container-fluid">
            

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- Buttons -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="row">
                            <h3 class="m-0 font-weight-bold text-primary ml-3">Registered Customers </h3>    
                        </div>
                        <?php if ( $session['export_customers']  === '1' ): ?>
                            <div class="row mr-2">
                                <a href="./export/customers" class="btn btn-success btn-icon-split">
                                    <span class="text">Export</span>
                                    <span class="icon text-white-50">
                                        <i class="fas fa-table"></i>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="customersTable" width="100%" cellspacing="0" data-csrfname="<?= $this->security->get_csrf_token_name(); ?>" data-token="<?= $this->security->get_csrf_hash(); ?>">
                    <thead>
                        <tr class="text-center">
                            <th width="50">Deposit</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Telesales</th>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Customer Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
        </div>