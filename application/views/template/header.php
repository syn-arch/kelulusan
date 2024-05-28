<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="BASE_URL" content="<?php echo base_url() ?>">

  <title><?php echo $judul ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Data Tables -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/lte/') ?>plugins/summernote/summernote-bs4.css">
  <!-- smartwizard -->
  <link rel="stylesheet" href="<?php echo base_url('vendor/smartwizard/dist/css/') ?>smart_wizard.min.css">
  <link rel="stylesheet" href="<?php echo base_url('vendor/smartwizard/dist/css/') ?>smart_wizard_theme_arrows.min.css">
  <link rel="stylesheet" href="<?php echo base_url('vendor/smartwizard/dist/css/') ?>smart_wizard_theme_circles.min.css">
  <link rel="stylesheet" href="<?php echo base_url('vendor/smartwizard/dist/css/') ?>smart_wizard_theme_dots.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="<?php echo base_url('vendor/lte/') ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">SMK BBC SCHOOL</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url('assets/img/petugas/') .  $this->session->userdata('gambar'); ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="<?php echo base_url('profil') ?>" class="d-block"><?php echo $this->session->userdata('nama_petugas'); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <?php

           $id_user = $this->session->userdata('id_user');
           $id_role = $this->session->userdata('id_role');

           $sql = "SELECT * FROM role_access_menu JOIN menu USING(id_menu) WHERE role_access_menu.id_role = '$id_role' ORDER BY menu.urutan ";
           $menu = $this->db->query($sql)->result_array();
           $counter = 1;
           ?>
           <?php foreach ($menu as $row): ?>

            <?php if ($row['ada_submenu'] == 0): ?>
              <li class="nav-item">
                <a href="<?php echo base_url($row['url']) ?>" class="nav-link <?= $judul == $row['nama_menu'] ? 'active' : '' ?>">
                  <i class="nav-icon fas <?php echo $row['icon'] ?>"></i>
                  <p>
                    <?php echo $row['nama_menu'] ?>
                  </p>
                </a>
              </li>

              <?php if ($counter == 1): ?>
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>" target="_blank" class="nav-link">
                    <i class="nav-icon fas fa-globe"></i>
                    <p>
                      Lihat Website
                    </p>
                  </a>
                </li>
              <?php endif ?>

              <?php else: ?>

                <?php

                $cek = $this->db->get_where('menu',['nama_menu' => $judul])->row_array();

                if ($cek) {
                  $ada_submenu = $this->db->get_where('menu',['nama_menu' => $judul])->row_array()['ada_submenu'];
                }else{
                  $ada_submenu = $this->db->get_where('submenu',['nama_submenu' => $judul])->row_array();
                }

                if ($ada_submenu) {
                  $this->db->join('submenu', 'id_menu');
                  $nama_menu = $this->db->get_where('menu',['nama_submenu' => $judul])->row_array()['nama_menu']; 
                }

                ?>

                <li class="nav-item has-treeview 
                <?php 
                if($ada_submenu){
                  if($nama_menu == $row['nama_menu']){
                    echo 'menu-open';
                  }
                } 
                ?>">

                <a href="#" class="nav-link
                <?php 
                if($ada_submenu){
                  if($nama_menu == $row['nama_menu']){
                    echo 'active';
                  }
                } 
                ?>">
                <i class="nav-icon fa <?php echo $row['icon'] ?>"></i>
                <p>
                  <?php echo $row['nama_menu'] ?>
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

               <?php 
               $id_menu = $row['id_menu'];
               $sql = "SELECT nama_submenu,submenu.url as url FROM role_access_submenu JOIN submenu USING(id_submenu) JOIN menu USING(id_menu) WHERE menu.id_menu = '$id_menu' AND role_access_submenu.id_role = $id_role ORDER BY submenu.urutan ";
               $submenu = $this->db->query($sql)->result_array();
               ?>

               <?php foreach ($submenu as $row_submenu): ?>
                <li class="nav-item">
                  <a href="<?php echo base_url($row_submenu['url']) ?>" class="nav-link <?= $judul == $row_submenu['nama_submenu'] ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p><?php echo $row_submenu['nama_submenu'] ?></p>
                  </a>
                </li>
              <?php endforeach ?>
            </ul>
          </li>

        <?php endif; ?>
      <?php $counter++ ?>
      <?php endforeach ?>

      <li class="nav-item">
        <a href="<?php echo base_url('auth/logout') ?>" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $judul ?></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

