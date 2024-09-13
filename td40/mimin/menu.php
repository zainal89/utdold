<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
  <li class="nav-item">
    <a href="?act=db" class="nav-link">
      <i class="nav-icon far fa-circle text-danger"></i>
      <p>
        Dashboard
      </p>
    </a>
  </li>


  <li class="nav-item">
    <a href="?act=device" class="nav-link">
      <i class="nav-icon far fa-circle text-warning"></i>
      <p>
        Peralatan
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="?act=his" class="nav-link">
      <i class="nav-icon far fa-circle text-success"></i>
      <p>
        History
      </p>
    </a>
  </li>


 <li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon far fa-circle text-primary"></i>
      <p>
        Master
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="?act=dosen" class="nav-link">
          <i class="fas fa-user-tie"></i>
          <p>Dosen</p>
          
        </a>
      </li>
      <li class="nav-item">
        <a href="?act=mhs" class="nav-link">
          <i class="fas fa-user-graduate"></i>
          <p>Mahasiswa</p>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="logout.php" class="nav-link">
      <i class="nav-icon far fa-circle text-secondary"></i>
      <p>
        Keluar
      </p>
    </a>
  </li>

</ul>
</nav>
<!-- /.sidebar-menu -->