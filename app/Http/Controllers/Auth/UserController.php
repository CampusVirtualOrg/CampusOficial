<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{

    public function create(): Response
    {
        $user = Auth::user();
        $cursos = Curso::all();
        return Inertia::render('Auth/Register', ['user' => $user, 'cursos' => $cursos]);
    }

	public function show()
    {
        $users = User::with('curso')->get();
        $user = Auth::user();
        return Inertia::render('Adm/Usuarios/Usuarios', ['users' => $users, 'user' => $user,'cursos' => Auth::user()->curso]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo,
            'telefone' => $request->telefone,
            'cpf' => $request->cpf,
            'sexo' => $request->sexo,
            'endereco' => $request->endereco,
            'imagem' => $request->imagem,
            'data_nasc' => $request->data_nasc,
            'curso_id' => $request->curso_id,
        ]);

        event(new Registered($user));

        return redirect('/users');
    }

	public function edit(String $id){

        $user = User::all()->where('id', $id)->first();
        $userAuth =  Auth::user();
        $cursos = Curso::all();
        return Inertia::render('Adm/Usuarios/EditUsuarios', ['user' => $user,  'userAuth' => $userAuth, 'cursos' => $cursos]);

    }

	public function update(Request $request, string $id)
    {
        try {
            $user = User::where('id', $id)->first();
            if ($user->exists()) {
                $data = [
                    'name' => $request->name ? $request->name : $user->name,
                    'email' => $request->email ? $request->email : $user->email,
                    'password' => $request->password ? $request->password : $user->password,
                    'tipo' => $request->tipo ? $request->tipo : $user->tipo,
                    'matricula' => $request->matricula ? $request->matricula : $user->matricula,
                    'cpf' => $request->cpf ? $request->cpf : $user->cpf,
                    'sexo' => $request->sexo ? $request->sexo : $user->sexo,
                    'endereco' => $request->endereco ? $request->endereco : $user->endereco,
                    'data_nasc' => $request->data_nasc ? $request->data_nasc : $user->data_nasc,
                    'imagem' => $request->imagem ? $request->imagem : $user->imagem,
                    'curso_id' => $request->curso_id
                ];

                User::where('id', $id)->update($data);
                return redirect('/users');
            } else {
                echo "Erro ao atualizar!";
            }
        } catch (\Throwable $e) {
            echo "Ops ".$e;
        }
    }

	public function remove(string $id)
    {

        $subject = User::all()->where('id', $id)->first();
        if (!$subject) {
            echo "Ops! Erro ao deletar user.";
        }

        $subject->delete();
        return redirect('/users');
    }

	public function search(Request $request)
    {
        $user = Auth::user();
        $users = User::where('name', 'LIKE', '%' . $request->text . '%')
        ->orWhere('email', 'LIKE', '%' . $request->text . '%')
        ->orWhere('cpf', 'LIKE', '%' . $request->text . '%')
        ->orWhere('telefone', 'LIKE', '%' . $request->text . '%')
        ->paginate(10);
        return Inertia::render('Adm/Usuarios/Usuarios', ['users' => $users, 'user' => $user]);
    }

    public function searchName(){
        $user = Auth::user();
        $users = User::orderBy('name', 'ASC')->get();
        return Inertia::render('Adm/Usuarios/Usuarios', ['users' => $users, 'user' => $user]);
    }
}
