<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
  <li class="nav-item">
    <a href="?act?db" class="nav-link">
      <i class="nav-icon far fa-circle text-danger"></i>
      <p>
        Dashboard
      </p>
    </a>
  </li>

 


  <li class="nav-item">
    <a href="?act=abs" class="nav-link">
      <i class="nav-icon far fa-circle text-warning"></i>
      <p>
        Absen
      </p>
    </a>
  </li>

 <li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon far fa-circle text-success"></i>
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
      <li class="nav-item">
        <a href="?act=ask" class="nav-link">
          <i class="far fa-question-circle"></i>
          <p>Pertanyaan</p>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="logout.php" class="nav-link">
      <i class="nav-icon far fa-circle text-primary"></i>
      <p>
        Keluar
      </p>
    </a>
  </li>

</ul>
</nav>
<!-- /.sidebar-menu -->