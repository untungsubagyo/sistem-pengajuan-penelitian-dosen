@extends('layout.reviewer')

@section('content-reviewer')
<div class="p-4">
	@forelse ($data_proposal as $data)
		<p>judul : {{ $data['judul'] }}</p>
		<p>pemilik : {{ $data['pemilik'] }}</p>
		<p>email : {{ $data['email'] }}</p>
		<p>tanggal submit : {{ $data['tanggal_submit'] ?? '-'}}</p>
		<p>kata kunci : {{ $data['kata_kunci'] }}</p>

		<br>
		<p><strong>tim litabmas</strong></p>
		@forelse ($data['timLitabmas'] as $timLitabmas)
			<p>nama : {{ $timLitabmas['nama'] }}</p>
			<p>status : {{ $timLitabmas['status'] }}</p>
			<p>tugas : {{ $timLitabmas['tugas'] }}</p>
			<br>
		@empty
			<span>-</span>
		@endforelse

		<br>
		<p><strong>capaian</strong></p>
		@forelse ($data['capaian'] as $capaian)
			<p>tahun : {{ $capaian['tahun'] }}</p>
			<p>jenis : {{ $capaian['jenis_capaian'] }}</p>
			<p>indikator : {{ $capaian['indikator'] }}</p>
			<br>
		@empty
			<span>-</span>
		@endforelse
	@empty
		<p>belum ada proposal yang di submit</p>
	@endforelse
	<nav aria-label="Page navigation example">
		<ul class="pagination pagination-primary  justify-content-center">
			<li class="page-item disabled">
				<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
			</li>
			<li class="page-item active"><a class="page-link" href="#">1</a></li>
			<li class="page-item"><a class="page-link" href="#">2</a></li>
			<li class="page-item"><a class="page-link" href="#">3</a></li>
			<li class="page-item">
				<a class="page-link" href="#">Next</a>
			</li>
		</ul>
	</nav>
</div>
@endsection