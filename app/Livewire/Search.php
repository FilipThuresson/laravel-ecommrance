<?php
namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $width;
    public $results = [];
    public $search = '';

    public function mount($width = 'w-full')
    {
        $this->width = $width;
    }

    public function updatedSearch()
    {
    }

    public function render()
    {
        if($this->search == ''){
            $this->results = [];
        } else {
            if (auth()->user()->can('view users')) {
                $this->results = User::where('name', 'like', '%' . $this->search . '%')->limit(5)->get();
            }
        }

        return view('livewire.search');
    }
}
