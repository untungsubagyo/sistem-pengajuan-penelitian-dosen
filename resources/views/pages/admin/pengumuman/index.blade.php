@extends('layout.admin')

@section('content-admin')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pengumuman</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengumuman</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <!-- table bordered -->
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th>TANGGAL PENGUMUMAN</th>
                                <th>JUDUL</th>
                                <th>DESKRIPSI</th>
                                <th>FILE</th>
                                <th>STATUS</th>
                                <th>AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $index => $data )
                                    <tr>
                                        <td>{{$data->tanggal}}</td>
                                        <td>{{$data->judul}}</td>
                                        <td>{{$data->deskripsi}}</td>
                                        <td>{{$data->file}}</td>
                                        <td>{{$data->status}}</td>
                                        <td>
                                            <a href="{{ route('pengumuman.edit', $data->id) }}" class="btn icon icon-left btn-outline-warning"><i data-feather="Edit">Edit</i></a>
                                            <button class="btn icon icon-left btn-outline-danger" onclick="confirmDelete('{{ $data->id }}')"><i data-feather="delete">Hapus</i></button>
                                            <form id="delete-form-{{ $data->id }}" action="{{ route('pengumuman.destroy', $data->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center alert alert-danger">Pengumuman masih kosong</td>
                                    </tr>
                                 @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bordered table end -->
    </div>

    <footer>
        <div class="footer clearfix mb-0 text-muted">
            <div class="float-start">
                <p>2024 &copy; Voler</p>
            </div>
            <div class="float-end">
                <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="https://saugi.me">Saugi</a></p>
            </div>
        </div>
    </footer>
     <script>
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            }
@endsection