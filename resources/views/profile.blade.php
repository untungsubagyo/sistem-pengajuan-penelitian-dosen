@extends('layouts.root-layout')



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
                  {{ substr(Auth::user()->nama, 0, 2) }}
               </div>
            @endif

            <h2>{{ $dataProfile->name }}</h2>
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
                     <div class="col-lg-9 col-md-8">{{ $dataProfile->name }}</div>
                  </div>

                  <div class="row mb-2">
                     <div class="col-lg-3 col-md-4 label fw-bold">Username/NIDN</div>
                     <div class="col-lg-9 col-md-8">{{ $dataProfile->username }}</div>
                  </div>

                  <div class="row mb-2">
                     <div class="col-lg-3 col-md-4 label fw-bold">Email</div>
                     <div class="col-lg-9 col-md-8">{{ $dataProfile->email }}</div>
                  </div>

                  <div class="row mb-2">
                     <div class="col-lg-3 col-md-4 label fw-bold">Tipe Akun</div>
                     <div class="col-lg-9 col-md-8">

                     </div>
                  </div>

                  
                     <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label fw-bold">Golongan</div>
                        <div class="col-lg-9 col-md-8">{{ $dataDosen[0]->golongan }}</div>
                     </div>
                     <div class="row mb-2">
                        <div class="col-lg-3 col-md-4 label fw-bold">Pangkat</div>
                        <div class="col-lg-9 col-md-8">{{ $dataDosen[0]->pangkat }}</div>
                     </div>
                  
               </div>

               <div class="tab-pane fade profile-edit pt-3 {{ $errors->any() ? 'show active' : '' }}" id="profile-edit">
                  <form action="{{ route('my_profile.update') }}" method="post" enctype="multipart/form-data">
                     @csrf
                     @method('put')
                     <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Foto Profil</label>
                        <div class="col-md-8 col-lg-9">
                           <div id="trigger-input-img"
                              style="cursor: pointer; width: 8rem; height: 8rem; background-color: gray ; display: flex; align-items: center; justify-content: center;">
@if (isset($dataProfile->profile_photo))
<img src="{{ Storage::url($dataProfile->profile_photo) }}"
                                 style="width: 100%; height: 100%; object-fit: cover;" alt="Profile" class="rounded-circle">
@else
<span style="color: white; font-size: 1.8rem;">{{ substr(Auth::user()->name, 0, 2) }}</span>
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
                       <input name="name" type="text" class="form-control" id="fullName"
                          value="{{ old('name') ?? $dataProfile->name }}" required>
                    </div>
                 </div>

                 <div class="row mb-3">
                    <label for="username" class="col-md-4 col-lg-3 col-form-label">Username/NIDN</label>
                    <div class="col-md-8 col-lg-9">
                       <input name="username" type="text" class="form-control" id="username"
                          value="{{ old('username') ?? $dataProfile->username }}" required>
                    </div>
                 </div>

                 <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                       <input name="email" type="email" class="form-control" id="email"
                          value="{{ old('email') ?? $dataProfile->email }}" required>
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

                
                    <div class="row mb-3">
                       <label for="golongan" class="col-md-4 col-lg-3 col-form-label">Golongan</label>
                       <div class="col-md-8 col-lg-9">
                          <select name="id_golongan" class="form-control" id="golongan">
                             @foreach ($dataGolongan as $golongan)
                                <option value="{{ $golongan->id }}"
                                   {{ (old('id_golongan') ?? $dataDosen[0]->gol_id) == $golongan->id ? 'selected' : '' }}>
                                   {{ $golongan->golongan }} - {{ $golongan->pangkat }}
                                </option>
                             @endforeach
                          </select>
                       </div>
                    </div>
                

                 <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                 </div>
              </form>
           </div>
        </div>
     </div>
  </div>
  </div>
</div>
<script>
   document.getElementById('trigger-input-img').addEventListener('click', function() {
      document.getElementById('profileImage').click();
   });

   document.getElementById('delete-profile-image').addEventListener('click', function() {
      document.querySelector('input[name="request-del-profile"]').value = 'true';
      document.querySelector('form').submit();
   });
</script>
@endsection