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
          <a href="<?=base_url('kasir')?>">
            <i class="fa fa-home"></i> <span>Home</span>
          </a>
        </li>
        <li class="">
          <a href="<?=base_url('kasir/transaksi');?>">
            <i class="fa fa-exchange-alt"></i> <span>Transaksi</span>
          </a>
        </li>
        <li class="">
          <a href="<?=base_url('kasir/laporan');?>">
            <i class="fa fa-file"></i> <span>Laporan</span>
          </a>
        </li>
        <li class="">
          <a href="<?=base_url('auth/logout');?>">
            <i class="fa fa-sign-out-alt"></i> <span> Keluar</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">