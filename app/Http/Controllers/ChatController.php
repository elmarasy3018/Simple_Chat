<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chatForm($user_id, UserService $userService){
        $receiver = $userService->getUser($user_id);
        return view('chat',compact('receiver'));
    }

    public function sendMessage1($user_id, Request $request, UserService $userService){
        $userService->sendMessage2($user_id, $request->message);
        return response()->json($user_id);
    }
}
