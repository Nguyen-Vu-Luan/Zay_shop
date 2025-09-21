<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function popup()
    {
        $messages = Message::where(function ($q) {
            $q->where('from_id', Auth::id())
                ->orWhere('to_id', Auth::id());
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.popup', compact('messages'));
    }

    public function send(Request $request)
    {
        $message = Message::create([
            'from_id' => Auth::id(),
            'to_id'   => 1, // admin
            'message' => $request->message,
        ]);

        broadcast(new \App\Events\MessageSent($message))->toOthers();

        return response()->json($message);
    }
}
