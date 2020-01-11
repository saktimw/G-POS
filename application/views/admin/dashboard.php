<?php
  $uri = $this->uri->segment(2);
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=site_url('assets/adminlte/dist/img/user.png')?>" class="img-circle" alt="User Image">
        </div>
        <div class="info" style="margin-top:13px">
          <p><?=strtoupper($this->session->nama); ?></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
        <li class="menu-open">
          <a href="<?=base_url('admin')?>">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="">
          <a href="<?=base_url('admin/data_barang');?>">
            <i class="fa fa-cube"></i> <span>Data Barang</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-open"></i>
            <span> Rekap Dan Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url('admin/laporan_bulanan')?>"><i class="fa fa-caret-right"></i> Laporan Bulanan</a></li>
            <li><a href="<?=base_url('admin/rekap_barang')?>"><i class="fa fa-caret-right"></i> Rekap Barang</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Master Data User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url('admin/data_user')?>"><i class="fa fa-caret-right"></i> Data User</a></li>
            <li><a href="<?=base_url('admin/data_pegawai')?>"><i class="fa fa-caret-right"></i> Data Pegawai</a></li>
          </ul>
        </li>
        <li class="">
          <a href="<?=base_url('auth/logout');?>">
            <i class="fa fa-sign-out-alt"></i> <span>Keluar</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">