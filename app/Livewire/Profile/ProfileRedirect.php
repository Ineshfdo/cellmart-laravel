<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfileRedirect extends Component
{
    protected $listeners = ['saved' => 'handleSaved'];

    public function handleSaved()
    {
        return redirect()->route(
            Auth::user()->type === 'admin' ? 'dashboard' : 'home'
        );
    }

    public function render()
    {
        return view('livewire.profile.profile-redirect');
    }
}
