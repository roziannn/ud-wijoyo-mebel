<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('admin.dashboard') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="">Master Data</li>
                <li>
                    <a href="{{ route('admin.data-produk') }}"> <i class="menu-icon ti-folder"></i>Data Produk </a>
                </li>
                <li>
                    <a href="{{ route('admin.data-kategori') }}"> <i class="menu-icon ti-folder"></i>Data Kategori </a>
                </li>
                <li>
                    <a href="{{ route('admin.data-ruangan') }}"> <i class="menu-icon ti-folder"></i>Data Ruangan </a>
                </li>
                <li class="">Transaksi</li>
                <li>
                    <a href="{{ route('admin.transaksi-customer') }}"> <i class="menu-icon ti-folder"></i>Transaksi
                        Customer</a>
                </li>
                <li class="">Oprasional</li>
                <li>
                    <a href="{{ route('admin.kelola-operasional') }}"> <i class="menu-icon ti-folder"></i>Kelola
                        Operasional</a>
                </li>
                <li>
                    <a href="{{ route('admin.kategori-operasional') }}"> <i class="menu-icon ti-folder"></i>Kategori
                        Operasional</a>
                </li>
                {{-- <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Icons</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="font-fontawesome.html">Font
                                Awesome</a></li>
                        <li><i class="menu-icon ti-themify-logo"></i><a href="font-themify.html">Themefy Icons</a>
                        </li>
                    </ul>
                </li> --}}
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
