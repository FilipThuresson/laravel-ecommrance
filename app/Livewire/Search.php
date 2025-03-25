<?php
namespace App\Livewire;

use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $width;
    public $users = [];
    public $products = [];
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
            $this->users = [];
            $this->products = [];

        } else {
            if (auth()->user()->can('view users')) {
                $this->users = User::where('name', 'like', '%' . $this->search . '%')->limit(5)->get();
            }
            $this->products = Product::where('name', 'like', '%' . $this->search . '%')->orWhere('article_no', 'like', '%'. $this->search . '%')->orWhere('id', 'like', $this->search)->limit(5)->get();
        }

        return view('livewire.search');
    }
}
