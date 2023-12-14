<?php

namespace App\Http\Controllers;

use App\Events\Chat\SendMessage;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
		$user = Auth::user();
		$users = User::all();

		$messages = DB::table('messages')
            ->where('from', '=', $user->id)
            ->orWhere('to', '=', $user->id)
            ->select('*')
            ->get();

        return Inertia::render('Chat/DashboardChat', ['user' => $user, 'users' => $users, 'messages' => $messages]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {

		$user = Auth::user();

        $message = new Message([
			'from' => $user->id,
			'to' => $request->to,
			'content' => $request->content
		]);

		$message->save();

		Event::dispatch(new SendMessage($message, $request->to));

		return redirect('/chat');
    }

    public function ListMessage(User $user)
    {
        $userForm = Auth::user()->id;
		$userTo = $user->id();

		$messages = Message::where(function($query) use ($userForm, $userTo){
			$query->where('from', $userForm)->where('to', $userTo);
		})->orWhere(function($query) use ($userForm, $userTo){
			$query->where('from', $userTo)->where('to', $userForm);
		}) ->get();
	}


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
