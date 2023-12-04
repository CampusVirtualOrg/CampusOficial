<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class LogonController extends Controller
{
    public function create()
    {
        if (Auth::user()->tipo == "Administrador") {

			return redirect('/adm');
        }

        if(Auth::user()->tipo == "Professor") {
			return redirect('/professor');

        }

		return redirect('/aluno');

    }


}
