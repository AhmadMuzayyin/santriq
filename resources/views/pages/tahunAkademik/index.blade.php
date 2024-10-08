@extends('layouts.master')
@section('title')
    Data Tahun Akademik
@endsection
@section('page-title')
    Data Tahun Akademik
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title mb-0">Data Tahun Akademik</h4>
                        </div>
                        <div class="col">
                            <a href="javascript:;" role="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#myModal">Tambah Data</a>
                            <x-modal id="myModal" title="Tambah Data Tahun Akademik">
                                <form action="{{ route('tahun.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group mt-2">
                                        <label for="tahun">Tahun Akademik</label>
                                        <input type="number" class="form-control @error('tahun') is-invalid @enderror"
                                            id="tahun" name="tahun" min="2024" value="{{ old('tahun') }}"
                                            required>
                                        @error('tahun')
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
                                    <th class="text-center">Tahun</th>
                                    <th class="text-center">Semester</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tahun->groupBy('tahun') as $thn)
                                    {{-- @dd($thn) --}}
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $thn[0]->tahun }}</td>
                                        <td class="text-center">
                                            {{ $thn[0]->semester }}/{{ $thn[1]->semester }}
                                        </td>
                                        <td class="text-center">
                                            @if ($thn[0]->status == 1)
                                                <a href="{{ route('tahun.aktif', $thn[0]->id) }}">
                                                    <span class="badge bg-success-subtle text-success">Aktif</span>
                                                </a>
                                            @else
                                                <a href="{{ route('tahun.aktif', $thn[0]->id) }}">
                                                    <span class="badge bg-danger-subtle text-danger">Tidak Aktif</span>
                                                </a>
                                            @endif
                                            /
                                            @if ($thn[1]->status == 1)
                                                <a href="{{ route('tahun.aktif', $thn[1]->id) }}">
                                                    <span class="badge bg-success-subtle text-success">Aktif</span>
                                                </a>
                                            @else
                                                <a href="{{ route('tahun.aktif', $thn[1]->id) }}">
                                                    <span class="badge bg-danger-subtle text-danger">Tidak Aktif</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:;" role="button" class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#edit-{{ $loop->iteration }}">Edit</a>
                                            <a href="javascript:;" role="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#hapus-{{ $loop->iteration }}">Hapus</a>
                                            <x-modal id="hapus-{{ $loop->iteration }}" title="Hapus Data Tahun Akademik"
                                                position="modal-dialog-centered">
                                                <form class="text-center"
                                                    action="{{ route('tahun.destroy', $thn[0]->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <p>
                                                        Apakah anda yakin ingin menghapus data tahun akademik ini?
                                                    </p>
                                                    <div class="form-group mt-3">
                                                        <button type="button" data-bs-dismiss="modal"
                                                            class="btn btn-secondary">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                        <x-modal id="edit-{{ $loop->iteration }}" title="Edit Data Tahun Akademik">
                                            <form action="{{ route('tahun.update', $thn[0]->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group mt-2">
                                                    <label for="tahun">Tahun Akademik</label>
                                                    <input type="number"
                                                        class="form-control @error('tahun') is-invalid @enderror"
                                                        id="tahun" name="tahun"
                                                        value="{{ old('tahun') ?? $thn[0]->tahun }}" min="2024"
                                                        required>
                                                    @error('tahun')
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
