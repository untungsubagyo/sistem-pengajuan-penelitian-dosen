<?php

namespace App\Http\Controllers;

use App\Models\pengumuman;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    //controller index
    public function index(): View
    {
        $menu = 'pengumuman';
        $submenu = 'pengumuman';
        $datas = pengumuman::latest()->paginate(5);
        return view('pages.admin.pengumuman.index', compact('datas', 'menu', 'submenu'));
    }

    // controller edit
    function edit($id){
        $menu = 'pengumuman';
        $submenu = 'pengumuman';
        $pengumuman = pengumuman::findOrFail($id);
        return view('pages.admin.pengumuman.form_edit', compact('pengumuman', 'menu', 'submenu'));
    }
    
    // controller create
    public function create(){
        $menu = 'data';
        $submenu = 'pengumuman';
        return view('pages.admin.pengumuman.form', compact('menu','submenu'));
    }

    
    public function show(pengumuman $pengumuman)
    {
        $menu = 'pengumuman';
        $submenu = 'pengumuman';
        return view('pages.admin.pengumuman.show', compact('kategoriKegiatan', 'menu', 'submenu'));
    }

    
    // controller store
    public function store(Request $request){
        $request->validate([
            'tanggal_pengumuman'=>'required|date',
            'judul' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'file' => 'required|string',
            'status' => 'required|in:draf, publish',
        ]);
        pengumuman::create($request->all());

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

     // controller destroy
    function destroy($id)
    {
        $pengumuman = pengumuman::findOrFail($id);
        $pengumuman->delete();
        return redirect()->route('pengumuman.index')->with(['success' => 'Data berhasil dihapus']);
    }
}