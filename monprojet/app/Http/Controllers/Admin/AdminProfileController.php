<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    /**
     * Affiche la page profil admin
     */
    public function edit()
    {
        $admin = Auth::user(); 

        if (!$admin) {
            return redirect('/login')->withErrors('Veuillez vous connecter.');
        }

        return view('admin.profile', [
            'adminName' => $admin->nom ?? $admin->name ?? 'Administrateur',
            'adminRole' => $admin->role ?? 'Admin Principal',
            'adminProfilePic' => $admin->profile_photo_path 
                ? Storage::url($admin->profile_photo_path)
                : 'https://via.placeholder.com/120/38bdf8/ffffff?text=AD',

            'adminPresentation' => $admin->bio ?? 'Aucune bio définie.'
        ]);
    }

    /**
     * Mise à jour du profil
     */
    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'nom' => 'required|string|max:255',
            'presentation' => 'nullable|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            if ($admin->profile_photo_path) Storage::delete($admin->profile_photo_path);

            $admin->profile_photo_path = $request->file('profile_image')
                                                ->store('profile-photos', 'public');
        }

        $admin->nom = $request->nom;
        $admin->bio = $request->presentation;
        $admin->save();

        return back()->with('success','Profil mis à jour avec succès !');
    }
}
