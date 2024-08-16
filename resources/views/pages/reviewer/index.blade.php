@extends('layout.reviewer')

@section('content-reviewer')
<style>
	#proposal-card-container {
		display: grid; 
		grid-template-columns: 1fr 1fr 1fr;
	}
	
	@media only screen and (max-width: 1024px) {
		#proposal-card-container {
			grid-template-columns: 1fr 1fr;
		}
	}
	
	@media only screen and (max-width: 768px) {
		#proposal-card-container {
			grid-template-columns: 1fr;
		}
	}
</style>

<div class="container">
	<div class="mb-5">
		<h2 class="text-center mb-4">{{ isset($isViewAllDraft) ? 'Draft Anda' : 'Daftar Proposal yang Sudah di Submit' }}</h2>
		<form action="#">
			<div class="form-group position-relative has-icon-left">
				<input name="q" type="text" class="form-control" value="{{ $q }}"
					placeholder="Ketik judul proposal, nama pemilik, NIDN pemilik atau kata kunci proposal">
				<div class="form-control-icon">
					<i data-feather="search"></i>
				</div>
			</div>
		</form>

		@if (isset($q))
			@if (count($data_proposal) > 0)
				<h5 class="text-center">Menampilkan Hasil Pencarian "{{ $q }}"</h5>
			@else
				<h5 class="text-center">"{{ $q }}" Tidak di Temukan, Coba Kata Kunci Lain</h5>
			@endif
		@endif
	</div>
	<div class="gap-4 mb-4" id="proposal-card-container">
		@forelse ($data_proposal as $data)
			<div class="p-4"
				style="border-radius: 1.5rem; box-shadow: 2px 2px 8px 0 #1f1f1f1a;">
				<h5 class="text-center">{{ $data['judul'] }}</h5>
				<p class="text-center mt-3">
					<strong>
						Disusun Oleh
						<br>
						{{ $data['pemilik'] }}
					</strong>
					<br>
					{{ $data['nip'] }}/{{ $data['nidn'] }}
				</p>
				<p style="line-height: 3ch;">
					<strong>kata kunci : </strong>{{ $data['kata_kunci'] }} <br>
					<strong>jumlah tim litabmas : </strong>{{ count($data['timLitabmas']) }} <br>
					<strong>jumlah capaian : </strong>{{ count($data['capaian']) }}
				</p>
				<div class="row">
					<div class="col-8">
						@if ($data['review_status'] == 'verify')
							<a href="{{ route('review', $data['id']) }}" class="btn btn-outline-dark btn-sm">Lihat</a>
							<span class="badge bg-success py-2 px-3">terverifikasi</span>
						@elseif ($data['review_status'] == 'draf')
							<a href="{{ route('review', $data['id']) }}" class="btn btn-outline-dark btn-sm">Edit</a>
							<a href="{{ route('reviewer.viewAllDraf') }}" class="badge bg-warning py-2 px-3">dalam draf</a>
						@else
							<a href="{{ route('review', $data['id']) }}" class="btn btn-outline-dark btn-sm">{{ isset($isViewAllDraft) ? 'Edit' : 'Review' }}</a>
							@if (isset($isViewAllDraft))
								<form id="delete-review" action="{{ route('reviewer.delete', $data['id_review']) }}" class="d-inline" method="post">
									@csrf
									@method('DELETE')
									<input type="submit" value="hapus review" class="btn btn-outline-danger btn-sm">
								</form>
							@endif
						@endif
					</div>
					<div class="col">
						<p style="text-align: right; font-style: italic; line-height: normal;">
							di submit <br>
							{{ $data['tanggal_submit'] }}
						</p>
					</div>
				</div>
			</div>
		@empty
			@if (!isset($q))
				<p>{{ isset($isViewAllDraft) ? 'Draf Anda Masih Kosong' : 'belum ada proposal yang di submit'}}</p>
			@endif
		@endforelse
	</div>

	<div style="display: flex; justify-content: center; align-items: center;">
		<ul class="pagination">
			<li class="page-item">
				<a href="{{ $data_proposal_paginate->url(1) }}" class="page-link">First</a>
			</li>
			<li class="page-item">
				@if ($data_proposal_paginate->previousPageUrl() == null)
					<a href="#" class="page-link disabled">Previous</a>
				@else
					<a href="{{ $data_proposal_paginate->previousPageUrl() }}" class="page-link">Previous</a>
				@endif
			</li>
			@php
				$startPage = max($data_proposal_paginate->currentPage() - 2, 1);
				$endPage = min($data_proposal_paginate->currentPage() + 2, $data_proposal_paginate->lastPage());
			@endphp
			@if ($startPage > 1)
				<li class="page-item">
					<a href="{{ $data_proposal_paginate->url(1) }}" class="page-link">1</a>
				</li>
				@if ($startPage > 2)
					<li class="page-item">
						<span class="pagination-ellipsis">...</span>
					</li>
				@endif
			@endif
			@foreach(range($startPage, $endPage) as $page)
				<li class="page-item">
					<a href="{{ $data_proposal_paginate->url($page) }}" class="page-link">{{ $page }}</a>
				</li>
			@endforeach
			@if ($endPage < $data_proposal_paginate->lastPage())
				@if ($endPage < $data_proposal_paginate->lastPage() - 1)
					<li class="page-item">
						<span class="pagination-ellipsis">...</span>
					</li>
				@endif
				<li class="page-item">
					<a href="{{ $data_proposal_paginate->url($data_proposal_paginate->lastPage()) }}"
						class="page-link">{{ $data_proposal_paginate->lastPage() }}</a>
				</li>
			@endif
			<li class="page-item">
				@if ($data_proposal_paginate->nextPageUrl() == null)
					<a href="#" class="page-link disabled">Next</a>
				@else
					<a href="{{ $data_proposal_paginate->nextPageUrl() }}" class="page-link">Next</a>
				@endif
			</li>
			<li class="page-item">
				@if ($data_proposal_paginate->url($data_proposal_paginate->lastPage()) == null)
					<a href="#" class="page-link disabled">Last</a>
				@else
					<a href="{{ $data_proposal_paginate->url($data_proposal_paginate->lastPage()) }}" class="page-link">Last</a>
				@endif
			</li>
		</ul>
	</div>
</div>

<script>
	document.getElementById('delete-review').addEventListener('submit', ev => {
		if (!confirm('Hapus Review Ini?')) {
			ev.preventDefault()
		}
	}) 
</script>
@endsection