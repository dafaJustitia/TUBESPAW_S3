<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;


class ProfileController extends Controller
{
    public function index()
    {
        confirmDelete();
        return view('dashboard.profile.index', [
            'title' => 'Profil Saya',
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $user = User::find(auth()->id());

        if ($request->hasFile('photo')) {
            if ($user->avatar_url) {
                $this->deleteFile($user->avatar_url);
            }
            $data['avatar_url'] = $this->storeImage($request->file('photo'), 'users');
        } else if ($request->remove_photo) {
            if ($user->avatar_url) {
                $this->deleteFile($user->avatar_url);
            }
            $data['avatar_url'] = null;
        }

        $user->update($data);

        Alert::success('Changed Successfully', 'Profile berhasil diubah.');
        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
