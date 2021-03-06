<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ url('themes/AdminLTE-2.4.3/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Helpers::getNama() }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
          <li class="{{ Request::is('dashboard') ? 'active':null}}"><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li class="treeview {{ Request::is('user') ? 'active':null}} {{ Request::is('akun') ? 'active':null}} {{ Request::is('nasabah') ? 'active':null}}">
            <a href="#">
              <i class="fa fa-database" aria-hidden="true"></i>
              <span>Data Master</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('user') ? 'active':null}}"><a href="{{ url('user') }}"><i class="fa fa-circle-o"></i> <span> User</span></a></li>
              <li class="{{ Request::is('akun') ? 'active':null}}"><a href="{{ url('akun') }}"><i class="fa fa-circle-o"></i> <span> Akun</span></a></li>
              <li class="{{ Request::is('siswa') ? 'active':null}}"><a href="{{ url('siswa') }}"><i class="fa fa-circle-o"></i> <span> Siswa</span></a></li>
            </ul>
          </li>
          <li class="{{ Request::is('pembayaran-spp') ? 'active':null}}"><a href="{{ url('pembayaran-spp') }}"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> <span>Pembayaran SPP</span></a></li>
          <li class="{{ Request::is('rkas') ? 'active':null}}"><a href="{{ url('rkas') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>RKAS</span></a></li>
          <li class="{{ Request::is('pengeluaran') ? 'active':null}}"><a href="{{ url('pengeluaran') }}"><i class="fa fa-book" aria-hidden="true"></i> <span>Pengeluaran Kas</span></a></li>
          <li class="treeview {{ Request::is('laporan/pemasukan') ? 'active':null}} {{ Request::is('laporan/pengeluaran') ? 'active':null}} 
            {{ Request::is('laporan/pembayaran-spp') ? 'active':null}} {{ Request::is('laporan/tunggakan-spp') ? 'active':null}} 
            {{ Request::is('laporan/pembayaran-gedung') ? 'active':null}} {{ Request::is('laporan/tunggakan-gedung') ? 'active':null}}">
            <a href="#">
              <i class="fa fa-clipboard" aria-hidden="true"></i>
              <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Request::is('laporan/pemasukan') ? 'active':null}}"><a href="{{ url('laporan/pemasukan') }}"><i class="fa fa-file-text-o"></i> Pembayaran</a></li>
              <li class="{{ Request::is('laporan/pengeluaran') ? 'active':null}}"><a href="{{ url('laporan/pengeluaran') }}"><i class="fa fa-file-text-o"></i> Rekapitulasi</a></li>
              <li class="{{ Request::is('laporan/pembayaran-siswa') ? 'active':null}}"><a href="{{ url('laporan/pembayaran-siswa') }}"><i class="fa fa-file-text-o"></i> Tunggakan</a></li>
              <li class="{{ Request::is('laporan/pembayaran-spp') ? 'active':null}}"><a href="{{ url('laporan/pembayaran-spp') }}"><i class="fa fa-file-text-o"></i> RKAS</a></li>
              <li class="{{ Request::is('laporan/tunggakan-spp') ? 'active':null}}"><a href="{{ url('laporan/tunggakan-spp') }}"><i class="fa fa-file-text-o"></i> Pengeluaran Kas</a></li>
              <li class="{{ Request::is('laporan/pembayaran-gedung') ? 'active':null}}"><a href="{{ url('laporan/pembayaran-gedung') }}"><i class="fa fa-file-text-o"></i> Pertanggung Jawaban</a></li>
              <li class="{{ Request::is('laporan/tunggakan-gedung') ? 'active':null}}"><a href="{{ url('laporan/tunggakan-gedung') }}"><i class="fa fa-file-text-o"></i> Arus Kas</a></li>
              <li class="{{ Request::is('laporan/tunggakan-gedung') ? 'active':null}}"><a href="{{ url('laporan/tunggakan-gedung') }}"><i class="fa fa-file-text-o"></i> Perubahan Modal</a></li>
              <li class="{{ Request::is('laporan/tunggakan-gedung') ? 'active':null}}"><a href="{{ url('laporan/tunggakan-gedung') }}"><i class="fa fa-file-text-o"></i> Neraca</a></li>
            </ul>
          </li>
       
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>