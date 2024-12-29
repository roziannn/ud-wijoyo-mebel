@extends('layouts.master')
@section('contents')
    <!-- Start Small Banner  -->
    <section class="small-banner section mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>
                            <i class="ti-truck"></i> Pengiriman Antar Pulau 24 Jam
                        </h2>
                    </div>
                </div>
            </div>
            <div id="carouselExampleIndicators" class="carousel slide mx-auto" data-ride="carousel" data-interval="2500"
                style="max-width: 850px;margin-bottom:60px">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('frontend/images/mebel1.jpg') }}" alt="First slide"
                            style="max-height: 500px;">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('frontend/images/mebel2.jpg') }}" alt="Second slide"
                            style="max-height: 500px;">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('frontend/images/mebel3.jpg') }}" alt="Third slide"
                            style="max-height: 500px;">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>



        </div>
    </section>
    <!-- End Small Banner -->



    <!-- End Most Popular Area -->

    <!-- Start Cowndown Area -->
    <section class="cown-down">
        <div class="section-inner ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-12 padding-right">
                        <div class="image">
                            <img src="{{ asset('/frontend/images/material_1.png') }}" alt="#">
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 padding-left">
                        <div class="content">
                            <div class="heading-block">

                                <h1 class="my-3">Ragam Produk Berkualitas <br> untuk Membangun Impian Anda</h1>
                                <p class="text">Kami menyediakan berbagai pilihan produk terbaik yang dirancang khusus
                                    untuk memenuhi kebutuhan konstruksi Anda, berasal dari supplier ternama dan produk lokal
                                    terpercaya yang berkualitas.</p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Cowndown Area -->
    <section class="shop-services section shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Free shiping</h4>
                        <p>Orders over $100</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Free Return</h4>
                        <p>Within 30 days returns</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4>Sucure Payment</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>Best Peice</h4>
                        <p>Guaranteed price</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>


    <!-- Start Shop Home List  -->
    <section class="shop-home-list section">
        <div class="container">
            <h3 class="mt-5 p-0">Produk Terbaru</h3>
            <div class="row">
                @foreach ($produk as $item)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Start Single List  -->
                        <div class="single-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="list-image overlay">
                                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama }}">
                                        <a href="{{ route('single.produk', $item->slug) }}" class="buy"><i
                                                class="fa fa-shopping-bag"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 no-padding">
                                    <div class="content">
                                        <h5><a href="{{ route('single.produk', $item->slug) }}">{{ $item->nama }}</a>
                                        </h5>
                                        {{-- <span class="badge badge-secondary text-white">{{ $item->jenis_ruangan }}</span> --}}
                                        <span class="badge badge-warning text-white">{{ $item->kategori }}</span>
                                        <p class="price with-discount">
                                            Rp. {{ number_format($item?->harga, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
