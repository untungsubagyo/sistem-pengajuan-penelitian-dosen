<?php

namespace App\Http\Controllers;

use App\Models\capaian;
use App\Models\proposal;
use App\Models\tim_litabmas;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function index() {
        $data_proposal_paginate = proposal::where('status_approvel', '=', NULL)
            ->where('proposals.status', '=', 'submitted')
            ->join('users', 'user_nidn', '=', 'nidn')
            ->paginate(perPage: 10, columns: [
                'proposals.id',
                'users.nama AS pemilik', 'users.email', 
                'proposals.created_at AS tanggal_dibuat', 
                'proposals.tanggal_submit', 'proposals.judul',
                'proposals.kata_kunci'
            ]);
        $data_timLitabmas = tim_litabmas::get([
            'id', 'nama', 'tugas', 'status', 'id_proposal'
        ])->toArray();
        $data_capaian = capaian::get([
            'id', 'tahun', 'jenis_capaian', 'indikator', 'id_proposal'
        ])->toArray();

        // return [...$data_proposal->items()[0]->toArray()];

        $data_proposal = array_map(function ($proposal) use ($data_timLitabmas, $data_capaian) {
            $tim_litabmas_full = array_map(function ($array) use ($proposal) {
                if ($array['id_proposal'] == $proposal['id']) return $array;
            }, $data_timLitabmas);
            
            $data_capaian_full = array_map(function ($array) use ($proposal) {
                if ($array['id_proposal'] == $proposal['id']) return $array;
            }, $data_capaian);

            return [...$proposal->toArray(), "timLitabmas" => $tim_litabmas_full, "capaian" => $data_capaian_full];
        }, $data_proposal_paginate->items());
        
        return view('pages.reviewer.index', compact('data_proposal', 'data_proposal_paginate'));
    }
}
