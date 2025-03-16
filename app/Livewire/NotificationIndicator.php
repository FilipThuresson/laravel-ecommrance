<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationIndicator extends Component
{
    protected $listeners = ['reloadNotifications' => '$refresh'];

    public function render()
    {
        return view('livewire.notification-indicator', [
            'notifications' => Auth::user()->notifications,
            'user' => Auth::user()
        ]);
    }
}
