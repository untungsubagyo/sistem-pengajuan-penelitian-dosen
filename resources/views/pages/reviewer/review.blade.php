@extends('layout.reviewer')

@section('content-reviewer')
<div class="p-4 container">
   <div>
      <div class="d-flex justify-content-between align-items-center mb-5">
         <div class="d-flex align-items-center gap-3">
            <h2>Review Proposal</h2>
            @if (count($data_review_proposal) > 0)
               <span class="badge py-2 px-3 {{ $data_review_proposal[0]['status'] == 'verify' ? 'bg-success' : 'bg-warning' }}">{{ $data_review_proposal[0]['status'] == 'verify' ? 'Sudah di verifikasi oleh anda' : 'Berada di draf anda' }}</span>
            @endif
         </div>
         <a href="javascript:window.history.back()" class="btn btn-outline-dark">Kembali</a>
      </div>

      <div class="d-flex gap-4 mb-4 flex-lg-row flex-column">
         <div class="d-flex flex-column gap-4">
            <div style="border-radius: 1.5rem; box-shadow: 2px 2px 5px 1px #9c9c9c1a; padding: 1.5rem">
               <h4 class="mb-4">Pemilik</h4>
               <div class="row row-cols-2">
                  <span class="col-3 mb-1">Nama</span>
                  <span class="col-9"> : {{ $data_proposal->pemilik }}</span>

                  <span class="col-3 mb-1">Email</span>
                  <span class="col-9"> : {{ $data_proposal->email }}</span>

                  <span class="col-3 mb-1">NIP</span>
                  <span class="col-9"> : {{ $data_proposal->nip }}</span>

                  <span class="col-3 mb-1">NIDN</span>
                  <span class="col-9"> : {{ $data_proposal->nidn }}</span>

                  <span class="col-3 mb-1">Rumpun</span>
                  <span class="col-9"> : {{ $data_proposal->rumpun }}</span>

                  <span class="col-3 mb-1">No Telepon</span>
                  <span class="col-9"> : {{ $data_proposal->no_telepon }}</span>

                  <span class="col-3 mb-1">Jabatan</span>
                  <span class="col-9"> : {{ $data_proposal->jabatan }}</span>
               </div>
            </div>

            <div style="border-radius: 1.5rem; box-shadow: 2px 2px 5px 1px #9c9c9c1a; padding: 1.5rem">
               <h4 class="mb-4">Skema Penelitian</h4>
               <div class="row row-cols-2">
                  <span class="col-3 mb-1">Nama Skema</span>
                  <span class="col-9">: {{ $data_proposal->nama_skema }}</span>

                  <span class="col-3 mb-1">Sumber Dana</span>
                  <span class="col-9">: {{ $data_proposal->sumber_dana }}</span>

                  <span class="col-3 mb-1">Durasi</span>
                  <span class="col-9">: {{ $data_proposal->durasi }} {{ $data_proposal->satuan_durasi }}</span>

                  <span class="col-3 mb-1">Total Biaya</span>
                  <span class="col-9">: Rp {{ number_format($data_proposal->total_biaya, 0, ',', '.') }}</span>

                  <span class="col-3 mb-1">Bobot Rumusan Masalah</span>
                  <span class="col-9">: {{ $data_proposal->bobot_rumusan_masalah }}</span>

                  <span class="col-3 mb-1">Bobot Luaran</span>
                  <span class="col-9">: {{ $data_proposal->bobot_luaran }}</span>

                  <span class="col-3 mb-1">Bobot Metode</span>
                  <span class="col-9">: {{ $data_proposal->bobot_metode }}</span>

                  <span class="col-3 mb-1">Bobot Tinjauan Pustaka</span>
                  <span class="col-9">: {{ $data_proposal->bobot_tinjauan_pustaka }}</span>

                  <span class="col-3 mb-1">Bobot Kelayakan</span>
                  <span class="col-9">: {{ $data_proposal->bobot_kelayakan }}</span>
               </div>
            </div>

            <div style="border-radius: 1.5rem; box-shadow: 2px 2px 5px 1px #9c9c9c1a; padding: 1.5rem">
               <div class="d-flex justify-content-between align-items-top">
                  <h4 class="mb-4">Proposal</h4>
                  @if (isset($data_proposal->status_approvel))
                     <div style="text-align: right;">
                        <span
                           title="status approvel"
                           style="cursor: help;"
                           class="badge {{ $data_proposal->status_approvel == 'diterima' ? 'bg-success' : 'bg-danger' }}">{{ $data_proposal->status_approvel }}</span>
                        <p class="fst-italic" style="color: rgba(0, 0, 0, 0.3)">pada tanggal, {{ now() }}</p>
                     </div>
                  @endif
               </div>

               <div>
                  <h5 class="text-center mb-3">{{ $data_proposal->judul }}</h5>
                  <div>
                     <h6 class="mb-1">Nama Mitra</h6>
                     <p>{{ $data_proposal->nama_mitra }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Alamat Mitra</h6>
                     <p>{{ $data_proposal->alamat_mitra }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Kata Kunci</h6>
                     <p>{{ $data_proposal->kata_kunci }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Latar Belakang</h6>
                     <p>{{ $data_proposal->latar_belakang }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Ringkasan</h6>
                     <p>{{ $data_proposal->ringkasan }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Urgensi</h6>
                     <p>{{ $data_proposal->urgensi }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Rumusan Masalah</h6>
                     <p>{{ $data_proposal->rumusan_masalah }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Pendekatan Pemecahan Masalah</h6>
                     <p>{{ $data_proposal->pendekatan_pemecahan_masalah }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Kebaruan</h6>
                     <p>{{ $data_proposal->kebaruan }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Metode Penelitian</h6>
                     <p>{{ $data_proposal->metode_penelitian }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Jadwal Penelitian</h6>
                     <p>{{ $data_proposal->jadwal_penelitian }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Daftar Pustaka</h6>
                     <p>{{ $data_proposal->daftar_pustaka }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Tanggal Submit</h6>
                     <p>{{ $data_proposal->tanggal_submit }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Laporan Progress</h6>
                     <p>{{ $data_proposal->laporan_progress }}</p>
                  </div>
                  <div>
                     <h6 class="mb-1">Laporan Akhir</h6>
                     <p>{{ $data_proposal->laporan_akhir }}</p>
                  </div>
               </div>
            </div>

         </div>
         <div class="d-flex flex-column gap-4">
            <div style="border-radius: 1.5rem; box-shadow: 2px 2px 5px 1px #9c9c9c1a; padding: 1.5rem">
               <h4 class="mb-4">Tim Litabmas</h4>
               <div>
                  @foreach ($data_timLitabmas as $data)
                 <div class="border-bottom border-1 mb-3 pb-2">
                   <span
                     class="badge mb-1 {{ $data['status'] == 'Anggota' ? 'bg-success' : 'bg-info' }}">{{ $data['status'] }}</span>
                   <p class="p-0 m-0">Nama : {{ $data['nama'] }}</p>
                   <p class="p-0 m-0">Tugas : {{ $data['tugas'] }}</p>
                 </div>
              @endforeach
               </div>
            </div>

            <div style="border-radius: 1.5rem; box-shadow: 2px 2px 5px 1px #9c9c9c1a; padding: 1.5rem">
               <h4 class="mb-4">Capaian</h4>
               <div>
                  @foreach ($data_capaian as $data)
                 <div class="border-bottom border-1 mb-3 pb-2">
                   <div class="d-flex justify-content-between mb-3">
                     <h5>{{ $data['tahun'] }}</h5>
                     <span class="badge bg-dark px-4">{{ $data['jenis_capaian'] }}</span>
                   </div>
                   <p class="m-0">{{ $data['indikator'] }}</p>
                 </div>
              @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
   <div>
      <h2>Nilai Proposal</h2>

      @if (count($data_review_proposal) > 0)
         @if ($data_review_proposal[0]['status'] == 'verify')
            <div style="border-radius: 1.5rem; box-shadow: 2px 2px 5px 1px #9c9c9c1a; padding: 1.5rem; display: flex; flex-direction: column; gap: 1.5rem;">
               <div>
                  <label for="skor_rumusan_masalah" class="fw-bold mb-2">Skor Rumusan Masalah</label>
                  <input readonly type="number" min="1" max="5" name="skor_rumusan_masalah" class="form-control"
                     id="skor_rumusan_masalah"
                     value="{{ old('skor_rumusan_masalah', count($data_review_proposal) > 0 ? $data_review_proposal[0]['skor_rumusan_masalah'] : '')  }}"
                     required>
               </div>
               <div>
                  <label for="skor_luaran" X class="fw-bold mb-2">Skor Luaran</label>
                  <input readonly type="number" min="1" max="5" name="skor_luaran" class="form-control" id="skor_luaran"
                     value="{{ old('skor_luaran', count($data_review_proposal) > 0 ? $data_review_proposal[0]['skor_luaran'] : '') }}"
                     required>
               </div>
               <div>
                  <label for="skor_metode" class="fw-bold mb-2">Skor Metode</label>
                  <input readonly type="number" min="1" max="5" name="skor_metode" class="form-control" id="skor_metode"
                     value="{{ old('skor_metode', count($data_review_proposal) > 0 ? $data_review_proposal[0]['skor_metode'] : '') }}"
                     required>
               </div>
               <div>
                  <label for="skor_tinjauan_pustaka" class="fw-bold mb-2">Skor Tinjauan Pustaka</label>
                  <input readonly type="number" min="1" max="5" name="skor_tinjauan_pustaka" class="form-control"
                     id="skor_tinjauan_pustaka"
                     value="{{ old('skor_tinjauan_pustaka', count($data_review_proposal) > 0 ? $data_review_proposal[0]['skor_tinjauan_pustaka'] : '') }}"
                     required>
               </div>
               <div>
                  <label for="skor_kelayakan_umum" class="fw-bold mb-2">Skor Kelayakan Umum</label>
                  <input readonly type="number" min="1" max="5" name="skor_kelayakan_umum" class="form-control"
                     id="skor_kelayakan_umum"
                     value="{{ old('skor_kelayakan_umum', count($data_review_proposal) > 0 ? $data_review_proposal[0]['skor_kelayakan_umum'] : '') }}"
                     required>
               </div>
               <div>
                  <label for="file" class="fw-bold mb-2">File Review</label>
                  <a target="_blank" href="{{ Storage::url($data_review_proposal[0]['file']) }}" class="form-control bg-white">Lihat</a>
               </div>
               <div>
                  <label for="catatan" class="fw-bold mb-2">Catatat</label>
                  <textarea readonly name="catatan" id="catatan" class="form-control" required>{{ old('catatan',  count($data_review_proposal) > 0 ? $data_review_proposal[0]['catatan'] : '') }}</textarea>
               </div>
            </div>
         @else
            <form action="{{ route('post-review', $data_proposal->id) }}" method="post" enctype="multipart/form-data"
               style="border-radius: 1.5rem; box-shadow: 2px 2px 5px 1px #9c9c9c1a; padding: 1.5rem; display: flex; flex-direction: column; gap: 1.5rem;">
               @csrf
               <div>
                  <label for="skor_rumusan_masalah" class="fw-bold mb-2">Skor Rumusan Masalah</label>
                  <input type="number" min="1" max="5" name="skor_rumusan_masalah" class="form-control"
                     id="skor_rumusan_masalah"
                     value="{{ old('skor_rumusan_masalah', count($data_review_proposal) > 0 ? $data_review_proposal[0]['skor_rumusan_masalah'] : '')  }}"
                     required>
               </div>
               <div>
                  <label for="skor_luaran" X class="fw-bold mb-2">Skor Luaran</label>
                  <input type="number" min="1" max="5" name="skor_luaran" class="form-control" id="skor_luaran"
                     value="{{ old('skor_luaran', count($data_review_proposal) > 0 ? $data_review_proposal[0]['skor_luaran'] : '') }}"
                     required>
               </div>
               <div>
                  <label for="skor_metode" class="fw-bold mb-2">Skor Metode</label>
                  <input type="number" min="1" max="5" name="skor_metode" class="form-control" id="skor_metode"
                     value="{{ old('skor_metode', count($data_review_proposal) > 0 ? $data_review_proposal[0]['skor_metode'] : '') }}"
                     required>
               </div>
               <div>
                  <label for="skor_tinjauan_pustaka" class="fw-bold mb-2">Skor Tinjauan Pustaka</label>
                  <input type="number" min="1" max="5" name="skor_tinjauan_pustaka" class="form-control"
                     id="skor_tinjauan_pustaka"
                     value="{{ old('skor_tinjauan_pustaka', count($data_review_proposal) > 0 ? $data_review_proposal[0]['skor_tinjauan_pustaka'] : '') }}"
                     required>
               </div>
               <div>
                  <label for="skor_kelayakan_umum" class="fw-bold mb-2">Skor Kelayakan Umum</label>
                  <input type="number" min="1" max="5" name="skor_kelayakan_umum" class="form-control"
                     id="skor_kelayakan_umum"
                     value="{{ old('skor_kelayakan_umum', count($data_review_proposal) > 0 ? $data_review_proposal[0]['skor_kelayakan_umum'] : '') }}"
                     required>
               </div>
               <div>
                  <label for="file" class="fw-bold mb-2">File Review</label>
                  <input type="file" name="file" class="form-control" id="file" style="cursor: pointer;" required>
               </div>
               <div>
                  <label for="catatan" class="fw-bold mb-2">Catatat</label>
                  <textarea name="catatan" id="catatan" class="form-control" required>{{ old('catatan',  count($data_review_proposal) > 0 ? $data_review_proposal[0]['catatan'] : '') }}</textarea>
               </div>

               <div class="d-flex align-items-center gap-2 justify-content-end" style="grid-column: span 12;">
                  <input name="status-draf" type="submit" class="btn btn-outline-dark" value="Edit dan Simpan Ke Draf">
                  <input name="status-verify" type="submit" class="btn btn-dark" value="Verifikasi">
               </div>
            </form>
         @endif
      @else
         <form action="{{ route('post-review', $data_proposal->id) }}" method="post" enctype="multipart/form-data"
            style="border-radius: 1.5rem; box-shadow: 2px 2px 5px 1px #9c9c9c1a; padding: 1.5rem; display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf
            <div>
               <label for="skor_rumusan_masalah" class="fw-bold mb-2">Skor Rumusan Masalah</label>
               <input type="number" min="1" max="5" name="skor_rumusan_masalah" class="form-control"
                  id="skor_rumusan_masalah"
                  value="{{ old('skor_rumusan_masalah')  }}"
                  required>
            </div>
            <div>
               <label for="skor_luaran" X class="fw-bold mb-2">Skor Luaran</label>
               <input type="number" min="1" max="5" name="skor_luaran" class="form-control" id="skor_luaran"
                  value="{{ old('skor_luaran') }}"
                  required>
            </div>
            <div>
               <label for="skor_metode" class="fw-bold mb-2">Skor Metode</label>
               <input type="number" min="1" max="5" name="skor_metode" class="form-control" id="skor_metode"
                  value="{{ old('skor_metode') }}"
                  required>
            </div>
            <div>
               <label for="skor_tinjauan_pustaka" class="fw-bold mb-2">Skor Tinjauan Pustaka</label>
               <input type="number" min="1" max="5" name="skor_tinjauan_pustaka" class="form-control"
                  id="skor_tinjauan_pustaka"
                  value="{{ old('skor_tinjauan_pustaka') }}"
                  required>
            </div>
            <div>
               <label for="skor_kelayakan_umum" class="fw-bold mb-2">Skor Kelayakan Umum</label>
               <input type="number" min="1" max="5" name="skor_kelayakan_umum" class="form-control"
                  id="skor_kelayakan_umum"
                  value="{{ old('skor_kelayakan_umum') }}"
                  required>
            </div>
            <div>
               <label for="file" class="fw-bold mb-2">File Review</label>
               <input type="file" name="file" class="form-control" id="file" style="cursor: pointer;" required>
            </div>
            <div>
               <label for="catatan" class="fw-bold mb-2">Catatat</label>
               <textarea name="catatan" id="catatan" class="form-control" required>{{ old('catatan',  count($data_review_proposal) > 0 ? $data_review_proposal[0]['catatan'] : '') }}</textarea>
            </div>

            <div class="d-flex align-items-center gap-2 justify-content-end" style="grid-column: span 12;">
               <input name="status-draf" type="submit" class="btn btn-outline-dark" value="Tambah Ke Draf">
               <input name="status-verify" type="submit" class="btn btn-dark" value="Verifikasi">
            </div>
         </form>
      @endif
   </div>
</div>

@if (count($data_review_proposal) > 0)
   <script>
      // window.onload = () => {
         const fileInput = document.getElementById('file')
         const dataTr = new DataTransfer()
         console.log(fileInput);
         try {
            fetch('{{ Storage::url($data_review_proposal[0]['file']) }}')
               .then(data => data.blob())
               .then(file => {
                  const documentFile = new File([file], `previous-file-(${file.type})`, { type: file.type })
                  dataTr.items.add(documentFile)
                  fileInput.files = dataTr.files
               })
         } catch (error) {
            console.log(error)
         }
      // }
   </script>
@endif
@endsection