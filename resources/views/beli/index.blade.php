@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-2">
            <div class="card">
                <div class="card-header">Belanja</div>
                <div class="card-body">
                    <form method="POST" action="{{route('beli.store')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="barang" class="col-md-4 col-form-label text-md-right">Nama Barang</label>

                            <div class="col-md-6">
                                <select name="id_barang" class="form-control">
                                    @foreach($barang as $row)
                                    <option value="{{$row->id}}">{{$row->nama_barang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_pembeli" class="col-md-4 col-form-label text-md-right">Nama Pembeli</label>
                            <div class="col-md-6">
                                <input id="nama_pembeli" type="text" class="form-control @error('nama_pembeli') is-invalid @enderror"
                                    name="nama_pembeli" value="{{ old('nama_pembeli') }}" required autocomplete="off">

                                @error('nama_pembeli')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah_barang" class="col-md-4 col-form-label text-md-right">Jumlah Barang</label>
                            <div class="col-md-6">
                                <input id="jumlah_barang" type="number" class="form-control @error('jumlah_barang') is-invalid @enderror"
                                    name="jumlah_barang" value="{{ old('jumlah_barang') }}" required autocomplete="off">

                                @error('jumlah_barang')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Beli Barang
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
                            <th>Pembeli</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach($beli as $row)
                            <tr>
                                <td>{{$row->barang->nama_barang}}</td>
                                <td>{{$row->barang->harga}}</td>
                                <td>{{$row->nama_pembeli}}</td>
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
                    {{$beli->links()}}
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
            url: '/beli', // Ganti dengan URL rute Anda
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
                    label: 'Jumlah Pembelian',
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
