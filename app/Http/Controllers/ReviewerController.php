<?php

namespace App\Http\Controllers;

use App\Models\capaian;
use App\Models\proposal;
use App\Models\review_proposal;
use App\Models\tim_litabmas;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Storage;
use Validator;

class ReviewerController extends Controller
{
	public function index(Request $request)
	{
		$current_reviewer = '01110111'; //!! THIS IS A DUMMY DATA, PLEASE CHANGE WHEN THE NECESSARY FEATURE IS COMPLETED
		$q = $request->query('q');

		if ($q) {
			$data_proposal_paginate = proposal::where('proposals.status', '=', 'submitted')
				->join('users', 'user_nidn', '=', 'nidn')
				->where('proposals.judul', 'LIKE', "%$q%")
				->orWhere('proposals.kata_kunci', 'LIKE', "%$q%")
				->orWhere('users.nama', 'LIKE', "%$q%")
				->orWhere('users.nidn', 'LIKE', "%$q%")
				->paginate(perPage: 12, columns: [
					'proposals.id',
					'users.nidn',
					'users.nama AS pemilik',
					'users.nip',
					'proposals.created_at AS tanggal_dibuat',
					'proposals.tanggal_submit',
					'proposals.judul',
					'proposals.kata_kunci'
				]);
		} else {
			$data_proposal_paginate = proposal::where('proposals.status', '=', 'submitted')
				->join('users', 'user_nidn', '=', 'nidn')
				->paginate(perPage: 12, columns: [
					'proposals.id',
					'users.nidn',
					'users.nama AS pemilik',
					'users.nip',
					'proposals.created_at AS tanggal_dibuat',
					'proposals.tanggal_submit',
					'proposals.judul',
					'proposals.kata_kunci'
				]);
		}
		$data_timLitabmas = tim_litabmas::get([
			'id',
			'nama',
			'tugas',
			'status',
			'id_proposal'
		])->toArray();
		$data_capaian = capaian::get([
			'id',
			'tahun',
			'jenis_capaian',
			'indikator',
			'id_proposal'
		])->toArray();

		$data_review_proposal = review_proposal::where('id_user', '=', $current_reviewer)
			->get()->toArray();

		// return [...$data_proposal->items()[0]->toArray()];
		$data_proposal = array_map(function ($proposal) use ($data_timLitabmas, $data_capaian, $data_review_proposal) {
			$tim_index = 0;
			$tim_litabmas_full = array_map(function ($item) use ($proposal, $tim_index, $data_timLitabmas) {
				if ($item['id_proposal'] == $proposal['id']) {
					unset($data_timLitabmas[$tim_index]);
					return $item;
				}

				$tim_index++;
			}, $data_timLitabmas);

			$capaian_index = 0;
			$data_capaian_full = array_map(function ($item) use ($proposal, $capaian_index, $data_capaian) {
				if ($item['id_proposal'] == $proposal['id']) {
					unset($data_capaian[$capaian_index]);
					return $item;
				}
				$capaian_index++;
			}, $data_capaian);

			$review_status = ['review_status' => null];
			foreach ($data_review_proposal as $item) {
				if ($item['id_proposal'] == $proposal['id'])
					$review_status = ['review_status' => $item['status']];
			}

			return [...$proposal->toArray(), "timLitabmas" => $tim_litabmas_full, "capaian" => $data_capaian_full, ...$review_status];
		}, $data_proposal_paginate->items());

		// return $data_proposal_paginate;
		return view('pages.reviewer.index', compact('data_proposal', 'data_proposal_paginate', 'q'));
	}

