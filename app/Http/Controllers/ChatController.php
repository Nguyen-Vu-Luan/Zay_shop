<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Trang chat chính (nếu cần)
    public function index()
    {
        $messages = Message::where(function ($q) {
            $q->where('from_id', Auth::id())->where('to_id', 1);
        })->orWhere(function ($q) {
            $q->where('from_id', 1)->where('to_id', Auth::id());
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.index', compact('messages'));
    }

    // Popup chat
    public function popup()
    {
        $messages = Message::where(function ($q) {
            $q->where('from_id', Auth::id())->where('to_id', 1);
        })->orWhere(function ($q) {
            $q->where('from_id', 1)->where('to_id', Auth::id());
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.popup', compact('messages'));
    }

    // Gửi tin nhắn
    public function send(Request $request)
    {
        $msg = Message::create([
            'from_id' => Auth::id(),
            'to_id'   => 1, // admin mặc định
            'message' => $request->message,
        ]);

        // trả về JSON để hiển thị ngay
        return response()->json([
            'from_id' => $msg->from_id,
            'message' => $msg->message,
            'time'    => $msg->created_at->format('H:i'),
        ]);
    }
}
