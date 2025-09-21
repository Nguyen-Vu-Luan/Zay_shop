<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;

class AdminChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->get();
        return view('chat.admin_index', compact('users'));
    }

    public function chat($userId)
    {
        $messages = Message::where(function ($q) use ($userId) {
            $q->where('from_id', $userId)->where('to_id', 1);
        })
            ->orWhere(function ($q) use ($userId) {
                $q->where('from_id', 1)->where('to_id', $userId);
            })
            ->orderBy('created_at')
            ->get();

        return view('chat.admin_chat', compact('messages', 'userId'));
    }

    public function send(Request $request, $userId)
    {
        $msg = Message::create([
            'from_id' => 1, // admin id
            'to_id' => $userId,
            'message' => $request->message,
        ]);

        broadcast(new MessageSent($msg))->toOthers();

        return response()->json(['status' => 'ok']);
    }
}