	public function review(string $id)
	{
		$current_reviewer = '01110111'; //!! THIS IS A DUMMY DATA, PLEASE CHANGE WHEN THE NECESSARY FEATURE IS COMPLETED

		$data_proposal = proposal::join('users', 'user_nidn', '=', 'nidn')
			->join('skema_penelitians', 'proposals.id_skema', '=', 'skema_penelitians.id')
			->join('jabatans', 'users.id_jabatan', '=', 'jabatans.id')
			->findOrFail($id, [
				'proposals.id',
				'proposals.judul',
				'proposals.nama_mitra',
				'proposals.alamat_mitra',
				'proposals.kata_kunci',
				'proposals.latar_belakang',
				'proposals.ringkasan',
				'proposals.urgensi',
				'proposals.rumusan_masalah',
				'proposals.pendekatan_pemecahan_masalah',
				'proposals.kebaruan',
				'proposals.metode_penelitian',
				'proposals.jadwal_penelitian',
				'proposals.daftar_pustaka',
				'proposals.status_approvel',
				'proposals.tanggal_submit',
				'proposals.approvel_date',
				'proposals.laporan_progress',
				'proposals.laporan_akhir',

				'skema_penelitians.nama_skema',
				'skema_penelitians.sumber_dana',
				'skema_penelitians.durasi',
				'skema_penelitians.satuan_durasi',
				'skema_penelitians.total_biaya',
				'skema_penelitians.bobot_rumusan_masalah',
				'skema_penelitians.bobot_luaran',
				'skema_penelitians.bobot_metode',
				'skema_penelitians.bobot_tinjauan_pustaka',
				'skema_penelitians.bobot_kelayakan',

				'users.nama AS pemilik',
				'users.email',
				'users.nip',
				'users.nidn',
				'users.rumpun',
				'users.no_telepon',
				'jabatans.nama AS jabatan',
			]);

		$data_timLitabmas = tim_litabmas::where('id_proposal', '=', $data_proposal->id)
			->get([
				'id',
				'nama',
				'tugas',
				'status'
			])->toArray();

		$data_capaian = capaian::where('id_proposal', '=', $data_proposal->id)
			->get([
				'id',
				'tahun',
				'jenis_capaian',
				'indikator'
			])->toArray();

		$data_review_proposal = review_proposal::where('id_proposal', '=', $id)
			->where('id_user', '=', $current_reviewer)
			->get()->toArray();

		return view('pages.reviewer.review', compact('data_proposal', 'data_timLitabmas', 'data_capaian', 'data_review_proposal'));
	}

	public function postReview(Request $request, string $id_proposal)
	{
		$status = $request->has('status-verify') ? 'verify' : 'draf';
		$current_reviewer = '01110111'; //!! THIS IS A DUMMY DATA, PLEASE CHANGE WHEN THE NECESSARY FEATURE IS COMPLETED
		// $validator = Validator::make($request->all(), [
		// 	'file' => ['file', 'required', 'max:10240'], // 10 MB
		// 	'catatan' => ['required'],
		// 	'skor_rumusan_masalah' => ['required', 'numeric', 'max:5', 'min:1'],
		// 	'skor_luaran' => ['required', 'numeric', 'max:5', 'min:1'],
		// 	'skor_metode' => ['required', 'numeric', 'max:5', 'min:1'],
		// 	'skor_tinjauan_pustaka' => ['required', 'numeric', 'max:5', 'min:1'],
		// 	'skor_kelayakan_umum' => ['required', 'numeric', 'max:5', 'min:1'],
		// ]);

		// {
		// 	"skor_rumusan_masalah": "5",
		// 	"skor_luaran": "5",
		// 	"skor_metode": "5",
		// 	"skor_tinjauan_pustaka": "5",
		// 	"skor_kelayakan_umum": "5",
		// 	"catatan": "567",
		// 	"status-verify": "Verifikasi",
		// 	"file": {}
		// }

		$data_review_proposal = review_proposal::where('id_proposal', '=', $id_proposal)
			->where('id_user', '=', $current_reviewer)
			->get()->toArray();

		if (count($data_review_proposal) > 0) {
			//* reject the request when the "review_proposal" status is "verify" *//
			if ($data_review_proposal[0]['status'] == 'verify')
				return redirect()->back();


			//* update the review when this proposal have the review *//

			//* handdle the file *//
			if (isset($data_review_proposal[0]['file']))
				Storage::disk('public')->delete($data_review_proposal[0]['file']);
			$file_review = $request->file('file')->store('file-review', 'public');

			$data = [
				'reviwer_date' => now(),
				'file' => $file_review,
				'catatan' => $request->catatan,
				'skor_rumusan_masalah' => $request->skor_rumusan_masalah,
				'skor_luaran' => $request->skor_luaran,
				'skor_metode' => $request->skor_metode,
				'skor_tinjauan_pustaka' => $request->skor_tinjauan_pustaka,
				'skor_kelayakan_umum' => $request->skor_kelayakan_umum,
				'status' => $status,
			];

			$reviewProposal = review_proposal::where('id_proposal', '=', $id_proposal)
				->where('id_user', '=', $current_reviewer)
				->first();

			if ($reviewProposal) {
				$reviewProposal->update($data);
			}
		} else {
			$file_review = $request->file('file')->store('file-review', 'public');

			$data = [
				'id_user' => $current_reviewer,
				'id_proposal' => $id_proposal,
				'reviwer_date' => now(),
				'file' => $file_review,
				'catatan' => $request->catatan,
				'skor_rumusan_masalah' => $request->skor_rumusan_masalah,
				'skor_luaran' => $request->skor_luaran,
				'skor_metode' => $request->skor_metode,
				'skor_tinjauan_pustaka' => $request->skor_tinjauan_pustaka,
				'skor_kelayakan_umum' => $request->skor_kelayakan_umum,
				'status' => $status,
			];

			review_proposal::create($data);
		}

		return redirect()->back();
	}

