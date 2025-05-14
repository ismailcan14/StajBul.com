<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function index()
    {
        $companyUserId = Auth::id();

        $studentIds = Message::where('receiver_id', $companyUserId)
            ->orWhere('sender_id', $companyUserId)
            ->pluck('sender_id')
            ->merge(Message::where('receiver_id', $companyUserId)->pluck('receiver_id'))
            ->unique()
            ->filter(fn ($id) => $id !== $companyUserId);

        $students = User::whereIn('id', $studentIds)->with('student')->get();

        return view('company.messages.index', compact('students'));
    }

    public function chat($student_id)
    {
        $companyUserId = Auth::id();

        $messages = Message::where(function ($q) use ($student_id, $companyUserId) {
            $q->where('sender_id', $companyUserId)->where('receiver_id', $student_id);
        })->orWhere(function ($q) use ($student_id, $companyUserId) {
            $q->where('sender_id', $student_id)->where('receiver_id', $companyUserId);
        })->orderBy('created_at')->get();

        $student = User::with('student')->findOrFail($student_id);

        return view('company.messages.chat', compact('student', 'messages'));
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