@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <i class="bi bi-plus-circle"></i> Tambah Ekskul Baru
                            </div>
                            <div class="card-body">
                                <form action="{{ route('ekskul.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Nama Ekskul</label>
                                        <input type="text" name="nama" class="form-control" required
                                            placeholder="Misal: Basket">
                                    </div>
                                    <div class="mb-3">
                                        <label>Jadwal Latihan</label>
                                        <input type="text" name="jadwal" class="form-control" required
                                            placeholder="Misal: Rabu, 15:00">
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi Singkat</label>
                                        <textarea name="deskripsi" class="form-control" rows="3" required placeholder="Deskripsi kegiatan..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Simpan Ekskul</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Data Siswa Pendaftar
                            </div>
                            <div class="card-body">
                                @if ($siswa->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Kelas</th>
                                                    <th>Ekskul Pilihan</th>
                                                    <th>No. WA</th>
                                                    <th>Tanggal Daftar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($siswa as $key => $data)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td class="fw-bold">{{ $data->nama_siswa }}</td>
                                                        <td>{{ $data->kelas }}</td>
                                                        <td>
                                                            <span class="badge bg-success">{{ $data->ekskul->nama }}</span>
                                                        </td>
                                                        <td>
                                                            <a href="https://wa.me/{{ $data->no_wa }}" target="_blank"
                                                                class="text-decoration-none">
                                                                {{ $data->no_wa }}
                                                            </a>
                                                        </td>
                                                        <td><small>{{ $data->created_at->format('d M Y') }}</small></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-center text-muted my-4">Belum ada siswa yang mendaftar.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
