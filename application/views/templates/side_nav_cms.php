<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion bg-sidebar-<?= $session['cashmarket']?>" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="./cms_admin/admin">
  <?php if ( $session['cashmarket'] === 'all' ): ?>
    <span>Admin Panel</span>
  <?php else: ?>
    <img src="./assets/img/<?= $session['cashmarket']?>-logo.png" alt="<?= $session['cashmarket']?>" class="img-fluid" width="150">
  <?php endif; ?>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item<?=($method == 'admin') ? ' active' : '' ?>">
  <a class="nav-link" href="./cms_admin/admin">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Customers -->
<li class="nav-item<?=($method == 'customers') ? ' active' : '' ?>">
  <a class="nav-link" href="./cms_admin/customers">
    <i class="fas fa-users"></i>
    <span>Customers</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Customers -->
<li class="nav-item<?=($method == 'telesales') ? ' active' : '' ?>">
  <a class="nav-link" href="./cms_admin/telesales">
    <i class="fas fa-user"></i>
    <span>Telesales</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<?php if ( $session['acc_level'] === '0777' ): ?>
<!-- Nav Item - Customers -->
<li class="nav-item<?=($method == 'users') ? ' active' : '' ?>">
  <a class="nav-link" href="./cms_admin/users">
    <i class="far fa-address-book"></i>
    <span>Users</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider my-0">
<?php endif; ?>

<!-- Nav Item - Register -->
<?php if ( $session['add_acc'] === '1' || $session['add_ts_acc'] === '1' ): ?>
<li class="nav-item<?=($method == 'register') ? ' active' : '' ?>">
  <a class="nav-link" href="./cms_admin/register">
    <i class="fas fa-user-plus"></i>
    <span>Register User</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">
<?php endif; ?>


<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline mt-2">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->