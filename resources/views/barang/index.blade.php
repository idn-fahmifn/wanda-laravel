@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-2">
            <div class="card">
                <div class="card-header">Barang</div>
                <div class="card-body">
                    <form method="POST" action="{{route('barang.store')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="barang" class="col-md-4 col-form-label text-md-right">Nama Barang</label>

                            <div class="col-md-6">
                                <input id="barang" type="text"
                                    class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang"
                                    value="{{ old('nama_barang') }}" required autocomplete="off">

                                @error('nama_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="harga" class="col-md-4 col-form-label text-md-right">Harga Barang</label>
                            <div class="col-md-6">
                                <input id="harga" type="text" class="form-control @error('harga') is-invalid @enderror"
                                    name="harga" value="{{ old('harga') }}" required autocomplete="off">

                                @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stok" class="col-md-4 col-form-label text-md-right">Stok Barang</label>
                            <div class="col-md-6">
                                <input id="stok" type="number" class="form-control @error('stok') is-invalid @enderror"
                                    name="stok" value="{{ old('stok') }}" required autocomplete="off">

                                @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Tambah Barang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="card">
                <div class="card-header">Tabel Barang</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($barang as $row)
                            <tr>
                                <td>{{$row->nama_barang}}</td>
                                <td>{{$row->harga}}</td>
                                <td>{{$row->stok}}</td>
                                <td>
                                    <form action="#" method="post">
                                        <a href="#" class="btn btn-primary">Ubah</a>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$barang->links()}}
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header">
                    Grafik Stok Barang
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     // Fungsi untuk mengambil data dari server menggunakan AJAX
     function fetchData() {
        $.ajax({
            url: '/barang', // Ganti dengan URL rute Anda
            method: 'GET',
            success: function(data) {
                drawChart(data); // Panggil fungsi untuk menggambar grafik
            },
            error: function() {
                console.error('Gagal mengambil data.');
            }
        });
    }

    // Fungsi untuk menggambar grafik
    function drawChart(data) {
        var ctx = document.getElementById('myChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($values) !!},
                datasets: [{
                    label: 'Stok',
                    data: {!!json_encode($stok)!!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Panggil fungsi untuk mengambil data saat halaman dimuat
    fetchData();
</script>

@endsection
