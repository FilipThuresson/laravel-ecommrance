<?php

namespace App\Livewire;

use Livewire\Component;

class Notification extends Component
{

    public $notification;

    public function mount($notification)
    {
        $this->notification = $notification;
    }

    public function read() {
        $this->notification->read();
        $this->dispatch('reloadNotifications');
    }
    public function render()
    {
        return view('livewire.notification');
    }
}
