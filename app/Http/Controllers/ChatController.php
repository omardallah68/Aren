<?php

namespace App\Http\Controllers;

use App\Events\PrivateMessage;
use App\Models\ChatRoomMembers;
use App\Models\RoomUsers;
use App\Models\User;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Message;
use App\Events\NewChatMessage;

class ChatController extends Controller
{
    /*public function index()
    {
        $users = User::get();
        $messages = Message::with('user', 'receiver')->where('receiver_id', '=', Auth::user()->id)->orWhere('user_id', '=', Auth::user()->id)->latest()->get();
        return Inertia::render('Chat/Index', ['messages' => $messages, 'users' => $users]);
    }
    public function sendMessage(Request $request)
    {
        $user = Auth::user(); // Assuming you have authentication set up
        $receiverId = $request->input('receiver_id');
        $messageContent = $request->input('content');

        // Save the message to the database
        $message = new Message([
            'user_id' => $user->id,
            'receiver_id' => $receiverId,
            'content' => $messageContent,
        ]);
        $message->save();
        // Broadcast the message
        event(new PrivateMessage($user, $receiverId, $messageContent));

        $receiver = User::find($receiverId);
        return response()->json([
            'user' => $user,
            'content' => $messageContent,
            'receiver' => $receiver,
            'created_at' => Carbon::now()
        ]);
    }*/

    public function rooms (Request $request) {
        return RoomUsers::with('chatRoom')->join('chat_rooms','room_users.room_id', '=', 'chat_rooms.id')->where('user_id', Auth::id())->get();
    }

    public function users (Request $request) {
        return User::all();
    }

    public function messages (Request $request, $roomId) {
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function newMessage (Request $request, $roomId) {
        $newMessage = new ChatMessage;
        $newMessage->user_id = Auth::id();
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        $newMessage->save();

        broadcast(new NewChatMessage($newMessage))->toOthers();

        return $newMessage;

    }

    public function newRoom (Request $request) {
        $newRoom = new ChatRoom;
        $newRoom->name = $request->input('params.receiver.name') . ' and ' .  Auth::user()->name;
        $newRoom->save();

        /*$chatRoomMember = new ChatRoomMembers;
        $chatRoomMember->room_id = $newRoom->id;
        $chatRoomMember->user_id = Auth::id();
        $chatRoomMember->receiver_id = $request->input('params.receiver.id');
        $chatRoomMember->save();*/

        $newChatRoom = new RoomUsers;
        $newChatRoom->room_id = $newRoom->id;
        $newChatRoom->user_id = Auth::id();
        $newChatRoom->save();

        $newChatRoom = new RoomUsers;
        $newChatRoom->room_id = $newRoom->id;
        $newChatRoom->user_id = $request->input('params.receiver.id');
        $newChatRoom->save();

        return $newRoom;
    }

}
