<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


use function Termwind\render;

class ChatsController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $messages = Message::with('user')->latest()->get();
        return Inertia::render('Chat/DashboardChat', ['user' => $user, 'messages' => $messages]);
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }


    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $message = $user->userMessages()->create([
            'message' => $request->message
        ]);
        
        // broadcast(new MessageSent($user, $message))->toOthers();

        // Não consegui fazer os eventos funcionarem, é só descomentar a linha acima e mandar
        // uma mensagem no chat e da pra ver o erro. então por enquanto só no control + r

        return redirect('/chat');
    }
}
