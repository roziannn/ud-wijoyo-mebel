@extends('layouts.master')
@section('contents')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="#">Tentang Kami</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container my-5">
        <h2 class="pb-3">Kontak Kami</h2>
        <ul class="list-unstyled">
            <li class="mb-2">
                <i class="fa fa-phone"></i> <strong>Telepon:</strong> +62 812 3456 7890
            </li>
            <li class="mb-2">
                <i class="fa fa-envelope"></i> <strong>Email:</strong> wijoyo@example.com
            </li>
            <li class="mb-2">
                <i class="fa fa-map-marker"></i> <strong>Alamat:</strong> Jl. Raya Mebel No. 123, Surabaya, Indonesia
            </li>
            <li class="mb-2">
                <i class="fa fa-facebook"></i> <strong>Facebook:</strong> <a href="https://facebook.com/wijoyomebel"
                    target="_blank">facebook.com/wijoyomebel</a>
            </li>
            <li class="mb-2">
                <i class="fa fa-instagram"></i> <strong>Instagram:</strong> <a href="https://instagram.com/wijoyomebel"
                    target="_blank">@wijoyomebel</a>
            </li>
            <li class="mb-2">
                <i class="fa fa-whatsapp"></i> <strong>WhatsApp:</strong> <a href="https://wa.me/6281234567890"
                    target="_blank">+62 812 3456 7890</a>
            </li>
        </ul>
    </section>
@endsection

</style>
