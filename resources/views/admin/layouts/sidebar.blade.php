  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
      <img src="{{asset('images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Buku Kas Umum</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <p>{{ Auth::user()->username }}</p>
      
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
                <a href="home" class="nav-link">
                <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li> 
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="kas_masuk" class="nav-link ">
                  <i class="fas fa-file nav-icon"></i>
                  <p>Kas Masuk</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="kas_keluar" class="nav-link ">
                  <i class="fas fa-file nav-icon"></i>
                  <p>Kas Keluar</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="rekapitulasi" class="nav-link">
                  <i class="fas fa-folder-open nav-icon"></i>
                  <p>Rekapitulasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="laporan" class="nav-link">
                  <i class="fas fa-book nav-icon"></i>
                  <p>Laporan</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="data_user" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Profile" class="nav-link">
                  <i class="fas fa-user nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="Info" class="nav-link">
                  <i class="fas fa-user nav-icon"></i>
                  <p>Info</p>
                </a>
              </li> -->

              
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>