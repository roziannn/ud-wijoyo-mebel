@extends('layouts.master')
@section('contents')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li><a href="{{ route('customer.cart') }}">Keranjang<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post">
        @csrf
        <section class="shop checkout section p-0 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="d-flex justify-content-start">
                                <input type="hidden" class="" name="checkout_id" value="">
                            </div>
                            <div class="card-body">
                                <div class="customer customer-info">
                                    <div class="col-12">
                                        @if (empty($customer->nama_lengkap) ||
                                                empty($customer->no_telp) ||
                                                empty($customer->alamat) ||
                                                empty($customer->regensi->name) ||
                                                empty($customer->kode_pos))
                                            <div class="alert alert-warning">
                                                <strong><i class="fa fa-exclamation-triangle"></i></strong>
                                                Harap lengkapi data profile dan informasi alamat sebelum melakukan
                                                checkout.
                                                <a href="{{ route('customer.profile') }}" class="text-primary"><i
                                                        class="fa fa-pencil-square-o mx-2"></i>Lengkapi Alamat</a>
                                            </div>
                                        @else
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong><i class="fa fa-location-arrow mx-2"></i> Pengiriman ke:</strong>
                                                <span>{{ $customer->nama_lengkap }}</span>
                                                <span>{{ $customer->no_telp }}</span>
                                                <span>{{ $customer->alamat }}, {{ $customer->regensi->name }},
                                                    {{ $customer->kode_pos }}</span>
                                                <a href="{{ route('customer.profile') }}" class="text-primary"><i
                                                        class="fa fa-pencil-square-o mx-2"></i>Ubah Alamat</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection



<style>
    #total-payment {
        font-weight: 600;
    }

    .td-value {
        padding-left: 60px;
    }

    table.table-payment tr td {
        padding-bottom: 10px;
    }

    #totalPayment {
        color: #a3540e;
    }
</style>
