<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        if (!auth()->check()) {
            return redirect('/');
        }
    }

    public function index()
    {
        // Fetching a dummy user
        $dataProfile = User::first(); // Adjust this as needed for testing
        $dataJabatan = Jabatan::all();
        $isActivateUser = $dataProfile !== null;

        return view('profile', compact('dataProfile', 'dataJabatan', 'isActivateUser'));
    }

    public function update(Request $request)
    {
        // Ambil user yang tepat
        $usersData = User::find(auth()->user()->nidn); // Ambil user berdasarkan NIDN yang login
    
        $validated_data_user = $request->validate([
            'nama' => 'nullable|string|max:255',
            'email' => [
                'nullable', 
                'string', 
                'email', 
                'max:255', 
                Rule::unique('users')->ignore($usersData->nidn, 'nidn')
            ],
            'nip' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:255',
            'rumpun' => 'nullable|string|max:255',
            'id_jabatan' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'request-del-profile' => 'nullable|string',
        ]);
    
        // Update fields based on request
        if ($request->filled('nama')) {
            $usersData->nama = $validated_data_user['nama'];
        }
        
        if ($request->filled('email')) {
            if ($usersData->email !== $validated_data_user['email']) {
                $usersData->email = $validated_data_user['email'];
            }
        }
    
        if ($request->filled('nip')) {
            $usersData->nip = $validated_data_user['nip'];
        }
    
        if ($request->filled('no_telepon')) {
            $usersData->no_telepon = $validated_data_user['no_telepon'];
        }
    
        if ($request->filled('rumpun')) {
            $usersData->rumpun = $validated_data_user['rumpun'];
        }
    
        if ($request->filled('id_jabatan')) {
            $usersData->id_jabatan = $validated_data_user['id_jabatan'];
        }
    
        // Update password if provided
        if ($request->filled('password')) {
            $usersData->password = Hash::make($validated_data_user['password']);
        }
    
        // Handle profile photo deletion if requested
        if ($request->filled('request-del-profile') && $validated_data_user['request-del-profile'] === 'true') {
            if ($usersData->profile_photo) {
                Storage::disk('public')->delete($usersData->profile_photo);
                $usersData->profile_photo = null;
            }
        }
    
        // Handle new profile photo upload
        if ($request->hasFile('profile_photo')) {
            if ($usersData->profile_photo) {
                Storage::disk('public')->delete($usersData->profile_photo);
            }
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $usersData->profile_photo = $profilePhotoPath;
        }
    
        $usersData->save();
    
        return redirect()->back()->with('message', 'Profil berhasil diperbarui.');
    }
    
    
    
    
}
