<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

class UserTable extends Component
{
    // public $users = [];
    public $currentUrl;

    public function mount()
    {
        $this->currentUrl = Route::current()->getName();
    }

    public function getUserDataByRole($role)
    {
        $this->currentUrl = $role;
        User::Role([Str::replaceFirst('users.', '', $this->currentUrl), $role])->get()->dd();
    }

    public function render()
    {
        dd(User::all);
        return view('livewire.user-table', [
            'users' => User::Role(Str::replaceFirst('users.', '', $this->currentUrl))->get()
        ]);
        // $users = User::paginate();
        // return view('livewire.user-table', compact('users'));
    }
}
