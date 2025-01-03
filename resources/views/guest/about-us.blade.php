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
        <h2 class="pb-3">Selamat Datang di UD Wijoyo Mebel</h2>
        <p>Mebel Wijoyo adalah produsen dan penyedia mebel berkualitas tinggi yang berdiri sejak [tahun berdiri] di
            [lokasi/kota]. Dengan komitmen terhadap keindahan desain, kualitas bahan terbaik, dan keahlian pembuatan, kami
            hadir untuk memberikan solusi furnitur yang tidak hanya nyaman digunakan tetapi juga meningkatkan estetika
            ruangan Anda.</p>
        <h5 class="pt-4 pb-3">Produk Unggulan</h5>

        Kami menyediakan berbagai macam furnitur, termasuk:
        <br>
        - Set meja dan kursi makan <br>
        - Sofa elegan <br>
        - Lemari pakaian <br>
        - Meja kerja dan rak buku <br>
        - Furnitur untuk kebutuhan komersial seperti kafe dan restoran
    </section>
@endsection

</style>
