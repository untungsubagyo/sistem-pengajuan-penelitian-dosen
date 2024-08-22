@extends('layout.root')

@section('content')
<div class="pagetitle">
    <h1>Profil Saya</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Profil Saya</li>
        </ol>
    </nav>
</div>

@if ($errors->any())
    <ul class="alert alert-danger" style="padding-left: 2rem;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<div class="row">
    @if (Session('message'))
        <div class="alert alert-success">{{ Session('message') }}</div>
    @endif
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                @if (isset($dataProfile->profile_photo))
                    <img src="{{ Storage::url($dataProfile->profile_photo) }}"
                        style="width: 8rem; height: 8rem; object-fit: cover;" alt="Profile" class="rounded-circle">
                @else
                    <div
                        style="width: 8rem; height: 8rem; border-radius: 50%; background-color: gray; text-align: center; line-height: 8rem; font-size: 1.8rem; color: white">
                        {{ substr($dataProfile->nama, 0, 2) }}
                    </div>
                @endif

                <h2>{{ $dataProfile->nama }}</h2>
                <p>{{ $dataProfile->email }}</p>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-body pt-3">
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#profile-overview">Overview</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profil</button>
                    </li>
                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade profile-overview {{ $errors->any() ? '' : 'show active' }}" id="profile-overview">
                        <h5 class="card-title">Detail Profil</h5>

                        <div class="row mb-2">
                            <div class="col-lg-3 col-md-4 label fw-bold">Nama</div>
                            <div class="col-lg-9 col-md-8">{{ $dataProfile->nama }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3 col-md-4 label fw-bold">NIP</div>
                            <div class="col-lg-9 col-md-8">{{ $dataProfile->nip }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3 col-md-4 label fw-bold">Email</div>
                            <div class="col-lg-9 col-md-8">{{ $dataProfile->email }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3 col-md-4 label fw-bold">No. Telepon</div>
                            <div class="col-lg-9 col-md-8">{{ $dataProfile->no_telepon }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-lg-3 col-md-4 label fw-bold">Rumpun</div>
                            <div class="col-lg-9 col-md-8">{{ $dataProfile->rumpun }}</div>
                        </div>

                        <div class="row mb-2">
    <div class="col-lg-3 col-md-4 label fw-bold">Jabatan</div>
    <div class="col-lg-9 col-md-8">{{ $dataProfile->jabatan->nama ?? 'N/A' }}</div>
</div>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3 {{ $errors->any() ? 'show active' : '' }}" id="profile-edit">
                        <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                                <div class="col-md-8 col-lg-9">
                                    <div id="trigger-input-img"
                                        style="cursor: pointer; width: 8rem; height: 8rem; background-color: gray; display: flex; align-items: center; justify-content: center;">
                                        @if (isset($dataProfile->profile_photo))
                                            <img src="{{ Storage::url($dataProfile->profile_photo) }}"
                                                style="width: 100%; height: 100%; object-fit: cover;" alt="Profile" class="rounded-circle">
                                        @else
                                            <span style="color: white; font-size: 1.8rem;">{{ substr($dataProfile->nama, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <input type="file" id="profileImage" name="profile_photo" style="display: none;">
                                    <input type="hidden" name="request-del-profile" value="false">
                                    <button type="button" class="btn btn-danger mt-2" id="delete-profile-image">Hapus Foto</button>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama Lengkap</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="nama" type="text" class="form-control" id="fullName"
                                        value="{{ old('nama') ?? $dataProfile->nama }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-lg-3 col-form-label">NIP</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="nidn" type="text" class="form-control" id="username"
                                        value="{{ old('nip') ?? $dataProfile->nip }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email" class="form-control" id="email"
                                        value="{{ old('email') ?? $dataProfile->email }}" >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="noTelepon" class="col-md-4 col-lg-3 col-form-label">No. Telepon</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="no_telepon" type="text" class="form-control" id="noTelepon"
                                        value="{{ old('no_telepon') ?? $dataProfile->no_telepon }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="rumpun" class="col-md-4 col-lg-3 col-form-label">Rumpun</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="rumpun" type="text" class="form-control" id="rumpun"
                                        value="{{ old('rumpun') ?? $dataProfile->rumpun }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jabatan" class="col-md-4 col-lg-3 col-form-label">Jabatan</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="jabatan" type="text" class="form-control" id="jabatan"
                                        value="{{ old('jabatan') ?? $dataProfile->jabatan->nama }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password" type="password" class="form-control" id="password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="confirmPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password Baru</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password_confirmation" type="password" class="form-control" id="confirmPassword">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div><!-- End Bordered Tabs -->
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('trigger-input-img').addEventListener('click', function() {
        document.getElementById('profileImage').click();
    });

    document.getElementById('delete-profile-image').addEventListener('click', function() {
        const confirmed = confirm('Anda yakin ingin menghapus foto profil?');
        if (confirmed) {
            document.getElementById('profileImage').value = ''; // Clear the file input
            document.querySelector('[name="request-del-profile"]').value = 'true'; // Set hidden input to true
            document.getElementById('trigger-input-img').innerHTML = '<span style="color: white; font-size: 1.8rem;">{{ substr($dataProfile->nama, 0, 2) }}</span>'; // Reset the display image to initials
        }
    });
</script>
@endsection
