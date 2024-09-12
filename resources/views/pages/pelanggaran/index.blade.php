@extends('layouts.master')
@section('title')
    Data Pelanggaran
@endsection
@section('page-title')
    Data Pelanggaran
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title mb-0">Data Pelanggaran</h4>
                        </div>
                        <div class="col">
                            <a href="javascript:;" role="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#myModal">Tambah Data</a>
                            <x-modal id="myModal" title="Tambah Data Pelanggaran">
                                <form action="{{ route('pelanggaran.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <label for="nama">Nama Pelanggaran</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </x-modal>
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pelanggaran as $pl)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $pl->nama }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" role="button" class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $loop->iteration }}">Edit</a>
                                            <a href="javascript:;" role="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapus-{{ $loop->iteration }}">Hapus</a>
                                            <x-modal id="hapus-{{ $loop->iteration }}" title="Hapus Data Pelanggaran"
                                                position="modal-dialog-centered">
                                                <form class="text-center"
                                                    action="{{ route('pelanggaran.destroy', $pl->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>
                                                        Apakah anda yakin ingin menghapus data Pelanggaran ini?
                                                    </p>
                                                    <div class="form-group mt-3">
                                                        <button type="button" data-bs-dismiss="modal"
                                                            class="btn btn-secondary">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                        <x-modal id="edit-{{ $loop->iteration }}" title="Edit Data pelanggaran">
                                            <form action="{{ route('pelanggaran.update', $pl->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mt-2">
                                                    <label for="nama">Nama Lengkap</label>
                                                    <input type="text"
                                                        class="form-control @error('nama') is-invalid @enderror"
                                                        id="nama" name="nama"
                                                        value="{{ old('nama') ?? $pl->nama }}" required>
                                                    @error('nama')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-2">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endpush
