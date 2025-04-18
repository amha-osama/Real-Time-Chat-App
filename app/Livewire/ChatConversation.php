<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatConversation extends Component
{
    public  $conversations =[];
    public User $user;
    public $receiver =null ;
    public $count =0;


    #[On('getMessagess')]
    public function getMessagess( $conversation_id,$receiver_id)
    {

       $this->dispatch('getMessagesss',
          [
            'conversation_id'=>$conversation_id,
            'receiver_id'=>$receiver_id
          ])->to(BoxChatMessages::class);
          
          
        $this->dispatch('getSendMessages',
            [
              'conversation_id'=>$conversation_id,
            'receiver_id'=>$receiver_id
            ])->to(SendMessage::class);
    }
    public function mount()
    {
        $user = Auth::user() ? Auth::user() : new User();
        $this->user = $user;
        $this->conversations = Conversation::where('sender_id',$user->id)
                              ->orWhere('receiver_id',$user->id)
                              ->get()
                              ->toArray();
        
   
    }


    public function getReceiver($receiverId)
    {
        $this->receiver = User::find($receiverId);

    }

    public function getFirstMessage($conversationId,$str)
    {
        $messages = Message::where('conversation_id', $conversationId)
         ->latest('created_at')
         ->first();

        if($str == 'message')return $messages->message;
        
        return $messages->created_at;  

    }

   

    #[On('refreshEdit')]
    public function render()
    {
        return view('livewire.chat-conversation');
    }
}
