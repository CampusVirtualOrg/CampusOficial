<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Events\NewMessage;


class MessageController extends Controller
{
    public function index()
    {
		$user = Auth::user();

		$messages = Message::all();

        return Inertia::render('Chat/DashboardChat', ['user' => $user,  'messages' => $messages]);
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
            'content' => $request->content,
        ]);

        $message->save();

        // broadcast(new NewMessage($message))->toOthers();

        return redirect(route('chat.index'));
    }

    public function ListMessage(User $user)
    {
		$messages = Message::all();
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

	public function api()
	{
		$messages = Message::all();
		return response()->json($messages);
	}
}
