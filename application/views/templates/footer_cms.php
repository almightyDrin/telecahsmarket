      </div>
      <!-- End of Main Content -->

<?php if ($method != "login"): ?>
<!-- Footer -->
<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; MarckTech <?= date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="./cms_admin/logout">Logout</a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
  <!-- Bootstrap core JavaScript-->
  <script src="./assets/js/cms/jquery.min.js"></script>
  <script src="./assets/js/cms/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
  <!-- <script src="./assets/js/cms/tempusdominos-bs4.min.js"></script> -->
  <script src="./assets/js/cms/bootstrap.bundle.min.js"></script>
  
  <!-- <script src="./assets/js/cms/propeller.min.js"></script> -->
    
  <!-- DataTables -->
  <script src="./assets/js/cms/jquery.dataTables.min.js"></script>
  <script src="./assets/js/cms/dataTables.bootstrap4.min.js"></script>
  

  <!-- Core plugin JavaScript-->
  <script src="./assets/js/cms/jquery.easing.min.js"></script>

  <!-- Tiny MCE Script -->
  <script src="./assets/js/cms/tinymce5.js" referrerpolicy="origin"></script>

  <!-- Custom scripts for all pages-->
  <script src="./assets/js/cms/cms.min.js"></script>

  <!-- Page level plugins -->
  <script src="./assets/js/cms/chart.min.js"></script>

  
  <!-- Admin Level Script -->
  <script src="./assets/js/common.js"></script>
  
  <!-- Page level custom scripts -->
  <?php //load_script($this->uri->segment(2)); ?>
  <?= load_script($method); ?>


</body>

</html>