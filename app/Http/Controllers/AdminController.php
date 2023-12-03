<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
		$user = Auth::user();
        return Inertia::render('Adm/DashboardAdmin', ['user' => $user]);
    }

    public function showOne(string $id)
    {
        $User = User::all()->where('id', $id)->first();
        return Inertia::render('', ['']);
    }

	public function createUser()
	{
		$user = Auth::user();
		return Inertia::render('Auth/Register');
	}

}
