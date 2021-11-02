<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpJunior\LaravelVideoChat\Facades\Chat;

class ChatController extends Controller
{
    use ApiResponseTrait;

    public function conversations(){

        $data['groups'] = Chat::getAllGroupConversations();
        $data['conversations'] = Chat::getAllConversations();

        return $this->apiResponseData( $data , 'success');

    }

    public function startConversation($userId){

        Chat::startConversationWith($userId);

    }

    public function acceptConversation($conversationId){

        Chat::acceptMessageRequest($conversationId);

    }
    public function sendMessage(Request $request){
        $data['message'] = Chat::sendConversationMessage($request->conversationId, $request->text);
        return $this->apiResponseData( $data , 'success');
    }
    public function getConversationMessages($conversationId){

        $data['messages'] = Chat::getConversationMessageById($conversationId);
        return $this->apiResponseData( $data , 'success');
    }
}
