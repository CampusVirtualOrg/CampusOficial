<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function home()
    {
		$user = Auth::user();
        return Inertia::render('DashboardAdmin', ['user' => $user]);
    }

    public function users()
    {
        $users = User::with('curso')->get();
        $user = Auth::user();
        return Inertia::render('Adm/Usuarios/Usuarios', ['users' => $users, 'user' => $user]);
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

    public function register(Request $request)
    {
        try {
            $credentials = $request->only('nome', 'email', 'senha', 'tipo', 'matricula', 'telefone', 'cpf', 'sexo', 'endereco', 'imagem', 'data_nasc'); //DADOS DO User A SER CRIADO
            //VALIDA DADOS
            if (($credentials['nome'] == null ||
                $credentials['email'] == null ||
                $credentials['senha'] == null ||
                $credentials['tipo'] == null ||
                $credentials['matricula'] == null ||
                $credentials['telefone'] == null ||
                $credentials['cpf'] == null ||
                $credentials['sexo'] == null ||
                $credentials['data_nasc'] == null
            )) {
                echo "Dados Incompletos";
            }

            //VERIFICA SE CONTA DE EMAIL JA ESTA CADASTRADO
            $res =  User::all()->where('email', $credentials['email'])->first();
            if ($res) {
                echo 'Email ja cadastrado!';
            }

            //MODELO RECEBE OS DADOS PARA SEREM SALVOS
            $User = new User([
                'nome' => $credentials['nome'],
                'email' => $credentials['email'],
                'senha' => $credentials['senha'],
                'tipo' => $credentials['tipo'],
                'matricula' => $credentials['matricula'],
                'telefone' => $credentials['telefone'],
                'cpf' => $credentials['cpf'],
                'sexo' => $credentials['sexo'],
                'endereco' => $credentials['endereco'],
                'imagem' => $credentials['imagem'],
                'data_nasc' => $credentials['data_nasc'],
                'curso_id' => $credentials['curso_id'],
            ]);

            $User->save();

        } catch (\Throwable $th) {
            echo "erro no cadastro de User" . $th->getMessage();
        }
    }

    public function indexUpdate(String $id){

        $user = User::all()->where('id', $id)->first();
        $userAuth =  Auth::user();
        $cursos = Curso::all();
        return Inertia::render('Adm/Usuarios/EditUsuarios', ['user' => $user,  'userAuth' => $userAuth, 'cursos' => $cursos]);

    }

    public function edit(Request $request, string $id)
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
                    'curso_id' => $request->curso_id ? $request->curso_id : $user->curso_id,
                ];

                User::where('id', $id)->update($data);
                return redirect('/usuarios');
            } else {
                return response()->json([
                    "success" => "sem sucesso"
                ], 404);
            }
        } catch (\Throwable $e) {
            return response()->json([
                "success" => false,
                "error" => $e->getMessage()
            ], 400);
        }
    }

    //REMOVE Aluno
    public function remove(string $id)
    {
        //VERIFICA SE ID EXISTE
        $subject = User::all()->where('id', $id)->first();
        if (!$subject) {
            return response([
                'msg' => 'Usuario nao removido',
            ]);
        }
        //REMOVE User
        $subject->delete();
        return redirect('/usuarios');
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
