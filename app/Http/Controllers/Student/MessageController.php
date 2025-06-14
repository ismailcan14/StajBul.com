<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Company;

class MessageController extends Controller
{
    public function index()
    {
        $companies = Company::with('user')->get();
        return view('student.messages.index', compact('companies'));
    }

    public function chat($company_id)
    {
        $student_id = Auth::id();

        $company = Company::findOrFail($company_id);
        $company_user_id = $company->user_id;

        $messages = Message::where(function ($q) use ($student_id, $company_user_id) {
            $q->where('sender_id', $student_id)->where('receiver_id', $company_user_id);
        })->orWhere(function ($q) use ($student_id, $company_user_id) {
            $q->where('sender_id', $company_user_id)->where('receiver_id', $student_id);
        })->orderBy('created_at')->get();

        return view('student.messages.chat', compact('company', 'messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'is_read' => false,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'message' => $message->message,
                'time' => $message->created_at->format('H:i d.m.Y'),
            ]);
        }

        return back();
    }

    public function fetchMessages(Request $request)
    {
        $userId = Auth::id();
        $otherUserId = $request->input('receiver_id');

        $messages = Message::where(function ($q) use ($userId, $otherUserId) {
            $q->where('sender_id', $userId)->where('receiver_id', $otherUserId);
        })->orWhere(function ($q) use ($userId, $otherUserId) {
            $q->where('sender_id', $otherUserId)->where('receiver_id', $userId);
        })->orderBy('created_at')->get();

        return response()->json($messages->map(function ($msg) use ($userId) {
            return [
                'message' => $msg->message,
                'time' => $msg->created_at->format('H:i d.m.Y'),
                'is_sender' => $msg->sender_id === $userId,
            ];
        }));
    }
}