<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="{{ asset('v1/images/e-logo.jpg') }}" alt="Elenio Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">ELENIO SYSTEM</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('v1/img/user2-160x160.jpg   ') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="#" class="nav-link {{ $page == 'dasbhoard' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i> &nbsp;
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-header">System Settings</li>
        <li class="nav-item">
          <a href="{{ route('user') }}" class="nav-link {{ $page == 'user' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users-cog"></i> &nbsp;
            <p>
              Users
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('activity') }}" class="nav-link {{ $page == 'activity' ? 'active' : '' }}">
            <i class="nav-icon fas fa-clipboard-list"></i> &nbsp;
            <p>
              Activity Log
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('activity') }}" class="nav-link" data-toggle="modal" data-target="#logoutModal">
            <i class="nav-icon fas fa-sign-out-alt"></i> &nbsp;
            <p>
              Logout
            </p>
          </a>
        </li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>