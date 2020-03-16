        <!-- Begin Page Content -->
        <div class="container-fluid">
            

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- Buttons -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="row">
                            <h3 class="m-0 font-weight-bold text-primary ml-3">Telesales </h3>    
                        </div>
                        <?php if ( $session['export_telesales']  === '1' ): ?>
                            <div class="row mr-2">
                                <a href="./export/telesales" class="btn btn-success btn-icon-split">
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
                    <table class="table table-bordered" id="telesalesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th width="50">ID</th>
                            <th>Username</th>
                            <th>Cashmarket</th>
                            <!-- <th>Attended</th> -->
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