<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        return view('profiles.show',[
            'user' => $user,
            'tweets' => $user->tweets()->withLikes()->paginate(10),
        ]);
    }

    public function edit(User $user)
    {
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
       $attributes =  request()->validate([
            'username' => ['string', 'required','max:255', 'alpha_dash',Rule::unique('users')->ignore($user)],
            'name' => ['string', 'required','max:255' ],
            'bio' => ['string' ],
            'email' => ['string', 'required','email' , 'max:255' ,Rule::unique('users')->ignore($user)],
            'avatar' => ['file'],
            'banner' => ['file'],
            'password' => ['string', 'required','min:8','max:255', 'confirmed'],
        ]);

       if (request('avatar')) {
           if(file_exists($user->avatar)){
                @unlink($user->avatar);
            }
           $attributes['avatar'] = request('avatar')->store('avatars');
       }

       if (request('banner')) {
           if(file_exists('storage/'.$user->banner)){
                @unlink('storage/'.$user->banner);
            }
           $attributes['banner'] = request('banner')->store('banners');
       }

       $user->update($attributes);

       return redirect($user->path());

    }
}
