@extends('layouts.master')
@section('contents')
    <div class="breadcrumbs mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('customer.home') }}">Home </a><i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="">Dashboard</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section-box">
        <div class="container">
            <div class="row">
                @include('customer.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-5">
                    <div class="content-single">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">My Dashboard</h4>
                            <h5 class="mb-0 text-muted">Welcome Back, {{ auth()->user()->name }} 👋</h5>
                        </div>

                        <hr>
                        <div class="dashboard_overview">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="mr-3">
                                                    <i class="fa fa-cart-plus fa-4x"></i>
                                                </div>
                                                <div>
                                                    <span class="d-block font-weight-bold text-uppercase">Transaksi
                                                        Saya</span>
                                                    {{-- <h2 class="mb-0">{{ $order }}</h2> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            {{-- <div class="text-right">
                                                <a href="{{ route('customer.order') }}"
                                                    class="text-secondary text-muted">All Transaction </a>
                                            </div> --}}
                                        </div>
                                    </div>


                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="mr-3">
                                                    <i class="fa fa-history fa-4x"></i>
                                                </div>
                                                <div>
                                                    <span class="d-block font-weight-bold text-uppercase">History
                                                        Transaction</span>
                                                    {{-- <h2 class="mb-0">{{ $order }}</h2> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            {{-- <div class="text-right">
                                                <a href="{{ route('customer.history-transaction') }}"
                                                    class="text-secondary text-muted">All History
                                                </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 col-md-6 pt-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="mr-3">
                                                    <i class="fa fa-list-alt fa-4x"></i>
                                                </div>
                                                <div>
                                                    <span class="d-block font-weight-bold text-uppercase">Building
                                                        Checklist</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a href="{{ route('customer.building-checklist') }}"
                                                    class="text-secondary text-muted">My Building Projects
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
