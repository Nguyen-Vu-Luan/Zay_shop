<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use App\Events\MessageSent;

class AdminChatController extends Controller
{
    // Danh sách user chat
    public function index()
    {
        $admin = Auth::user();
        if (!$admin || $admin->role !== 'admin') {
            Auth::logout();
            return redirect()->route('admin.login');
        }

        $users = User::all(); // Hoặc lọc những user đã chat nếu muốn
        return view('admin.chat.index', compact('users'));
    }

    // Lấy tin nhắn với user
    public function chat($userId)
    {
        $admin = Auth::user();
        $user = User::findOrFail($userId);

        $messages = Message::where(function ($q) use ($userId, $admin) {
            $q->where('from_id', $userId)->where('to_id', $admin->id);
        })->orWhere(function ($q) use ($userId, $admin) {
            $q->where('from_id', $admin->id)->where('to_id', $userId);
        })->orderBy('created_at')->get();

        return response()->json([
            'messages' => $messages->map(function ($msg) use ($user, $admin) {
                return [
                    'from_id' => $msg->from_id,
                    'from_name' => $msg->from_id == $admin->id ? 'You' : $user->name,
                    'message' => $msg->message
                ];
            })
        ]);
    }

    // Gửi tin nhắn
    public function send(Request $request, $userId)
    {
        $admin = Auth::user();
        $request->validate(['message' => 'required|string']);

        $message = Message::create([
            'from_id' => $admin->id,
            'to_id' => $userId,
            'message' => $request->message
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['success' => true]);
    }
}
