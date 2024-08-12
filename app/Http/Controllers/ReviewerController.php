<?php

namespace App\Http\Controllers;

use App\Models\capaian;
use App\Models\proposal;
use App\Models\tim_litabmas;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function index() {
        $data_proposal = proposal::where('status_approvel', '=', NULL)
            ->where('proposals.status', '=', 'submitted')
            ->get()->toArray();
        $data_timLitabmas = tim_litabmas::get()->toArray();
        $data_capaian = capaian::get()->toArray();

        $data_full = array_map(function ($proposal, $timLitabmas, $capaian) {
            return [["proposal" => $proposal], ["timLitabmas" => $timLitabmas], ["capaian" => $capaian]];
        }, $data_proposal, $data_timLitabmas, $data_capaian);

        return view('pages.reviewer.index', compact('data_full'));
    }
}
