        <!-- Begin Page Content -->
        <div class="container-fluid">
            

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- Buttons -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="row">
                            <h3 class="m-0 font-weight-bold text-primary ml-3">Telesale Info </h3>    
                        </div>
                        <?php if ( $session['export_customers']  === '1' ): ?>
                            <div class="row mr-2">
                                <a href="./export/customers/<?=$telesale['username']?>" class="btn btn-success btn-icon-split">
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
                    <div class="row justify-content-center">
                        <div class="col-md-5 text-center">
                            <div class="customer-icon fa fa-user mb-3 mt-5"></div>
                            <h5 id="telesale_info" data-user="<?=$telesale['username']?>"><?=$telesale['username']?></h5>
                            <table class="table table-telesale-information mt-5">
                                <tbody>
                                <tr>
                                    <td class="border-top-0">Cashmarket:</td>
                                    <td class="border-top-0"><?=ucfirst($telesale['cashmarket'])?></td>
                                </tr>
                                <tr>
                                    <td>Registration Date:</td>
                                    <td><?=date("F j, Y, g:i a", strtotime($telesale['created_date']))?></td>
                                </tr>
                                <tr>
                                    <td>User Code:</td>
                                    <td><?=$telesale['user_code']?></td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <div class="text-center mb-4">
                                <span class="font-weight-bold">CLIENTS ATTENDED</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="teleClientTable" width="100%" cellspacing="0" data-csrfname="<?= $this->security->get_csrf_token_name(); ?>" data-token="<?= $this->security->get_csrf_hash(); ?>">
                                <thead>
                                    <tr class="text-center">
                                        <th width="50">Deposit</th>
                                        <th>Full Name</th>
                                        <th>Date Registered</th>
                                        <th width="100">Actions</th>
                                    </tr>
                                </thead>
                                </table>
                            </div>
                        </div>
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