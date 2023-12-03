<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfessorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('Professor/DashboardProf', ['user' => $user]);
    }
}
