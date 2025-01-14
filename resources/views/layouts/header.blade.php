<!-- Header -->
<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            <li><i class="ti-headphone-alt"></i> +62 812 3456 7890</li>
                            <li><i class="ti-email"></i> wijoyo@example.com</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                            <ul class="list-main">
                                @guest
                                    <li><i class="ti-power-off"></i> <a href="{{ route('login') }}">Login/Register</a></li>
                                @endguest
                            </ul>

                        </ul>
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    {{-- <div class="logo" style="font-style:italic"> --}}
                    <a href="/customer/home" style="font-style:italic">
                        <h3><strong>WIJOYO MEBEL</strong></h3>
                    </a>
                    {{-- </div> --}}
                    <!--/ End Logo -->
                    <!-- Search Form -->
                    <div class="search-top">
                        <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                        <!-- Search Form -->
                        <div class="search-top">
                            <form class="search-form">
                                <input type="text" placeholder="Cari produk disini..." name="search">
                                <button value="search" type="submit"><i class="ti-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Search Form -->
                    </div>
                    <!--/ End Search Form -->
                    <div class="mobile-nav"></div>
                </div>
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <form>
                                <input name="search" placeholder="Cari produk disini..." type="search">
                                <button class="btnn"><i class="ti-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="right-bar">
                        <!-- Search Form -->
                        {{-- <div class="sinlge-bar">
                            <a href="" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </div> --}}
                        <div class="sinlge-bar">
                            <a href="{{ route('customer.dashboard') }}" class="single-icon"><i
                                    class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                        </div>
                        <div class="sinlge-bar shopping">
                            {{-- <span
                                    class="total-count"></span> --}}
                            <a href="{{ route('customer.cart') }}" class="single-icon"><i class="ti-shopping-cart"></i>
                            </a>
                            {{-- <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    <span>2 Items</span>
                                    <a href="#">View Cart</a>
                                </div>
                                <ul class="shopping-list">
                                    <li>
                                        <a href="#" class="remove" title="Remove this item"><i
                                                class="fa fa-remove"></i></a>
                                        <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70"
                                                alt="#"></a>
                                        <h4><a href="#">Woman Ring</a></h4>
                                        <p class="quantity">1x - <span class="amount">$99.00</span></p>
                                    </li>
                                    <li>
                                        <a href="#" class="remove" title="Remove this item"><i
                                                class="fa fa-remove"></i></a>
                                        <a class="cart-img" href="#"><img src="https://via.placeholder.com/70x70"
                                                alt="#"></a>
                                        <h4><a href="#">Woman Necklace</a></h4>
                                        <p class="quantity">1x - <span class="amount">$35.00</span></p>
                                    </li>
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span>Total</span>
                                        <span class="total-amount">$134.00</span>
                                    </div>
                                    <a href="checkout.html" class="btn animate">Checkout</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">
                                    <div class="nav-inner">
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class=""><a href="{{ route('customer.home') }}">Home</a></li>
                                            <li><a href="{{ route('all.produk') }}">Semua Produk</a></li>
                                            <li><a href="#">Produk Kategori<i class="ti-angle-down"></i><span
                                                        class="new">New</span></a>
                                                <ul class="dropdown">
                                                    <li><a href="shop-grid.html">Pintu</a></li>
                                                    <li><a href="cart.html">Jendela</a></li>
                                                    <li><a href="checkout.html">Lemari</a></li>
                                                    <li><a href="checkout.html">Keramik</a></li>
                                                    <li><a href="shop-grid.html">Cat</a></li>
                                                    <li><a href="cart.html">Kaca</a></li>
                                                    <li><a href="checkout.html">Kunci</a></li>
                                                    <li><a href="checkout.html">Peralatan</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Ruangan<i class="ti-angle-down"></i><span
                                                        class="new">New</span></a>
                                                <ul class="dropdown">
                                                    <li><a href="shop-grid.html">Dapur</a></li>
                                                    <li><a href="cart.html">Kamar Tidur</a></li>
                                                    <li><a href="checkout.html">Kamar Anak</a></li>
                                                    <li><a href="checkout.html">Ruang Tamu</a></li>
                                                    <li><a href="checkout.html">Ruang Makan</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('about.us') }}">Tentang Kami</a></li>
                                            <li><a href="{{ route('kontak.kami') }}">Kontak Kami</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!--/ End Header -->