	public function viewAllDraft(Request $request)
	{
		$current_reviewer = '01110111'; //!! THIS IS A DUMMY DATA, PLEASE CHANGE WHEN THE NECESSARY FEATURE IS COMPLETED
		$q = $request->query('q');
		$isViewAllDraft = true;

		if ($q) {
			$data_proposal_paginate = review_proposal::where('review_proposals.status', '=', 'draf')
				->where('id_user', '=', $current_reviewer)
				->join('proposals', 'proposals.id', '=', 'id_proposal')
				->join('users', 'user_nidn', '=', 'nidn')
				->where('proposals.judul', 'LIKE', "%$q%")
				->orWhere('proposals.kata_kunci', 'LIKE', "%$q%")
				->orWhere('users.nama', 'LIKE', "%$q%")
				->orWhere('users.nidn', 'LIKE', "%$q%")
				->paginate(perPage: 12, columns: [
					'review_proposals.id AS id_review',
					'proposals.id',
					'users.nidn',
					'users.nama AS pemilik',
					'users.nip',
					'proposals.created_at AS tanggal_dibuat',
					'proposals.tanggal_submit',
					'proposals.judul',
					'proposals.kata_kunci'
				]);
		} else {
			$data_proposal_paginate = review_proposal::where('review_proposals.status', '=', 'draf')
				->where('id_user', '=', $current_reviewer)
				->join('proposals', 'proposals.id', '=', 'id_proposal')
				->join('users', 'user_nidn', '=', 'nidn')
				->paginate(perPage: 12, columns: [
					'review_proposals.id AS id_review',
					'proposals.id',
					'users.nidn',
					'users.nama AS pemilik',
					'users.nip',
					'proposals.created_at AS tanggal_dibuat',
					'proposals.tanggal_submit',
					'proposals.judul',
					'proposals.kata_kunci'
				]);
		}
		

		$data_timLitabmas = tim_litabmas::get([
			'id',
			'nama',
			'tugas',
			'status',
			'id_proposal'
		])->toArray();

		$data_capaian = capaian::get([
			'id',
			'tahun',
			'jenis_capaian',
			'indikator',
			'id_proposal'
		])->toArray();

		$data_proposal = array_map(function ($proposal) use ($data_timLitabmas, $data_capaian) {
			$tim_index = 0;
			$tim_litabmas_full = array_map(function ($item) use ($proposal, $tim_index, $data_timLitabmas) {
				if ($item['id_proposal'] == $proposal['id']) {
					unset($data_timLitabmas[$tim_index]);
					return $item;
				}
				$tim_index++;
			}, $data_timLitabmas);

			$capaian_index = 0;
			$data_capaian_full = array_map(function ($item) use ($proposal, $capaian_index, $data_capaian) {
				if ($item['id_proposal'] == $proposal['id']) {
					unset($data_capaian[$capaian_index]);
					return $item;
				}
				$capaian_index++;
			}, $data_capaian);

			return [...$proposal->toArray(), "timLitabmas" => $tim_litabmas_full, "capaian" => $data_capaian_full, 'review_status' => null];
		}, $data_proposal_paginate->items());

		return view('pages.reviewer.index', compact('data_proposal', 'data_proposal_paginate', 'q', 'isViewAllDraft'));
	}

	public function deleteReview (string $id_review_proposal) {
		$data_review_proposal = review_proposal::findOrFail($id_review_proposal);
		if (isset($data_review_proposal->file))
			Storage::disk('public')->delete($data_review_proposal->file);
		$data_review_proposal->delete();

		return redirect()->route('reviewer.viewAllDraf');
	}
}
