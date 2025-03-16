<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;

class FirstSetupController extends Controller
{
    public function index() {
        if(auth()->user()->email !== 'test@example.com'){
            return redirect(route('dashboard.index'));
        }

        return view('first_setup/index');
    }

    public function store(Request $request)
    {
        if (auth()->user()->email !== 'test@example.com') {
            return redirect(route('dashboard.index'));
        }

        $userCreationService = new CreateNewUser();
        $user = $userCreationService->create($request->all());
        $user->assignRole('super admin');

        $oldUser = auth()->user();
        $oldUser->delete();
        auth()->login($user);

        return redirect(route('dashboard.index'));
    }
}
