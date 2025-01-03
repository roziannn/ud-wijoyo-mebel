@extends('layouts.master')
@section('contents')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Semua Produk</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Style -->
    <section class="product-area shop-sidebar shop section p-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="shop-sidebar">
                        <div class="single-widget category">
                            <h3 class="title">Kategori</h3>
                            <ul class="categor-list">
                                <li><a href="/semua-produk">Semua Produk</a>
                                </li>
                                @foreach ($kategori as $item)
                                    <li>
                                        <a
                                            href="{{ route('all.produk', ['category' => $item->nama]) }}">{{ $item->nama }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="single-widget category">
                            <h3 class="title">Ruangan</h3>
                            <ul class="categor-list">
                                <li><a href="/semua-produk">Semua Produk</a>
                                </li>
                                @foreach ($ruangan as $item)
                                    <li>
                                        <a
                                            href="{{ route('all.produk', ['ruangan' => $item->nama]) }}">{{ $item->nama }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- <div class="single-widget range">
                            <h3 class="title">Filter Produk</h3>
                            <div class="price-filter">
                            </div>
                            <ul class="categor-list">
                                <li><a href="{{ route('all.produk') }}">Terbaru</a></li>
                                <li><a href="{{ route('all.produk') }}">Harga Tertinggi</a></li>
                                <li><a href="{{ route('all.produk') }}">Harga Terendah</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row">
                        @foreach ($storeProduct as $item)
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{ route('single.produk', $item?->slug) }}">
                                            <img class="default-img" src="{{ asset('storage/' . $item?->image) }}"
                                                alt="product">
                                        </a>

                                    </div>
                                    <div class="product-content">
                                        <h3><a style="cursor: pointer"><strong>{{ $item?->nama }}</strong></a></h3>
                                        <div class="product-price">
                                            <span>Rp{{ number_format($item?->harga, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    .text-store-name {
        color: #996330;
    }
</style>
