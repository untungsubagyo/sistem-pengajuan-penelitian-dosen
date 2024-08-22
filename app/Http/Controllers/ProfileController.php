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
    // public function __construct()
    // {
    //     if (!auth()->check()) {
    //         return redirect('/');
    //     }
    // }

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
        $usersData = User::first(); // Adjust this as needed for testing
        $validated_data_user = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usersData->nidn, 'nidn')],
            'nip' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:255',
            'rumpun' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'request-del-profile' => 'required'
        ]);

        $usersData->nama = $validated_data_user['nama'];
        $usersData->email = $validated_data_user['email'];
        $usersData->nip = $validated_data_user['nip'];
        $usersData->no_telepon = $validated_data_user['no_telepon'];
        $usersData->rumpun = $validated_data_user['rumpun'];

        if ($request->filled('password')) {
            $usersData->password = Hash::make($validated_data_user['password']);
        }

        if ($validated_data_user['request-del-profile'] == 'true') {
            if ($usersData->profile_photo) {
                Storage::disk('public')->delete($usersData->profile_photo);
                $usersData->profile_photo = null;
            }
        }

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
