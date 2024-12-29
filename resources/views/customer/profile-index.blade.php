@extends('layouts.master')
@section('contents')
    <div class="breadcrumbs mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('customer.home') }}">Home </a><i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="{{ route('customer.profile') }}">Profile</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('customer.sidebar')
                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <div class="content-single">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                    Profile Saya</button>
                                <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact"
                                    type="button" role="tab" aria-controls="nav-contact"
                                    aria-selected="false">Pengaturan Akun</button>
                            </div>
                        </nav>
                        <div class="tab-content shop checkout" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <form action="{{ route('customer.profile.update') }}" method="POST" class="form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Nama Lengkap<span>*</span></label>
                                                <input type="text" class="form-control" name="nama_lengkap"
                                                    placeholder="" required="required"value="{{ auth()->user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Nomor Telepon<span>*</span></label>
                                                <input type="text" class="form-control" name="no_telp" placeholder=""
                                                    required="required" value="{{ $customerInfo?->no_telp }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Alamat<span>*</span></label>
                                                <input type="text" class="form-control" name="alamat" placeholder=""
                                                    required="required" value="{{ $customerInfo?->alamat }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Provinsi<span>*</span></label>
                                                <select class="nice-select province" name="provinsi">
                                                    <option class="text-muted">--Select Provinsi--</option>
                                                    @foreach ($provinces as $item)
                                                        <option value="{{ $item->id }}" @selected($item->id == $customerInfo?->provinsi)>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Regensi/Kota<span>*</span></label>
                                                <select class="nice-select regency" name="kota">
                                                    <option class="text-muted">--Select Regensi/Kota--</option>
                                                    @foreach ($regencies as $item)
                                                        <option value="{{ $item->id }}" @selected($item->id == $customerInfo?->kota)>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Kode Pos<span>*</span></label>
                                                <input type="number" class="form-control" name="kode_pos" id="kodepos"
                                                    value="{{ $customerInfo?->kode_pos }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn-save">Save Changes</button>
                                </form>
                            </div>

                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <form action="" method="post" class="form mb-3">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Email </label>
                                                <input type="text" class="form-control" name="email" placeholder=""
                                                    required="required" value="{{ auth()->user()->email }}" disabled>
                                                <span class="text-danger">*Email tidak dapat
                                                    dirubah.</span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <button class="btn btn-default">Save</button> --}}
                                </form>
                                <form action="{{ route('customer.profile.password.update') }}" method="POST"
                                    class="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Change Password</label>
                                                <input type="text" class="form-control" name="password"
                                                    placeholder="" required="required">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="text" class="form-control" name="password_confirmation"
                                                    placeholder="" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-default">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-120"></div>
@endsection
